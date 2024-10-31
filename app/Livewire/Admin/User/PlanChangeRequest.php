<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserPlanRequest;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('admin.layouts.admin')]
class PlanChangeRequest extends Component
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
            ['key' => 'user.name', 'label' => 'Name'],
            ['key' => 'current_package', 'label' => 'Current Plan'],
            ['key' => 'package', 'label' => 'Requested Plan'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Requested'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $data = UserPlanRequest::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.user.plan-change-request', [
            'headers' => $headers,
            'data' => $data
        ]);
    }

    public function approve($id)
    {
        try {
            $planRequest = UserPlanRequest::find($id);
            $requestedPlan = $planRequest->package;
            $userId = $planRequest->user_id;

            $user = User::find($userId);
            $user->package = $requestedPlan;
            $user->save();
            // send notification to user email
            $planRequest->status = 'approved';
            $planRequest->save();
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
            UserPlanRequest::destroy($id);
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
            $planRequest = UserPlanRequest::find($this->rejectId);
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
