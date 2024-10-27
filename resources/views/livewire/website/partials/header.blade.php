<header>
    <div class="uk-section uk-padding-remove-vertical {{ request()->routeIs('homepage') ? 'in-header-inverse': 'in-header-inner uk-background-cover uk-background-top-center' }}"
    style="<?= request()->routeIs('homepage')  ? '' : 'background-image: url(/img/in-wave-background-1.png)' ?>">
        <nav class="uk-navbar-container uk-navbar-transparent {{ request()->routeIs('homepage') ? '' : 'uk-sticky' }}"
            data-uk-sticky="show-on-up: true; top: 80; animation: uk-animation-fade">
            <div class="uk-container" data-uk-navbar>
                <div class="uk-navbar-left uk-width-expand uk-flex uk-flex-between">
                    <a class="uk-navbar-item uk-logo" href="{{ route('homepage') }}">
                        <img src="/img/logo.png" alt="logo" width="269">
                    </a>
                    <ul class="uk-navbar-nav uk-visible@m">
                        <li><a href="{{ route('homepage') }}">Home</a></li>

                        </li>
                        <li><a href="{{ route('info') }}">Info </a></li>
                        <li><a href="#">Trading Platform<span data-uk-navbar-parent-icon></span></a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a href="{{ route('accountType') }}">Account Type</a></li>
                                    <li><a href="https://trade.mtapi.xyz/">Web Trader</a></li>
                                    <li><a href="base.apk">MT5 Android</a></li>

                                </ul>
                            </div>
                        </li>
                        <li><a href="{{ route('ibPartner') }}">IB Partners</a>
                        </li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="uk-navbar-right uk-width-auto">
                    <div class="uk-navbar-item uk-visible@m">
                        <div class="in-optional-nav">
                            @if (auth()->user())
                                @if (auth()->user()->role == 'user')
                                <a href="{{ route('user.dashboard') }}" class="uk-button uk-button-text"><i class="fas fa-user-circle uk-margin-small-right"></i>Dashboard</a>
                                @else
                                <a href="{{ route('admin.dashboard') }}" class="uk-button uk-button-text"><i class="fas fa-user-circle uk-margin-small-right"></i>Admin Panel</a>
                                @endif
                            @else
                            <a href="{{ route('login') }}" class="uk-button uk-button-text"><i class="fas fa-user-circle uk-margin-small-right"></i>Log in</a>
                            <a href="{{ route('register') }}" class="uk-button uk-button-primary uk-button-small uk-border-pill">Sign Up</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="uk-container">
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <div class="uk-card uk-card-secondary uk-card-small uk-card-body uk-border-rounded">
                        <div class="uk-grid uk-text-small" data-uk-grid>
                            <div class="uk-width-3-4@m uk-visible@m">
                                <p>Trading involves substantial risk and may result in the loss of your invested/greater that your invested capital, respectively.</p>
                            </div>
                            <div class="uk-width-expand@m uk-text-center uk-text-right@m">

                                <a href="#"><i class="fas fa-envelope uk-margin-small-right uk-margin-small-left"></i> info@Aonetrades.com</a>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!request()->routeIs('homepage'))
                <div class="uk-section uk-padding-remove-vertical in-wave-breadcrumb">
                    <div class="uk-container">
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <ul class="uk-breadcrumb">
                                    <li><a href="/">Home</a></li>
                                    <li><span>{{ isset($title) && $title ? $title : '' }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</header>
