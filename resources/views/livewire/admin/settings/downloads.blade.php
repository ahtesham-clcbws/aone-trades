<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Downloads Sections') }}
        </h2>
    </div>

    <x-mary-card>
        <div class="flex justify-end">
            <x-mary-button label="Add Download" class="btn-primary btn-sm" icon="o-plus-circle" title="Add Download" wire:click="openAddForm()" />
        </div>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination show-empty-text>

            @scope('cell_id', $entity)
            {{ $loop->index + 1 }}
            @endscope
            @scope('cell_image', $entity)
            <x-mary-avatar image="{{ '/storage/'.$entity->image }}" />
            @endscope

            @scope('cell_actions', $entity)
            <div class="flex gap-2">
                <x-mary-button icon="o-pencil-square" class="btn-circle btn-sm bg-blue-400 text-white" title="Edit" wire:click="openEdit({{$entity->id}})" />
                <x-mary-button icon="o-trash" class="btn-circle btn-sm btn-error" title="Delete" wire:click="delete({{$entity->id}})"
                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" />
            </div>
            @endscope

        </x-mary-table>
    </x-mary-card>
    <x-mary-modal wire:model="addDownload" class="backdrop-blur" persistent>
        <x-mary-form wire:submit="saveForm" no-separator>
            <x-mary-file wire:model="image" accept="image/*">
                <img src="{{ $image ?? '/img/placeholder.jpeg' }}" class="h-40 rounded-lg" />
            </x-mary-file>
            <x-mary-input label="Title" wire:model="title" inline required />
            <x-mary-textarea label="Details" wire:model="details" max="1000" rows="3" inline required />
            <x-mary-file wire:model="file" label="Downloadable file" accept=".exe,.apk,.zip,.msi,application/vnd.microsoft.portable-executable,application/x-msi,application/x-msdownload,application/x-zip-compressed,application/zip,application/octet-stream" class="*:w-full" />

            <x-slot:actions>
                <x-mary-button label="Save" type="submit" class="btn-primary" spinner="saveForm" />
                <x-mary-button type="button" label="Cancel" @click="$wire.addDownload = false" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
