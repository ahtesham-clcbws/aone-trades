<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;

class CheckUserLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            // Return response for non-GET or JSON requests
            if (!$request->isMethod('GET') || $request->isJson()) {
                return $response;
            }

            // Return response if path contains livewire or debugbar
            if (str_contains($request->path(), 'livewire') || str_contains($request->path(), '_debugbar')) {
                return $response;
            }

            $userAgent = $request->userAgent();
            if (is_null($userAgent)) {
                return $response;
            }

            $sessionId = session()->getId();
            $path = $request->path();
            $today = now()->startOfDay(); // Get the start of today

            // Check if entry already exists for today
            $existingPageView = PageView::where('session_id', $sessionId)
                ->where('path', $path)
                ->where('created_at', '>=', $today)
                ->first();

            if ($existingPageView) {
                return $response;
            }

            $pageView = new PageView();
            $pageView->session_id = $sessionId;
            $pageView->path = $path;
            $pageView->user_agent = $userAgent;
            $pageView->referer = $request->headers->get('referer');
            $pageView->ip = $request->ip();

            if ($position = Location::get()) {
                $pageView->ip = $position->ip;
                $pageView->country = $position->countryName;
                $pageView->state = $position->regionName;
                $pageView->city = $position->cityName;
                $pageView->zip = $position->zipCode;
                $pageView->lat = $position->latitude;
                $pageView->long = $position->longitude;
                $pageView->timezone = $position->timezone;
            }

            $pageView->save();

            return $response;
        } catch (\Throwable $e) {
            report($e);
            return $response;
        }
    }
}
