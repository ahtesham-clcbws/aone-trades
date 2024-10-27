<div id="change-plan">
    <x-form-section submit="save">
        <x-slot name="title">
            {{ __('Change Plan Request') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Plan update request will take 24 hours to process') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label class="sr-only" for="package" value="{{ __('Plans') }}" />
                <select id="package" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" {{ $planRequest ? 'disabled' : '' }} wire:model="package" required>
                    <option value="Standard">Standard</option>
                    <option value="Classic">Classic</option>
                    <option value="Expert">Expert</option>
                    <option value="Master">Master</option>
                    <option value="Pro">Pro</option>
                </select>
                @if ($planRequest)
                <div class="mt-4 text-red-600">
                    Account upgrade request for <b>{{ $planRequest->package }}</b> plan already sent on <b>{{ date('d-M-Y h:i A', strtotime($planRequest->created_at)) }}</b> please wait for sometime our executive will get in touch with you.
                </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button type="submit">
                <span class="loading loading-bars loading-xs me-2" {{ $planRequest ? 'disabled' : '' }} wire:loading></span> {{ __('Change') }}
            </x-button>
        </x-slot>
    </x-form-section>

</div>
