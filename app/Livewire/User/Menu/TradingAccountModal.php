<?php

namespace App\Livewire\User\Menu;

use App\Models\TradingAccountRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Component;
use Mary\Traits\Toast;

class TradingAccountModal extends Component
{
    use Toast;
    public $openTradingAccountModal;

    public $tradingAccountRequest = null;
    public $IsTradingAccount = false;

    public $userId;

    public function  mount(#[CurrentUser()] User $user)
    {
        $this->userId = $user->id;
        $this->IsTradingAccount = $user->IsTradingAccount;
        $this->tradingAccountRequest = $user->trading_account_request;
    }
    public function render()
    {
        return view('livewire.user.menu.trading-account-modal');
    }
    public function confirmTradingAccount()
    {
        try {
            $tradingAccountRequest = new TradingAccountRequest();
            $tradingAccountRequest->user_id = $this->userId;
            $tradingAccountRequest->save();

            $this->success('Request send successfully.');
            $this->js('window.location.reload()');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
