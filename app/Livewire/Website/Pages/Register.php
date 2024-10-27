<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    #[Title('Register')]
    public function render()
    {
        return view('livewire.website.pages.register');
    }
}
