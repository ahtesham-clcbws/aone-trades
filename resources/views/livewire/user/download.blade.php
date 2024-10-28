<div>
    <div class="mb-3">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Downloads') }}
        </h2>
    </div>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($downloads as $download)
        <x-mary-card>
            <h4 class="text-xl font-semibold mb-3">{{ $download->title }}</h4>
            {{ $download->details }}
            <x-slot:figure>
                <img src="/storage/{{$download->image}}" class="p-5 object-contain max-w-56 mx-auto" />
            </x-slot:figure>
            <x-mary-button label="Download" class="btn-primary mt-5 w-full btn-sm" />
        </x-mary-card>
        @endforeach
    </div>
</div>
