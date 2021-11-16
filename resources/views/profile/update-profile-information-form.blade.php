<x-jet-form-section submit="updateProfileInformation">
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
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- UserName -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('ユーザーネーム') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- Birth_year -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="birth_year" value="{{ __('生年月日') }}" />
            <x-jet-input id="birth_year" type="date" class="mt-1 block w-full" wire:model.defer="state.birth_year" />
            <x-jet-input-error for="birth_year" class="mt-2" />
        </div>

        <!-- Profile -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="profile" value="{{ __('自己紹介・目標') }}" />
            <textarea name="profile" id="profile" cols="30" rows="5" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" required  wire:model.defer="state.profile" ></textarea>
            <x-jet-input-error for="profile" class="mt-2" />
        </div>

        <!-- height -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="height" value="{{ __('身長(cm)') }}" />
            <x-jet-input id="height" type="height" class="mt-1 block w-full" wire:model.defer="state.height" />
            <x-jet-input-error for="height" class="mt-2" />
        </div>

        <!-- weight -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="weight" value="{{ __('体重(kg)') }}" />
            <x-jet-input id="weight" type="weight" class="mt-1 block w-full" wire:model.defer="state.weight" />
            <x-jet-input-error for="weight" class="mt-2" />
        </div>

        <!-- terget_weight -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="terget_weight" value="{{ __('目標体重(kg)') }}" />
            <x-jet-input id="terget_weight" type="terget_weight" class="mt-1 block w-full" wire:model.defer="state.terget_weight" />
            <x-jet-input-error for="terget_weight" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
