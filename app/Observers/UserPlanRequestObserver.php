<?php

namespace App\Observers;

use App\Mail\AdminNotificationEmail;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserPlanRequest;

class UserPlanRequestObserver
{
    /**
     * Handle the UserPlanRequest "created" event.
     */
    public function created(UserPlanRequest $userPlanRequest): void
    {
        // send notification to admin & user
        $user = $userPlanRequest->user;

        $message = 'Plan change request is in place, you will notify once your request is approved.';
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
        $adminMessage = 'New Plan Change request from: ' . $user->name . ' / ' . $user->email;
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to(env('MAIL_ADMIN_ADDRESS', 'support@aonetrades.com'))->send(new AdminNotificationEmail($adminMessage));
    }

    /**
     * Handle the UserPlanRequest "updated" event.
     */
    public function updated(UserPlanRequest $userPlanRequest): void
    {
        // send notification to user
        $user = $userPlanRequest->user;
        $status = $userPlanRequest->status;

        $message = 'Your Plan Change request is verify & accepted.';
        if ($status == 'rejected') {
            $rejectReason = !empty(trim($userPlanRequest->reject_notes)) ? $userPlanRequest->reject_notes : null;
            if ($rejectReason) {
                $message = 'Your Plan Change request is rejected.<br /><br /> <strong>Reason: </strong>' . $rejectReason;
            } else {
                $message = 'Your Plan Change request is rejected, please contact support for further information.';
            }
        }
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
    }

    /**
     * Handle the UserPlanRequest "deleted" event.
     */
    public function deleted(UserPlanRequest $userPlanRequest): void
    {
        //
    }

    /**
     * Handle the UserPlanRequest "restored" event.
     */
    public function restored(UserPlanRequest $userPlanRequest): void
    {
        //
    }

    /**
     * Handle the UserPlanRequest "force deleted" event.
     */
    public function forceDeleted(UserPlanRequest $userPlanRequest): void
    {
        //
    }
}
