<?php

namespace App\Observers;

use App\Mail\AdminNotificationEmail;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserKyc;

class UserKycObserver
{
    /**
     * Handle the UserKyc "created" event.
     */
    public function created(UserKyc $userKyc): void
    {
        // send notification to admin & user
        $user = $userKyc->user;

        $message = 'KYC submitted, you will notify once your KYC is approved.';
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
        $adminMessage = 'New KYC request from: ' . $user->name . ' / ' . $user->email;
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to(env('MAIL_ADMIN_ADDRESS', 'support@aonetrades.com'))->send(new AdminNotificationEmail($adminMessage));
    }

    /**
     * Handle the UserKyc "updated" event.
     */
    public function updated(UserKyc $userKyc): void
    {
        $status = $userKyc->status;
        $user = $userKyc->user;
        if ($status == 'pending') {
            $message = 'KYC re-submitted, you will notify once your KYC is approved.';
            Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
            $adminMessage = 'Re-Submit KYC request from: ' . $user->name . ' / ' . $user->email;
            Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to(env('MAIL_ADMIN_ADDRESS', 'support@aonetrades.com'))->send(new AdminNotificationEmail($adminMessage));
        } else {
            $message = 'Your KYC request is verify & accepted.';
            if ($status == 'rejected') {
                $rejectReason = !empty(trim($userKyc->reject_notes)) ? $userKyc->reject_notes : null;
                if ($rejectReason) {
                    $message = 'Your KYC request is rejected.<br /><br /> <strong>Reason: </strong>' . $rejectReason;
                } else {
                    $message = 'Your KYC request is rejected, please contact support for further information.';
                }
            }
            Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
        }
    }

    /**
     * Handle the UserKyc "deleted" event.
     */
    public function deleted(UserKyc $userKyc): void
    {
        //
    }

    /**
     * Handle the UserKyc "restored" event.
     */
    public function restored(UserKyc $userKyc): void
    {
        //
    }

    /**
     * Handle the UserKyc "force deleted" event.
     */
    public function forceDeleted(UserKyc $userKyc): void
    {
        //
    }
}
