<x-guest-layout>

    <div class="uk-text-center in-padding-horizontal@s">
        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession
        <a class="uk-logo" href="/">
            <img src="/img/w-logo.png" data-src="/img/w-logo.png" alt="logo" width="269" height="23"
                data-uk-img="" />
        </a>
        <p class="uk-text-lead uk-margin-top">
            Reset Your Password
        </p>
        <!-- login form begin -->
        <form class="uk-grid uk-form" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-envelope fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"
                    placeholder="Email Id" />
            </div>

            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="password" type="password" name="password" required autocomplete="new-password"
                    placeholder="Password" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm Password" />
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                    type="submit" name="submit"id="linkButton">
                    Reset Password
                </button>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('linkButton').addEventListener('click', function() {
            document.getElementById('linkButton').innerHTML = 'Resetting please wait..';
        });
    </script>

</x-guest-layout>
