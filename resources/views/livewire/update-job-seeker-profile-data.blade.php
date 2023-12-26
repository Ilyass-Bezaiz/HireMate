<x-action-section>
    <x-slot name="title">
        {{ __('Update Candidate information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and update you profile information') }}
    </x-slot>
    <x-slot name="content">
                @if(session('success'))
                    <span class="text-gray-600" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition.duration.500ms>Data saved successfully !</span>
                @endif
            

                <form wire:submit.prevent="save">
                    @csrf
                    <div class="mt-4">
                        <x-label for="age">Age</x-label>
                        <x-input type="text" class="mt-1 block lg:w-2/3 w-full"
                                    autocomplete="age"
                                    placeholder="{{ __('Age') }}"
                                    wire:model="age"
                                    id="age"
                                    />
                        <x-input-error for="age" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="gender">Gender</x-label>
                        <select name="gender" id="gender" class="mt-1 block lg:w-2/3 w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm" wire:model="gender">
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
                    <div class="mt-4">
                        <x-label
                            for="resume"
                            class="mb-2 inline-block text-neutral-700 dark:text-neutral-200">Resume
                        </x-label>
                        <x-input
                            wire:model.lazy="resume"
                            class="relative m-0 block w-2/3 lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                            type="file"
                            id="resume" 
                        />
                        <x-input-error for="resume" class="mt-2" />
                        @if($resumeUrl)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ Storage::url($resumeUrl) }}" target="_blank" class="flex items-center bg-gray-800 hover:bg-gray-600 duration-200 h-8 px-4 w-fit rounded-md text-white font-semibold">View resume</a>
                                <button wire:click="removeCV" class="flex items-center bg-red-600 px-4 h-8 rounded-md font-semibold text-white hover:bg-red-500 duration-200">Remove resume</button>   
                            </div>         
                        @endif
                        
                    </div>
                    <div class="mt-4">
                        <x-label
                            for="coverPicture"
                        >
                        Cover picture
                        </x-label>
                        <x-input
                            accept="image/png, image/jpeg"
                            class="relative m-0 block lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                            type="file"
                            id="coverPicture" 
                        />
                    </div>
        <div class="flex justify-end">
            <x-button type="submit" class="mt-4">Save changes</x-button>
        </div>
    </form>
                
    </x-slot>
    
</x-action-section>