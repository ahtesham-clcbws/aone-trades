<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Know your customer (KYC)') }}
        </h2>
    </div>
    <div class="grid md:grid-cols-3 gap-3">
        <div class="md:col-span-2">
            @if ($kycSubmitted && $kycStatus == 'approved')
            <x-mary-card>
                <div class="w-full flex gap-4 items-center">
                    <img src="/img/kyc-verified.gif" alt="KYC Verified" class="" />
                    <h2 class="font-semibold text-4xl text-gray-800">Congratulations you are compliant.</h2>
                </div>
            </x-mary-card>
            @endif
            @if ($kycSubmitted && $kycStatus == 'pending')
            <x-mary-card>
                <div class="w-full flex gap-4 items-center">
                    <img src="/img/kyc-review.gif" alt="KYC under review" class="" />
                    <h2 class="font-semibold text-2xl text-gray-800">KYC details submitted successfully and are under review.</h2>
                </div>
            </x-mary-card>
            @endif
            @if ($showKycForm)
            <div>
                @if ($kycSubmitted && $kycStatus == 'rejected')
                <x-mary-card class="mb-3">
                    <div class="w-full flex gap-4 items-center">
                        <img src="/img/kyc-rejected.gif" alt="KYC under review" class="" />
                        <div>
                            <h2 class="font-bold text-2xl text-red-600">KYC details rejected.</h2>
                            @if ($userKyc && $userKyc->reject_notes)
                            <p class="text-red-600"><b>Reject Reason:</b> {{ $userKyc->reject_notes }}</p>
                            @endif
                        </div>
                    </div>
                </x-mary-card>
                @endif
                <x-mary-card>
                    <x-mary-form wire:submit="save">

                        <div class="input input-primary grid md:grid-cols-2 items-center gap-3 p-0 overflow-hidden">
                            <label class="text-gray-400 ps-4 leading-none">Attach Pancard</label>
                            <x-mary-file wire:model="pancard_proof" accept="image/*" class="*:w-full *:border-0 m-0 *:-m-0.5 *:!rounded-none" required />
                        </div>

                        <div class="input input-primary grid md:grid-cols-2 items-center gap-3 p-0 overflow-hidden">
                            <label class="text-gray-400 ps-4 leading-none">
                                Attach Address Proof (Front)
                            </label>
                            <x-mary-file wire:model="address_proof" accept="image/*" class="*:w-full *:border-0 m-0 *:-m-0.5 *:!rounded-none" required />
                        </div>
                        <div class="input input-primary grid md:grid-cols-2 items-center gap-3 p-0 overflow-hidden">
                            <label class="text-gray-400 ps-4 leading-none">
                                Attach Address Proof (Back)
                            </label>
                            <x-mary-file wire:model="address_proof_back" accept="image/*" class="*:w-full *:border-0 m-0 *:-m-0.5 *:!rounded-none" required />
                        </div>
                        <div>
                            <x-mary-button label="Submit KYC" class="btn-primary" type="submit" spinner="save" />
                        </div>
                    </x-mary-form>
                </x-mary-card>
            </div>
            @endif
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
        </div>
    </div>
    <livewire:user.support-section />
</div>
