<?php

namespace App\Livewire\Admin\User;

use App\Models\UserPlanRequest;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('admin.layouts.admin')]
class PlanChangeRequest extends Component
{
    use WithPagination;
    public $perPage = 10;
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'user.name', 'label' => 'Name'],
            ['key' => 'user.email', 'label' => 'Email'],
            ['key' => 'user.package', 'label' => 'Current Plan'],
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
}
