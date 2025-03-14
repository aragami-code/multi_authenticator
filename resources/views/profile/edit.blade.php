

<x-app-layout>
    @can('view profile')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @can('edit profile')
                 
    
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
                @endcan
            </div>

            @can('update password')
                 <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @endcan
           
            @can('delete account')
                 <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @endcan
           
        </div>
    </div>
    @endcan
</x-app-layout>
    
