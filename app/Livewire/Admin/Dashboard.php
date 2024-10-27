<?php

namespace App\Livewire\Admin;

use App\Models\PageView;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\UserWithdrawl;
use Carbon\Carbon;
use Livewire\Component;

use Livewire\Attributes\Layout;

#[Layout('admin.layouts.admin')]
class Dashboard extends Component
{
    public $uniqueViewsToday = 0;
    public $pendingWithdrawalRequests = 0;
    public $pendingKycRequests = 0;
    public $totalUsers = 0;

    public function mount()
    {
        $today = Carbon::today();
        $this->uniqueViewsToday = PageView::whereDate('created_at', $today)
            ->distinct('session_id')
            ->count('session_id');

        $this->pendingWithdrawalRequests = UserWithdrawl::where('status', 'pending')->count();
        $this->pendingKycRequests = UserKyc::where('status', 'pending')->count();
        $this->totalUsers = User::where('role', 'user')->count();
    }
    public function render()
    {
        // $today = Carbon::today();
        // $thisMonth = Carbon::now()->month;
        // $uniqueViewsToday = PageView::whereDate('created_at', $today)
        //                             ->distinct('session_id')
        //                             ->count('session_id');

        // $uniqueViewsThisMonth = PageView::whereMonth('created_at', $thisMonth)
        //                                 ->distinct('session_id')
        //                                 ->count('session_id');

        // $uniqueViewsAllTime = PageView::distinct('session_id')
        //                               ->count('session_id');

        return view('livewire.admin.dashboard');
    }
}
