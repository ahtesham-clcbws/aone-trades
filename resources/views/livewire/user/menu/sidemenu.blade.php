<div>
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-slate-50">

        @if($user = auth()->user())
        <x-mary-list-item :item="$user" value="name" avatar="profile_photo_url" no-separator no-hover class="pt-2">
            <x-slot:sub-value>
                <x-mary-badge value="{{$user->getKycStatusBadgeData()['value']}}" class="{{$user->getKycStatusBadgeData()['class']}}" />
            </x-slot:sub-value>
            <x-slot:actions>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate type="submit" />
                </form>
            </x-slot:actions>
        </x-mary-list-item>

        <x-mary-menu-separator />
        @endif

        <x-mary-menu activate-by-route>
            <x-mary-menu-item title="Home" icon="o-home" link="{{ route('user.dashboard') }}" />

            <x-mary-menu-sub title="Manage Funds" icon="o-circle-stack">
                <x-mary-menu-item title="Deposit" link="{{ route('user.fund.deposit') }}" />
                <x-mary-menu-item title="Withdraw" link="{{ route('user.fund.withdraw') }}" />
            </x-mary-menu-sub>

            <x-mary-menu-item title="Deposit History" icon="o-bars-arrow-up" link="{{ route('user.history.deposit') }}" />
            <x-mary-menu-item title="Withdraw History" icon="o-bars-arrow-down" link="{{ route('user.history.withdraw') }}" />

            <x-mary-menu-sub title="Manage Account" icon="o-user">
                <x-mary-menu-item title="Personal Details" link="{{ route('profile.show') }}" />
                <x-mary-menu-item title="Address Details" link="{{ route('user.account.address') }}" />
                <x-mary-menu-item title="Bank Info" link="{{ route('user.account.bank') }}" />
            </x-mary-menu-sub>

            <x-mary-menu-item title="KYC" icon="o-identification" link="{{ route('user.account.kyc') }}" />

            <x-mary-menu-item title="Request for IB Partner" icon="o-user-group" onclick="openConfirmModal.showModal()" />

            <x-mary-menu-item title="Downloads" icon="o-arrow-down-tray" link="{{ route('user.downloads') }}" />

            <x-mary-menu-item title="Help" icon="o-lifebuoy" link="{{ route('user.help') }}" />
        </x-mary-menu>

    </x-slot:sidebar>
</div>
