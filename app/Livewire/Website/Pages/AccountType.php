<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class AccountType extends Component
{
    #[Title('Account Type')]
    public function render()
    {
        return view('livewire.website.pages.account-type');
    }
}
