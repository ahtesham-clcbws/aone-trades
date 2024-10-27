<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class LogIn extends Component
{
    #[Title('Login')]
    public function render()
    {
        return view('livewire.website.pages.log-in');
    }
}
