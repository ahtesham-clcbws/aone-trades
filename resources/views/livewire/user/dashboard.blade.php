<div>
    <div class="">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </div>
    <div class="my-4">
        <x-mary-card>
            <x-slot:title>
                Welcome, {{ auth()->user()->name }}!
            </x-slot:title>
            Trade With Worldclass Forex Trading Company.
        </x-mary-card>
    </div>
    <div class="my-4 grid gap-4 md:grid-cols-3">

        <x-mary-card>
            <div class="flex flex-col gap-4">
                <div class="flex gap-3">
                    <x-mary-icon name="o-user" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
                    <div>
                        <p class="text-2xl font-bold mb-3">Manage Account</p>
                        <p class="test-gray-700">Manage Your Account at Your Fingertips.</p>
                    </div>
                </div>
                <x-mary-button label="View" class="btn-outline btn-sm" link="{{ route('user.account.profile') }}" />
            </div>
        </x-mary-card>

        <x-mary-card>
            <div class="flex flex-col gap-4">
                <div class="flex gap-3">
                    <x-mary-icon name="o-circle-stack" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
                    <div>
                        <p class="text-2xl font-bold mb-3">Manage Funds</p>
                        <p class="test-gray-700">Manage Your Hard Earned Money With Us.</p>
                    </div>
                </div>
                <x-mary-button label="View" class="btn-outline btn-sm" link="{{ route('user.fund.deposit') }}" />
            </div>
        </x-mary-card>

        <x-mary-card>
            <div class="flex flex-col gap-4">
                <div class="flex gap-3">
                    <x-mary-icon name="o-lifebuoy" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
                    <div>
                        <p class="text-2xl font-bold mb-3">Help</p>
                        <p class="test-gray-700">Get Your Queries Resolved Within Minutes.</p>
                    </div>
                </div>
                <x-mary-button label="View" class="btn-outline btn-sm" link="{{ route('user.help') }}" />
            </div>
        </x-mary-card>

    </div>
</div>
