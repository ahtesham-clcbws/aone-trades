<?php

namespace App\Livewire\User\Menu;

use App\Models\IbPartnerRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Mary\Traits\Toast;

class IBPartnerModal extends Component
{
    use Toast;
    public $openConfirmModal;

    public $IbPartnerRequest = null;
    public $IsIBPartner = false;

    public $userId;

    public function  mount(#[CurrentUser] User $user)
    {
        $this->userId = $user->id;
        $this->IsIBPartner = $user->IsIBPartner;
        $this->IbPartnerRequest = $user->ib_partnet_request;
    }

    public function render()
    {
        return view('livewire.user.menu.i-b-partner-modal');
    }

    public function confirmIBPartner()
    {
        try {
            $IbPartnerRequest = new IbPartnerRequest();
            $IbPartnerRequest->user_id = $this->userId;
            $IbPartnerRequest->save();

            $this->success('Request send successfully.');
            $this->js('window.location.reload()');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
