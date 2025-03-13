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
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>
        <!-- login form begin -->
        <form class="uk-grid uk-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span class="uk-form-icon uk-form-icon-flip fas fa-envelope fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="Email Id" />
            </div>

            <div class="uk-margin-small uk-width-1-1">
                <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                    type="submit" name="submit"id="linkButton">
                    Email Password Reset Link
                </button>
            </div>
        </form>
        <span class="uk-text-small">
            <a href="{{ route('login') }}">Back to login</a></span>
    </div>

    <script>
        document.getElementById('linkButton').addEventListener('click', function() {
            document.getElementById('linkButton').innerHTML = 'Sending email..';
        });
    </script>

</x-guest-layout>
