<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class CreateEntity extends ModalComponent
{
    public function render()
    {
        return view('livewire.create-entity');
    }
}
