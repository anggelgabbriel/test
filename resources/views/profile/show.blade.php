<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border/>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border/>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border/>
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border/>

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>


</x-app-layout>
<style>
    header.bg-white {
        background-color: transparent !important;
        background: linear-gradient(270deg, rgb(12 8 43) 21%, rgb(34 178 255) 89%) !important;
    }

    main div.bg-white {
        background-color: transparent !important;
    }

    header h2 {
        color: #FFF !important;
    }

    main .bg-gray-50 {
        background-color: transparent !important;
    }

    main form, main > div:nth-child(4) > div > div:nth-child(5) > div > div.mt-5,
    main > div:nth-child(4) > div > div:nth-child(7) > div > div.mt-5 {
        box-shadow: rgb(29 187 255 / 67%) 0px 5px 15px !important;
    }

    main h3, main .text-sm, main p, main label {
        color: white !important;
    }

    div.inset-0.transform{
        backdrop-filter: blur(5px);
    }
</style>
