<div>
    <div class="row justify-content-between">
        <div class="col-auto order-last order-md-first">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
                <input type="search" class="form-control" placeholder="{{ __('Search') }}" wire:model="search">
            </div>
        </div>
        <div class="col-md-auto mb-3">
            <button class="bg bg-indigo-400" onclick="Livewire.emit('openModal', 'create-entity')">Create Entity</button>
        </div>
    </div>
    <div class="mb-3">
        @if($entities->isEmpty())
            <div class="card-body">
                {{ __('You have no entities. Need help creating your first entity?') }}
            </div>
        @else
            <div>
                <div>
                    <table class="border-collapse border border-slate-500 mb-0">
                        <caption class="caption-top">
                            Lorem ipsum delor
                        </caption>
                        <thead class="font-semibold">
                        <tr>
                            @foreach(['ID', 'Name', 'Description', 'Created At'] as $column)
                                <th class="border border-slate-600 align-middle text-nowrap border-top-0">
                                    {{ $column }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                            <tr>
                                @foreach(['ulid', 'name', 'description', 'created_at'] as $column)
                                    <td class="border border-slate-700">
                                        {{ $entity->$column }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
