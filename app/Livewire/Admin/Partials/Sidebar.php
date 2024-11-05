<?php

namespace App\Livewire\Admin\Partials;

use App\Models\IbPartnerRequest;
use App\Models\TradingAccountRequest;
use App\Models\UserDeposit;
use App\Models\UserKyc;
use App\Models\UserPlanRequest;
use App\Models\UserWithdrawl;
use Livewire\Component;

class Sidebar extends Component
{
    public $pendingDeposits = false;
    public $pendingWithdrawals = false;
    public $pendingPlanChange = false;
    public $pendingKYC = false;
    public $IBPartnerRequests = false;
    public $TradingAccountRequests = false;
    public function mount()
    {
        $this->pendingDeposits = UserDeposit::where('status', 'pending')->select('id')->count();
        $this->pendingWithdrawals = UserWithdrawl::where('status', 'pending')->select('id')->count();
        $this->pendingPlanChange = UserPlanRequest::where('status', 'pending')->select('id')->count();
        $this->pendingKYC = UserKyc::where('status', 'pending')->select('id')->count();
        $this->IBPartnerRequests = IbPartnerRequest::where('status', 'pending')->select('id')->count();
        $this->TradingAccountRequests = TradingAccountRequest::where('status', 'pending')->select('id')->count();
    }
    public function render()
    {
        return view('livewire.admin.partials.sidebar');
    }
}
