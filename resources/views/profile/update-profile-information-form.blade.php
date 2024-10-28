<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" id="photo" class="hidden"
                wire:model.live="photo"
                x-ref="photo"
                x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-mary-button class="mt-2 me-2 btn-primary btn-sm" icon="o-photo" label="{{ $this->user->profile_photo_path ? 'Select A New Photo' : 'Select A Photo' }}" type="button" x-on:click.prevent="$refs.photo.click()" />

            @if ($this->user->profile_photo_path)
            <x-mary-button type="button" class="mt-2 btn-error btn-sm" icon="o-x-mark" label="Remove Photo" wire:click="deleteProfilePhoto" />
            @endif

            <x-input-error for="photo" class="mt-2" />
        </div>
        @endif

        <!-- FirstName -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="First Name" id="firstname" type="text" class="mt-1 block w-full input-sm" wire:model="state.firstname" required autocomplete="given-name" />
        </div>
        <!-- LastName -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Last Name" id="lastname" type="text" class="mt-1 block w-full input-sm" wire:model="state.lastname" required autocomplete="family-name" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Email" id="email" type="email" class="mt-1 block w-full input-sm" wire:model="state.email" required autocomplete="username" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
            <p class="text-sm mt-2">
                {{ __('Your email address is unverified.') }}

                <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
            <p class="mt-2 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
            @endif
            @endif
        </div>

        <!-- PhoneNumber -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Phone Number" id="phone_number" type="tel" class="mt-1 block w-full input-sm" wire:model="state.phone_number" required autocomplete="tel" />
        </div>

        <!-- Gender -->
        <div class="col-span-6 sm:col-span-4">
            <label for="gender" class="pt-0 label label-text font-semibold flex justify-start">Gender&nbsp;<span class="text-error">*</span> </label>
            <select id="gender" wire:model="state.gender" autocomplete="sex" class="mt-1 block w-full select select-primary select-sm" required>
                <option value="">Select Gender ...</option>

                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
            </select>
            <x-input-error for="gender" class="mt-2" />
        </div>

        <!-- LastName -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Bate of Birth" id="date_of_birth" type="date" class="mt-1 block w-full input-sm" wire:model="state.date_of_birth" required autocomplete="dob" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-mary-button type="submit" label="SAVE" class="btn-primary btn-sm" />
    </x-slot>
</x-form-section>
