<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class SyntheticIndices extends Component
{
    #[Title('Synthetic Indices')]
    public function render()
    {
        return view('livewire.website.pages.synthetic-indices');
    }
}
