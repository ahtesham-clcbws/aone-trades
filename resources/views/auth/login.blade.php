<x-guest-layout>

    <div class="uk-text-center in-padding-horizontal@s">
        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession
        <a class="uk-logo" href="index.html">
            <img src="img/w-logo.png" data-src="img/w-logo.png" alt="logo" width="269" height="23"
                data-uk-img="" />
        </a>
        <p class="uk-text-lead uk-margin-small-top uk-margin-medium-bottom">
            Log into your account
        </p>
        <!-- login form begin -->
        <form class="uk-grid uk-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="Email Id" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Password" />
            </div>
            <div class="uk-margin-small uk-width-auto uk-text-small">
                <label for="remember_me">
                    <input type="checkbox" class="uk-checkbox" id="remember_me" name="remember" />
                    Remember me
                </label>
            </div>
            @if (Route::has('password.request'))
            <div class="uk-margin-small uk-width-expand uk-text-small">
                <label class="uk-align-right"><a class="uk-link-reset" href="{{ route('password.request') }}">Forgot password?</a></label>
            </div>
            @endif
            <div class="uk-margin-small uk-width-1-1">
                <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                    type="submit" name="submit">
                    Sign in
                </button>
            </div>
        </form>
        <span class="uk-text-small">Don't have an account?
            <a href="{{ route('register') }}">Register here</a></span>
    </div>

</x-guest-layout>
