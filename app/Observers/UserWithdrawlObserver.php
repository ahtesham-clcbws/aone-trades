<?php

namespace App\Observers;

use App\Mail\AdminNotificationEmail;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserWithdrawl;

class UserWithdrawlObserver
{
    /**
     * Handle the UserWithdrawl "created" event.
     */
    public function created(UserWithdrawl $userWithdrawl): void
    {
        // send notification to admin & user
        $user = $userWithdrawl->user;

        $message = 'Withdrawal request is submitted successfull, you will notify once your withdrawal is approved.';
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
        $adminMessage = 'New Withdrawal request from: ' . $user->name . ' / ' . $user->email;
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to(env('MAIL_ADMIN_ADDRESS', 'support@aonetrades.com'))->send(new AdminNotificationEmail($adminMessage));
    }

    /**
     * Handle the UserWithdrawl "updated" event.
     */
    public function updated(UserWithdrawl $userWithdrawl): void
    {
        // send notification to user
        $user = $userWithdrawl->user;
        $status = $userWithdrawl->status;

        $message = 'Your Withdrawl request is verify & accepted.';
        if ($status == 'rejected') {
            $rejectReason = !empty(trim($userWithdrawl->reject_notes)) ? $userWithdrawl->reject_notes : null;
            if ($rejectReason) {
                $message = 'Your Withdrawl request is rejected.<br /><br /> <strong>Reason: </strong>' . $rejectReason;
            } else {
                $message = 'Your Withdrawl request is rejected, please contact support for further information.';
            }
        }
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
    }

    /**
     * Handle the UserWithdrawl "deleted" event.
     */
    public function deleted(UserWithdrawl $userWithdrawl): void
    {
        //
    }

    /**
     * Handle the UserWithdrawl "restored" event.
     */
    public function restored(UserWithdrawl $userWithdrawl): void
    {
        //
    }

    /**
     * Handle the UserWithdrawl "force deleted" event.
     */
    public function forceDeleted(UserWithdrawl $userWithdrawl): void
    {
        //
    }
}
