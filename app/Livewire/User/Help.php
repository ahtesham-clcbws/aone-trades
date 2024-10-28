<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Help as HelpModel;

use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Help extends Component
{
    public string $group = 'group1';

    public $kycInformationBlock = [];
    public $documentInformationBlock = [];
    public $generalInformationBlock = [];
    public $accountInformationBlock = [];

    public function mount()
    {
        $this->kycInformationBlock = HelpModel::where('help_category_id', 1)->where('in_help', true)->get();
        $this->documentInformationBlock = HelpModel::where('help_category_id', 2)->where('in_help', true)->get();
        $this->generalInformationBlock = HelpModel::where('help_category_id', 3)->where('in_help', true)->get();
        $this->accountInformationBlock = HelpModel::where('help_category_id', 4)->where('in_help', true)->get();
    }
    public function render()
    {
        return view('livewire.user.help');
    }
}
