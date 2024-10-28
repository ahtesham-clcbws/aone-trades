<?php

namespace App\Livewire\Admin\Deposit;

use App\Models\UserDeposit;
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
    public array $expanded = [];

    public $showRejectPanel = false;

    public $rejectMessage = null;
    public $rejectId = null;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'user.name', 'label' => 'Name'],
            ['key' => 'user.email', 'label' => 'Email'],
            ['key' => 'amount', 'label' => 'Amount'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Date'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
        $deposits = UserDeposit::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.deposit.requests', [
            'headers' => $headers,
            'deposits' => $deposits
        ]);
    }

    public function approve($id)
    {
        try {
            $deposit = UserDeposit::find($id);
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
            UserDeposit::destroy($id);
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
            $deposit = UserDeposit::find($this->rejectId);
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
