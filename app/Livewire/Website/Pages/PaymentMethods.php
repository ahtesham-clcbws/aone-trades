<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class PaymentMethods extends Component
{
    #[Title('Payment Methods')]
    public function render()
    {
        return view('livewire.website.pages.payment-methods');
    }
}
