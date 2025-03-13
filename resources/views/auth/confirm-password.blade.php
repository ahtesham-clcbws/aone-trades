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
        <p class="uk-text-left uk-margin-top uk-text-small">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>
        <!-- login form begin -->
        <form class="uk-grid uk-form" method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Password" />
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                    type="submit" name="submit" id="linkButton">
                    Confirm
                </button>
            </div>
        </form>
        <span class="uk-text-small">
            <a href="{{ route('login') }}">Back to login</a></span>
    </div>

    <script>
        document.getElementById('linkButton').addEventListener('click', function() {
            document.getElementById('linkButton').innerHTML = 'Confirming ..';
        });
    </script>

</x-guest-layout>
