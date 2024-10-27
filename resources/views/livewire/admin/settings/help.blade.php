<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Help Sections') }}
        </h2>
    </div>

    <x-mary-card>
        <div class="flex justify-end">
            <x-mary-button label="Add FAQ" class="btn-primary btn-sm" icon="o-plus-circle" title="Add FAQ" wire:click="openAddForm()" />
        </div>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination>

            @scope('cell_id', $entity)
            {{ $loop->index + 1 }}
            @endscope
            @scope('cell_section', $entity)
            <div class="flex gap-2">
                @if ($entity->in_help)
                <x-mary-badge value="Help" class="badge-primary" />
                @endif
                @if ($entity->in_kyc)
                <x-mary-badge value="KYC" class="badge-secondary" />
                @endif
            </div>
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
    <x-mary-modal wire:model="addFaq" class="backdrop-blur" persistent>
        <x-mary-form wire:submit="saveForm" no-separator>
            <x-mary-select label="Master user" icon="o-user" :options="$categories" wire:model="category" inline />
            <div class="flex gap-4">
                <x-mary-checkbox label="Help Section" wire:model="in_help" hint="Click to show in help section" />
                <x-mary-checkbox label="KYC Section" wire:model="in_kyc" hint="Click to show in KYC page" />
            </div>
            <x-mary-input label="Question" wire:model="question" inline />
            <x-mary-editor label="Answer" wire:model="answer" disk="public" folder="faq/images" :config="$editorConfig" class="border-primary *:border-primary" />

            <x-slot:actions>
                <x-mary-button label="Save" type="submit" class="btn-primary" spinner="saveForm" />
                <x-mary-button type="button" label="Cancel" @click="$wire.addFaq = false" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
