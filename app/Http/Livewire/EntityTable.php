<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use Illuminate\Support\Collection;
use Livewire\Component;

class EntityTable extends Component
{
    /**
     * @var Collection<Entity>
     */
    public Collection $entities;

    public function mount(): void
    {
        $this->entities = request()->team()->entities;
    }

    public function render()
    {
        return view('livewire.entity-table');
    }
}
