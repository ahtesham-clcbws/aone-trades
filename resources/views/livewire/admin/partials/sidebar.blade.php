<x-mary-menu activate-by-route>
    <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('admin.dashboard') }}" />

    <x-mary-menu-separator />

    <x-mary-menu-item title="Deposit Requests" icon="bi.cash-coin" link="{{ route('admin.deposit.requests') }}" :badge="$pendingDeposits" badge-classes="!badge-warning float-right" />
    <x-mary-menu-item title="Withdrawal Requests" icon="bi.cash-stack" link="{{ route('admin.withdrawal.requests') }}" :badge="$pendingWithdrawals" badge-classes="!badge-warning float-right" />

    <x-mary-menu-separator />

    <x-mary-menu-item title="Manage Users" icon="o-users" link="{{ route('admin.user.table') }}" />
    <x-mary-menu-item title="Plan Change Requests" icon="o-light-bulb" link="{{ route('admin.user.plans') }}" :badge="$pendingPlanChange" badge-classes="!badge-warning float-right" />
    <x-mary-menu-item title="KYC Requests" icon="o-identification" link="{{ route('admin.user.kyc.requests') }}" :badge="$pendingKYC" badge-classes="!badge-warning float-right" />
    <x-mary-menu-item title="IB Partner Requests" icon="o-user-group" link="{{ route('admin.user.ibpartner') }}" :badge="$IBPartnerRequests" badge-classes="!badge-warning float-right" />
    <x-mary-menu-item title="Trading Account Requests" icon="o-chart-bar-square" link="{{ route('admin.user.tradingaccount') }}" :badge="$TradingAccountRequests" badge-classes="!badge-warning float-right" />

    <x-mary-menu-separator />

    <x-mary-menu-item title="Help/Support Section" icon="o-lifebuoy" link="{{ route('admin.settings.help') }}" />
    <x-mary-menu-item title="Downloads Section" icon="o-arrow-down-tray" link="{{ route('admin.settings.downloads') }}" />
    <x-mary-menu-item title="Deposit Details" icon="o-information-circle" link="{{ route('admin.settings.deposit-details') }}" />
    <x-mary-menu-item title="View Visitors" icon="o-chart-bar-square" link="{{ route('admin.visitors') }}" />
</x-mary-menu>
