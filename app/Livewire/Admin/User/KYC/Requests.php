<?php

namespace App\Livewire\Admin\User\KYC;

use App\Models\UserKyc;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('admin.layouts.admin')]
class Requests extends Component
{
    use Toast;
    use WithPagination;
    public $perPage = 10;

    public $showRejectPanel = false;

    public $rejectMessage = null;
    public $rejectId = null;

    public $showKycModal = false;
    public UserKyc $userKyc;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'user.name', 'label' => 'Name'],
            ['key' => 'user.email', 'label' => 'Email'],
            ['key' => 'status', 'label' => 'KYC Status'],
            ['key' => 'created_at', 'label' => 'Dated'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $data = UserKyc::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.user.k-y-c.requests', [
            'headers' => $headers,
            'data' => $data
        ]);
    }
    public function viewRequest($id)
    {
        try {
            $kyc = UserKyc::find($id);
            $this->userKyc = $kyc;
            $this->showKycModal = true;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
    public function approve($id)
    {
        try {
            $deposit = UserKyc::find($id);
            $deposit->status = 'approved';
            $deposit->save();
            $this->success('Approved successfully.');
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            UserKyc::destroy($id);
            $this->success('Deleted successfully.');
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }
    public function openRejectPanel($id)
    {
        $this->rejectId = $id;
        $this->rejectMessage = null;
        $this->showRejectPanel = true;
    }
    public function closeRejectPanel()
    {
        $this->rejectId = null;
        $this->rejectMessage = null;
        $this->showRejectPanel = false;
    }

    public function reject()
    {
        try {
            $deposit = UserKyc::find($this->rejectId);
            $deposit->status = 'rejected';
            $deposit->reject_notes = $this->rejectMessage ? $this->rejectMessage : null;
            $deposit->save();
            $this->success('Rejected successfully.');
            $this->closeRejectPanel();
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
            $this->closeRejectPanel();
        }
    }
}
