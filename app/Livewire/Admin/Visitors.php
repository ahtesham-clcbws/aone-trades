<?php

namespace App\Livewire\Admin;

use App\Models\PageView;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('admin.layouts.admin')]
class Visitors extends Component
{
    public $perPage = 10;
    public array $expanded = [];
    use WithPagination;
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'ip', 'label' => 'IP Address'],
            ['key' => 'country', 'label' => 'Country'],
            ['key' => 'state', 'label' => 'State'],
            ['key' => 'city', 'label' => 'City'],
            ['key' => 'zip', 'label' => 'Zip Code', 'class' => 'hidden'],
            ['key' => 'lat', 'label' => 'Latitude', 'class' => 'hidden'],
            ['key' => 'long', 'label' => 'Longitude', 'class' => 'hidden'],
            ['key' => 'timezone', 'label' => 'Time Zone'],
            ['key' => 'user_agent', 'label' => 'User Agent', 'class' => 'hidden'],
            ['key' => 'created_at', 'label' => 'Date'],
        ];

        $data = PageView::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.visitors', [
            'headers' => $headers,
            'data' => $data
        ]);
    }
}
