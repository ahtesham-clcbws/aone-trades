<div class="grid gap-4">
    <div class="">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </div>
    <div>
        <x-mary-card>
            <x-slot:title>
                Welcome, {{ auth()->user()->name }}!
            </x-slot:title>
            Manage all the data of your clients on your finger tips.
        </x-mary-card>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.visitors') }}">
            <x-mary-card class="w-full h-full">
                <div class="flex flex-col justify-center items-center gap-3 relative min-h-40 text-center">
                    <x-mary-icon name="s-users" class="w-40 text-primary/25 absolute inset-0 mx-auto" />
                    <p class="font-semibold uppercase">Total Visitors<br />Today</p>
                    <p class="font-semibold text-5xl">{{ $uniqueViewsToday }}</p>
                </div>
            </x-mary-card>
        </a>
        <a href="{{ route('admin.withdrawal.requests') }}">
            <x-mary-card class="w-full h-full">
                <div class="flex flex-col justify-center items-center gap-3 relative min-h-40 text-center">
                    <x-mary-icon name="s-users" class="w-40 text-primary/25 absolute inset-0 mx-auto" />
                    <p class="font-semibold uppercase">Pending Withdrawal<br />Requests</p>
                    <p class="font-semibold text-5xl">{{ $pendingWithdrawalRequests }}</p>
                </div>
            </x-mary-card>
        </a>
        <a href="{{ route('admin.user.kyc.requests') }}">
            <x-mary-card class="w-full h-full">
                <div class="flex flex-col justify-center items-center gap-3 relative min-h-40 text-center">
                    <x-mary-icon name="s-users" class="w-40 text-primary/25 absolute inset-0 mx-auto" />
                    <p class="font-semibold uppercase">Pending KYC<br />Requests</p>
                    <p class="font-semibold text-5xl">{{ $pendingKycRequests }}</p>
                </div>
            </x-mary-card>
        </a>
        <a href="{{ route('admin.user.table') }}">
            <x-mary-card class="w-full h-full">
                <div class="flex flex-col justify-center items-center gap-3 relative min-h-40 text-center">
                    <x-mary-icon name="s-users" class="w-40 text-primary/25 absolute inset-0 mx-auto" />
                    <p class="font-semibold uppercase">Total<br />Clients/Users</p>
                    <p class="font-semibold text-5xl">{{ $totalUsers }}</p>
                </div>
            </x-mary-card>
        </a>
    </div>
</div>
