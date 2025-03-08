<x-guest-layout>
    <div class="uk-text-center in-padding-horizontal@s">
        <x-validation-errors class="mb-4" />

        <a class="uk-logo" href="/">
            <img src="/img/w-logo.png" data-src="/img/w-logo.png" alt="logo" width="269" height="23"
                data-uk-img="" />
        </a>
        <p class="uk-text-lead uk-margin-small-top uk-margin-medium-bottom">
            Register for new account
        </p>
        <!-- login form begin -->
        <form class="uk-grid uk-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span
                    class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                <input
                    class="uk-input uk-border-rounded"
                    placeholder="First name" id="firstname" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="given-name" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span
                    class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                <input
                    class="uk-input uk-border-rounded"
                    placeholder="Last name" id="lastname" type="text" name="lastname" :value="old('lastname')" required autocomplete="family-name" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span
                    class="uk-form-icon uk-form-icon-flip fas fa-phone fa-sm"></span>
                <input
                    class="uk-input uk-border-rounded"
                    placeholder="Phone number" id="phone_number" type="tel" name="phone_number" :value="old('phone_number')" required autocomplete="tel" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span
                    class="uk-form-icon uk-form-icon-flip fas fa-envelope fa-sm"></span>
                <input
                    class="uk-input uk-border-rounded"
                    placeholder="Email" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span
                    class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                <input id="password"
                    class="uk-input uk-border-rounded"
                    placeholder="Password" type="password" name="password" required autocomplete="new-password" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <span
                    class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                <input id="password_confirmation"
                    class="uk-input uk-border-rounded"
                    placeholder="Confirm Password" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="uk-margin-small uk-width-1-1 uk-inline">
                <select class="uk-select uk-border-rounded" name="package">
                    <option value="" disabled selected>
                        Select Account Package
                    </option>
                    @foreach (getPlans() as $plan)
                    <option value="{{ $plan->name }}">{{ $plan->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="uk-margin-small uk-width-auto uk-text-small">
                <label for="terms">
                    <x-checkbox class="uk-checkbox" name="terms" id="terms" required />
                    {{-- <span>
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                        ]) !!}</span> --}}

                    <span>
                        {!! __('I agree to the :privacy_policy', [
                        'privacy_policy' => '<a target="_blank" href="'.route('privacyPolicy').'">'.__('Privacy Policy').'</a>',
                        ]) !!}</span>
                </label>
            </div>
            @endif

            <div class="uk-margin-small uk-width-1-1">
                <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left"
                    type="submit" name="submit">
                    Sign Up
                </button>
            </div>
        </form>
        <span class="uk-text-small">Already have an account?<a href="{{ route('login') }}">sign in here</a></span>
    </div>
</x-guest-layout>
