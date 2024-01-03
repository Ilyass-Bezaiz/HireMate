<x-action-section id="experience">
    <x-slot name="title">
        {{ __('Update Work experience information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and update your data about where you have worked before.') }}
    </x-slot>
    <x-slot name="content">
        @if(session('success'))
                    <span class="text-gray-600 dark:text-green-500" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition.duration.500ms>{{ Session::get('success'); }}</span>
        @endif
        @if(session('error'))
                    <span class="text-red-600" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition.duration.500ms>{{ Session::get('error'); }}</span>
        @endif
        <div class="flex flex-row justify-between items-center mb-10">
            <h2 class="text-2xl dark:text-white text-gray-800">{{ __("Work Experience") }}</h2>
            <button wire:click="showAddExperienceModal" class="px-4 py-2 rounded-full bg-transparent border-2 border-green-400 text-green-400 duration-200 hover:bg-green-400 hover:text-white">{{ __("Add experience") }}</button>
        </div>
        @if (count($experiencesList) > 0)
        <div class="flex flex-col">
            @foreach($experiencesList as $experience)
                <div class="py-4 border-b dark:border-gray-500 border-neutral-300">
                    <div class="flex gap-10 mb-2">
                        <h3 class="text-md dark:text-white text-gray-800">{{ $experience->position }}</h3>
                        <button wire:click="showEditExperienceModal({{ $experience->id }})" class="edit-btn">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2038 7.7957L15.9998 5.9997C16.545 5.45445 16.8176 5.18182 16.9634 4.88773C17.2407 4.32818 17.2407 3.67122 16.9634 3.11167C16.8176 2.81757 16.545 2.54495 15.9998 1.9997C15.4545 1.45445 15.1819 1.18182 14.8878 1.03609C14.3282 0.758804 13.6713 0.758804 13.1117 1.03609C12.8176 1.18182 12.545 1.45445 11.9998 1.9997L10.1811 3.81835C11.145 5.46895 12.5311 6.84451 14.2038 7.7957ZM8.72666 5.27281L1.85615 12.1433C1.43109 12.5684 1.21856 12.7809 1.07883 13.042C0.939091 13.3031 0.880146 13.5978 0.762256 14.1873L0.14686 17.2643C0.0803376 17.5969 0.0470765 17.7632 0.141684 17.8578C0.236293 17.9524 0.402598 17.9191 0.735208 17.8526L3.81219 17.2372C4.40164 17.1193 4.69637 17.0604 4.95746 16.9206C5.21856 16.7809 5.43109 16.5684 5.85615 16.1433L12.7456 9.25392C11.1239 8.23827 9.7522 6.87597 8.72666 5.27281Z" fill="#4DD783"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex gap-2 items-center">
                        <span class="dark:text-white text-sm text-gray-800">{{ $experience->company_name }}</span>
                        <span class="dark:text-white text-gray-800 text-sm">|</span>
                        <span class="dark:text-white text-gray-800 text-sm">{{ __("Started") }} : {{ $experience->start_date }} 
                            @if ($experience->end_date)
                                - {{ __("Ended") }} : {{ $experience->end_date }}
                            @else
                                - {{ __("Present") }}
                            @endif
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <span class="dark:text-white text-gray-800">{{ __("No work experiences provided yet !") }}</span>
        @endif
        
        <x-dialog-modal wire:model="showingModal">

            @if($isEditMode)
            <x-slot name="title">{{ __("Edit experience") }}</x-slot>
            @else
                <x-slot name="title">{{ __("Add experience") }}</x-slot>
            @endif

            <x-slot name="content">
                <form>
                    @csrf
                <div class="col-span-6 mb-4 w-full">
                    <x-label for="company_name">{{ __("Company name") }}</x-label>
                    <x-input type="text" id="company_name" wire:model.lazy="companyName" name="company_name"
                        class="mt-2 block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-900" />
                    <x-input-error for="companyName" class="mt-2" />
                </div>
                <div class="col-span-6 mb-4 w-full">
                    <x-label for="position">{{ __("Position") }}</x-label>
                    <x-input type="text" id="position" wire:model.lazy="position" name="position"
                        class="mt-2 block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-900" />
                    <x-input-error for="position" class="mt-2" />
                </div>

                <div class="flex flex-col lg:flex-row w-full gap-4 items-center justify-between">
                    <div class="w-full sm:col-span mb-4">
                        <div class="mt-1">
                          <x-label for="start_date">{{ __("Start date") }}</x-label>
                          <x-input type="date" id="start_date" wire:model.lazy="start_date" name="start_date"
                            class="mt-2 block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-900" />
                          </div>
                          <x-input-error for="start_date" class="mt-2" />
                      </div>
                      <div class="w-full sm:col-span-6 mb-4">
                        <div class="mt-1">
                          <x-label for="end_date">{{ __("End date") }}</x-label>
                          <x-input type="date" id="end_date" wire:model.lazy="end_date" name="end_date"
                            class="mt-2 block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-900" disabled="{{ $disabled }}" />
                          </div>
                          <x-input-error for="end_date" class="mt-2" />
                      </div>
                </div>

                <div class="sm:col-span-6 mb-4 flex gap-4">
                    <x-checkbox id="still_work_here" wire:model.live="stillWorkHere" />    
                    <x-label for="still_work_here">{{ __("Still work here ?") }}</x-label>
                </div>
                  
                  <div class="sm:col-span-6 mb-4">
                    <div class="mt-1">
                      <x-label for="responsibilities">{{ __("Responsibilities") }}</x-label>
                      <textarea id="responsibilities" wire:model="responsibilities" rows="3" class="mt-2 shadow-smc focus:ring-green-400 appearance-none bg-white border border-gray-600 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-green-400 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-900"></textarea>
                    </div>
                    <x-input-error for="responsibilities" class="mt-2" />
                  </div>
                </form>
            </x-slot>
            
            <x-slot name="footer">
                @if($isEditMode)
                <div class="flex gap-4 w-full">
                    <x-button wire:click="updateExperience" class="w-full text-center flex items-center justify-center h-12 py-10">{{ __('Save') }}</x-button>
                    <x-button wire:click="deleteExperience" class="bg-red-600 hover:bg-red-700 active:bg-red-700 focus:ring-red-700 w-full text-center flex items-center justify-center h-12 py-10">{{ __('Delete') }}</x-button>
                </div>
                
                @else
                <x-button wire:click="createExperience" class="w-full text-center flex items-center justify-center h-12 py-10">{{ __('Save') }}</x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </x-slot>
    
</x-action-section>