<?php

namespace App\Observers;

use App\Mail\AdminNotificationEmail;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserDeposit;

class UserDepositObserver
{
    /**
     * Handle the UserDeposit "created" event.
     */
    public function created(UserDeposit $userDeposit): void
    {
        // send notification to admin & user
        $user = $userDeposit->user;

        $message = 'Thanks for depositing, you will notify once your deposit is approved.';
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
        $adminMessage = 'New Deposit request from: ' . $user->name . ' / ' . $user->email;
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to(env('MAIL_ADMIN_ADDRESS', 'support@aonetrades.com'))->send(new AdminNotificationEmail($adminMessage));
    }

    /**
     * Handle the UserDeposit "updated" event.
     */
    public function updated(UserDeposit $userDeposit): void
    {
        // send notification to user
        $user = $userDeposit->user;
        $status = $userDeposit->status;

        $message = 'Your Deposit request is verify & accepted.';
        if ($status == 'rejected') {
            $rejectReason = !empty(trim($userDeposit->reject_notes)) ? $userDeposit->reject_notes : null;
            if ($rejectReason) {
                $message = 'Your Deposit request is rejected.<br /><br /> <strong>Reason: </strong>' . $rejectReason;
            } else {
                $message = 'Your Deposit request is rejected, please contact support for further information.';
            }
        }
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
    }

    /**
     * Handle the UserDeposit "deleted" event.
     */
    public function deleted(UserDeposit $userDeposit): void
    {
        //
    }

    /**
     * Handle the UserDeposit "restored" event.
     */
    public function restored(UserDeposit $userDeposit): void
    {
        //
    }

    /**
     * Handle the UserDeposit "force deleted" event.
     */
    public function forceDeleted(UserDeposit $userDeposit): void
    {
        //
    }
}
