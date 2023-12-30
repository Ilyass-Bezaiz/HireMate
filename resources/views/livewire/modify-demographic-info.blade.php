<x-action-section>
    <x-slot name="title">
        {{ __('Update Demographic information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and update you profile information') }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="save">
            @if(session('success-demographic'))
                    <span class="text-gray-600 dark:text-green-500" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition.duration.500ms>{{ Session::get('success-demographic'); }}</span>
            @endif
            
            @csrf
            <div class="mt-4">
                <x-label for="age">Age</x-label>
                <x-input type="text" class="block w-full mt-1 lg:w-2/3"
                            autocomplete="age"
                            placeholder="{{ __('Age') }}"
                            wire:model="age"
                            id="age"
                            />
                <x-input-error for="age" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="gender">Gender</x-label>
                <select name="gender" id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-400 rounded-md shadow-sm block w-full mt-1 lg:w-2/3" wire:model="gender">
                    <option value="null" selected disabled>Choose your gender</option>
                    @if ($gender == "Male")
                        <option value="Male" selected>Male</option>
                        <option value="Female">Female</option>
                    @else
                        <option value="Male">Male</option>
                        <option value="Female"selected>Female</option>
                    @endif
                </select>
                <x-input-error for="gender" class="mt-2" />
            </div>
            <div class="flex justify-end">
                <x-button type="submit" class="mt-4">Save changes</x-button>
            </div>
        </form>
    </x-slot>
    
</x-action-section>