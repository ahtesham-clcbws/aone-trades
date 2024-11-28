<div>
    <div class="mb-3">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Downloads') }}
        </h2>
    </div>
    <div class="grid md:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach ($downloads as $download)
        <div class="bg-white shadow rounded-lg flex flex-col justify-between overflow-hidden">
            <div class="w-full">
                <img src="/storage/{{$download->image}}" class="w-full h-44 object-cover" />
                <div class="p-4">
                    <h4 class="text-xl font-semibold mb-3">{{ $download->title }}</h4>
                    <div class="break-all">{{ $download->details }}</div>
                </div>
            </div>
            <div class="bg-primary">
                <a class="w-full h-12 flex items-center justify-center gap-2 text-lg font-semibold" href="/storage/{{$download->file}}" target="_blank">
                <x-mary-icon name="o-arrow-down-tray" class="w-5 h-5" /> Download
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
