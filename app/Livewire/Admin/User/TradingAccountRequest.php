<?php

namespace App\Livewire\Admin\User;

use App\Models\TradingAccountRequest as ModelsTradingAccountRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('admin.layouts.admin')]
class TradingAccountRequest extends Component
{
    use Toast;
    use WithPagination;
    public $perPage = 10;

    public bool $showRejectPanel = false;

    public $rejectMessage = null;
    public $rejectId = null;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'user.name', 'label' => 'User'],
            ['key' => 'user.package', 'label' => 'Plan'],
            ['key' => 'created_at', 'label' => 'Registration'],
            ['key' => 'status', 'label' => 'KYC Status'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $entities = ModelsTradingAccountRequest::orderBy('id', 'desc')->where('status', '!=', 'approved')->paginate(10);

        return view('livewire.admin.user.trading-account-request', [
            'headers' => $headers,
            'entities' => $entities
        ]);
    }


    public function approve($id)
    {
        try {
            $deposit = ModelsTradingAccountRequest::find($id);
            $deposit->status = 'approved';
            $deposit->save();
            $this->success('Approved successfully.');
        } catch (\Throwable $th) {
            report($th->getMessage());
            throw $th;
            // $this->error($th->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            ModelsTradingAccountRequest::destroy($id);
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
            $planRequest = ModelsTradingAccountRequest::find($this->rejectId);
            $planRequest->status = 'rejected';
            $planRequest->reject_notes = $this->rejectMessage ? $this->rejectMessage : null;
            $planRequest->save();
            $this->success('Rejected successfully.');
            $this->closeRejectPanel();
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
            $this->closeRejectPanel();
        }
    }
}
