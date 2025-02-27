<?php

namespace App\Livewire\Website\Pages\Policies;

use Livewire\Attributes\Title;
use Livewire\Component;

class PrivacyPolicy extends Component
{
    #[Title('Privacy Policy')]
    public function render()
    {
        return view('livewire.website.pages.policies.privacy-policy');
    }
}
