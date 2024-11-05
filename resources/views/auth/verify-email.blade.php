<x-guest-layout>
    <div class="uk-text-center in-padding-horizontal@s">
        <x-validation-errors class="uk-margin-bottom" />

        <a class="uk-logo" href="/">
            <img src="/img/w-logo.png" data-src="/img/w-logo.png" alt="logo" width="269" height="23"
                data-uk-img="" />
        </a>
        <p class="uk-text-lead uk-margin-top uk-margin-medium-bottom">
            Before continuing, could you verify your email address by clicking on the link we just emailed to you? <br/><br/>If you didn't receive the email, we will gladly send you another.
        </p>
        @if (session('status') == 'verification-link-sent')
        <div class="uk-margin-bottom uk-text-small uk-text-bold uk-text-success">
            {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
        </div>
        @endif

        <div class="uk-margin-small uk-width-1-1">
            <form method="POST" action="{{ route('verification.send') }}" class="uk-margin-bottom">
                @csrf

                <div>
                    <button class="uk-button uk-button-small uk-width-auto uk-button-secondary uk-border-rounded"
                        type="submit">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf

                <button class="uk-button uk-button-small uk-width-auto uk-button-primary uk-border-rounded" type="submit">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>

    </div>
</x-guest-layout>
