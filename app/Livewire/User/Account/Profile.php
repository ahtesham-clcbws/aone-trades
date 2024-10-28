<?php

namespace App\Livewire\User\Account;

use App\Models\User;
use App\Models\UserTransferDetail;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

#[Layout('layouts.app')]
class Profile extends Component
{
    use Toast;

    public $editDetails = null;
    public $openAddDetailsForm = false;
    public $planRequest = null;
    public $transferDetails = [];
    public $transferTypeAlreadyAdded = []; // Bank, UPI, USDT
    public $typeOptions = [
        [
            'id' => 'Bank',
            'name' => 'Bank'
        ],
        [
            'id' => 'UPI',
            'name' => 'UPI'
        ],
        [
            'id' => 'USDT',
            'name' => 'USDT'
        ]
    ];
    public $activeOptions = [
        [
            'id' => false,
            'name' => 'InActive'
        ],
        [
            'id' => true,
            'name' => 'Active'
        ]
    ];

    public $type = null;
    public $address = null;
    public $bank_name = null;
    public $bank_branch = null;
    public $ifsc_code = null;
    public $isActive = true;

    public function mount()
    {
        $this->getInitialData();
    }
    public function getInitialData(){
        $user = Auth::user();
        if ($user->pendingPlanRequests && count($user->pendingPlanRequests)) {
            $this->planRequest = $user->pendingPlanRequests[0];
        }
        $this->transferDetails = $user->transfer_details;
        if (count($user->transfer_details)) {
            foreach ($user->transfer_details as $transfer_detail) {
                $this->transferTypeAlreadyAdded[] = $transfer_detail->type;
            }
            foreach ($this->typeOptions as $key => $typeOption) {
                if (in_array($typeOption['name'], $this->transferTypeAlreadyAdded)) {
                    $this->typeOptions[$key] = [
                        'id' => $typeOption['id'],
                        'name' => $typeOption['name'],
                        'disabled' => true
                    ];
                } else {
                    $this->typeOptions[$key] = [
                        'id' => $typeOption['id'],
                        'name' => $typeOption['name'],
                        'disabled' => false
                    ];
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.user.account.profile');
    }

    public function resetForm()
    {
        $this->editDetails = null;
        $this->type = null;
        $this->address = null;
        $this->bank_name = null;
        $this->bank_branch = null;
        $this->ifsc_code = null;
        $this->isActive = true;
    }

    public function addDetails($id = null)
    {
        $this->resetForm();
        $this->openAddDetailsForm = true;
    }
    public function closeModal()
    {
        $this->resetForm();
        $this->openAddDetailsForm = false;
    }

    public function save(#[CurrentUser] User $user)
    {
        if ($this->editDetails) {
            return $this->update();
        }
        return $this->store($user);
    }
    public function store(#[CurrentUser] User $user)
    {
        try {
            $newDetails = new UserTransferDetail();
            $newDetails->user_id = $user->id;
            $newDetails->type = $this->type;
            $newDetails->address = $this->address;
            $newDetails->bank_name = $this->bank_name;
            $newDetails->bank_branch = $this->bank_branch;
            $newDetails->ifsc_code = $this->ifsc_code;
            $newDetails->isActive = true;
            $newDetails->save();
            $this->resetForm();
            $this->openAddDetailsForm = false;
            $this->success('Details successfully added.');
            $this->getInitialData();
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }
    public function update()
    {
        try {
            $this->editDetails->type = $this->type;
            $this->editDetails->address = $this->address;
            $this->editDetails->bank_name = $this->bank_name;
            $this->editDetails->bank_branch = $this->bank_branch;
            $this->editDetails->ifsc_code = $this->ifsc_code;
            $this->editDetails->isActive = true;
            $this->editDetails->save();
            $this->resetForm();
            $this->openAddDetailsForm = false;
            $this->success('Details updated successfully.');
            $this->getInitialData();
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }
}
