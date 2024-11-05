<?php

namespace App\Observers;

use App\Mail\AdminNotificationEmail;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\IbPartnerRequest;

class IbPartnerRequestObserver
{
    /**
     * Handle the IbPartnerRequest "created" event.
     */
    public function created(IbPartnerRequest $ibPartnerRequest): void
    {
        // send notification to admin & user
        $user = $ibPartnerRequest->user;

        $message = 'Thanks for requesting for becoming IB Partner, Our exceutive will contact you soon.';
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
        $adminMessage = 'New IB Partner request from: ' . $user->name . ' / ' . $user->email;
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to(env('MAIL_ADMIN_ADDRESS', 'support@aonetrades.com'))->send(new AdminNotificationEmail($adminMessage));
    }

    /**
     * Handle the IbPartnerRequest "updated" event.
     */
    public function updated(IbPartnerRequest $ibPartnerRequest): void
    {
        // send notification to user
        $user = $ibPartnerRequest->user;
        $status = $ibPartnerRequest->status;

        $message = 'Your IB Partner request is accepted.';
        if ($status == 'rejected') {
            $rejectReason = !empty(trim($ibPartnerRequest->reject_notes)) ? $ibPartnerRequest->reject_notes : null;
            if ($rejectReason) {
                $message = 'Your IB Partner request is rejected.<br /><br /> <strong>Reason: </strong>' . $rejectReason;
            } else {
                $message = 'Your IB Partner request is rejected, please contact support for further information.';
            }
        }
        Mail::mailer(env('NOTIFICATION_MAILER', 'smtp'))->to($user)->send(new NotificationEmail($message, $user));
    }

    /**
     * Handle the IbPartnerRequest "deleted" event.
     */
    public function deleted(IbPartnerRequest $ibPartnerRequest): void
    {
        //
    }

    /**
     * Handle the IbPartnerRequest "restored" event.
     */
    public function restored(IbPartnerRequest $ibPartnerRequest): void
    {
        //
    }

    /**
     * Handle the IbPartnerRequest "force deleted" event.
     */
    public function forceDeleted(IbPartnerRequest $ibPartnerRequest): void
    {
        //
    }
}
