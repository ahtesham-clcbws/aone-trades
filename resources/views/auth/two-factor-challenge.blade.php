<x-guest-layout>
    <div class="uk-text-center in-padding-horizontal@s">
        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession
        <a class="uk-logo" href="index.html">
            <img src="/img/w-logo.png" data-src="/img/w-logo.png" alt="logo" width="269" height="23"
                data-uk-img="" />
        </a>
        <p class="uk-text-lead uk-margin-small-top uk-margin-medium-bottom">
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        </p>
        <!-- login form begin -->
        <form class="uk-grid uk-form" method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="uk-margin-small uk-width-1-1 uk-inline" x-show="!recovery">
                <span class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="code" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code"
                    placeholder="Code" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline" x-cloak x-show="recovery">
                <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                <input class="uk-input uk-border-rounded" id="recovery_code" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code"
                    placeholder="Recovery Code" />
            </div>

            @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="uk-margin-small uk-width-1-1">
                <button class="uk-button uk-button-small uk-width-auto uk-button-secondary uk-border-rounded"
                    type="button"
                    x-show="!recovery"
                    x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                    {{ __('Use a recovery code') }}
                </button>
                <button class="uk-button uk-button-small uk-width-auto uk-button-secondary uk-border-rounded"
                    type="button"
                    x-cloak
                    x-show="recovery"
                    x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                    {{ __('Use an authentication code') }}
                </button>
                <button class="uk-button uk-button-small uk-width-auto uk-button-primary uk-border-rounded"
                    type="submit" name="submit">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
