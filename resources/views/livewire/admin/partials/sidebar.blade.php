<x-mary-menu activate-by-route>
    <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('admin.dashboard') }}" />

    <x-mary-menu-item title="Deposit Records" icon="o-document-currency-rupee" link="{{ route('admin.deposit.requests') }}" :badge="$pendingDeposits" badge-classes="!badge-warning float-right" />
    <x-mary-menu-item title="Withdrawal Requests" icon="o-circle-stack" link="{{ route('admin.withdrawal.requests') }}" :badge="$pendingWithdrawals" badge-classes="!badge-warning float-right" />

    <x-mary-menu-sub title="User Management" icon="o-users" open>
        <x-mary-menu-item title="Manage Users" link="{{ route('admin.user.table') }}" />
        <x-mary-menu-item title="Plan Change Requests" link="{{ route('admin.user.plans') }}" :badge="$pendingPlanChange" badge-classes="!badge-warning float-right" />
        <x-mary-menu-item title="KYC Requests" link="{{ route('admin.user.kyc.requests') }}" :badge="$pendingKYC" badge-classes="!badge-warning float-right" />
    </x-mary-menu-sub>

    <x-mary-menu-item title="View Visitors" icon="o-chart-bar-square" link="{{ route('admin.visitors') }}" />

    <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
        <x-mary-menu-item title="Help/Support Section" link="{{ route('admin.settings.help') }}" />
        <x-mary-menu-item title="Downloads Section" link="{{ route('admin.settings.downloads') }}" />
    </x-mary-menu-sub>
</x-mary-menu>
