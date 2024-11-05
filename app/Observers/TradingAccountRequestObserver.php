<?php

namespace App\Observers;

use App\Mail\AdminNotificationEmail;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\TradingAccountRequest;

class TradingAccountRequestObserver
{
    /**
     * Handle the TradingAccountRequest "created" event.
     */
    public function created(TradingAccountRequest $tradingAccountRequest): void
    {
        // send notification to admin & user
        $user = $tradingAccountRequest->user;

        $message = 'Thanks for requesting for Trading Account, Our exceutive will contact you soon.';
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
        $adminMessage = 'New Trading Account request from: ' . $user->name . ' / ' . $user->email;
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to(env('MAIL_ADMIN_ADDRESS', 'support@aonetrades.com'))->send(new AdminNotificationEmail($adminMessage));
    }

    /**
     * Handle the TradingAccountRequest "updated" event.
     */
    public function updated(TradingAccountRequest $tradingAccountRequest): void
    {
        // send notification to user
        $user = $tradingAccountRequest->user;
        $status = $tradingAccountRequest->status;

        $message = 'Your Trading Account request is accepted.';
        if ($status == 'rejected') {
            $rejectReason = !empty(trim($tradingAccountRequest->reject_notes)) ? $tradingAccountRequest->reject_notes : null;
            if ($rejectReason) {
                $message = 'Your Trading Account request is rejected.<br /><br /> <strong>Reason: </strong>' . $rejectReason;
            } else {
                $message = 'Your Trading Account request is rejected, please contact support for further information.';
            }
        }
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
    }

    /**
     * Handle the TradingAccountRequest "deleted" event.
     */
    public function deleted(TradingAccountRequest $tradingAccountRequest): void
    {
        //
    }

    /**
     * Handle the TradingAccountRequest "restored" event.
     */
    public function restored(TradingAccountRequest $tradingAccountRequest): void
    {
        //
    }

    /**
     * Handle the TradingAccountRequest "force deleted" event.
     */
    public function forceDeleted(TradingAccountRequest $tradingAccountRequest): void
    {
        //
    }
}
