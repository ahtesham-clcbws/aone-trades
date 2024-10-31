<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Help Center') }}
        </h2>
    </div>
    <div>
        <div class="grid gap-3">
            @if (count($kycInformationBlock))
            <x-mary-card>
                <p class="text-2xl font-bold mb-3">KYC Information</p>
                <x-mary-accordion class="*:border-0 divide-y">
                    @foreach ($kycInformationBlock as $info)
                    <x-mary-collapse name="kyc_{{ $info->id }}">
                        <x-slot:heading class="!text-base !ps-0">{{ $info->question }}</x-slot:heading>
                        <x-slot:content class="!text-sm !px-0">{{ $info->answer }}</x-slot:content>
                    </x-mary-collapse>
                    @endforeach
                </x-mary-accordion>
            </x-mary-card>
            @endif
            @if (count($documentInformationBlock))
            <x-mary-card>
                <p class="text-2xl font-bold mb-3">Documents Information</p>
                <x-mary-accordion class="*:border-0 divide-y">
                    @foreach ($documentInformationBlock as $info)
                    <x-mary-collapse name="document_{{ $info->id }}">
                        <x-slot:heading class="!text-base !ps-0">{{ $info->question }}</x-slot:heading>
                        <x-slot:content class="!text-sm !px-0">{{ $info->answer }}</x-slot:content>
                    </x-mary-collapse>
                    @endforeach
                </x-mary-accordion>
            </x-mary-card>
            @endif
            @if (count($generalInformationBlock))
            <x-mary-card>
                <p class="text-2xl font-bold mb-3">General Information</p>
                <x-mary-accordion class="*:border-0 divide-y">
                    @foreach ($generalInformationBlock as $info)
                    <x-mary-collapse name="general_{{ $info->id }}">
                        <x-slot:heading class="!text-base !ps-0">{{ $info->question }}</x-slot:heading>
                        <x-slot:content class="!text-sm !px-0">{{ $info->answer }}</x-slot:content>
                    </x-mary-collapse>
                    @endforeach
                </x-mary-accordion>
            </x-mary-card>
            @endif
        </div>
        <livewire:user.support-section />
    </div>
</div>
