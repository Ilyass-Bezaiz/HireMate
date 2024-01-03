<x-action-section id="employer-info">
    <x-slot name="title">
        {{ __('Update your company details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Specify info about your company to build a well-structured profile') }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="save">
            @csrf
            <div>
                <x-label
                    for="company_name"
                    class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("Company name") }}
                </x-label> 
                <x-input
                    type="text"
                    id="company_name" 
                    wire:model.lazy="company_name" 
                    name="company_name"
                    class="block lg:w-2/3 w-full"
                    placeholder="Company name"
                />
                <x-input-error for="company_name" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label
                    for="employee_count"
                    class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("Employee count") }}
                </x-label> 
                <x-input 
                    type="text" 
                    id="employee_count" 
                    wire:model.lazy="employee_count" 
                    name="employee_count"
                    class="block lg:w-2/3 w-full"
                    placeholder="Employee count"
                />
                <x-input-error for="employee_count" class="mt-2" />
            </div>
            
            <div class="col-span-6 mt-4 w-full">
                <x-label for="country">{{ __("Country") }}</x-label>
                <select wire:model.live="selectedCountry" id="country" name="country"
                  class="mt-2 block w-full lg:w-2/3 py-2 px-3 border dark:border-gray-600 border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-green-400 sm:text-sm dark:bg-gray-900 dark:text-gray-400"
                  autocomplete="country-name">
                  <option value="null" selected disabled>Select your country</option>
                  @if ($countries)
                  @foreach($countries as $country)
                  <option value="{{ $country->id }}">{{ $country->name }}</option>
                  @endforeach
                  @endif
                </select>
                @error('selectedCountry') <span class="error text-red-600">{{ $message }}</span> @enderror
              </div>

              <div class="col-span-6 mt-4 w-full">
                <x-label for="city" class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("City") }}</x-label>
                <x-input 
                    type="text" 
                    id="city" 
                    wire:model.lazy="city" 
                    name="city"
                    class="block lg:w-2/3 w-full"
                    placeholder="City"
                />
                @error('city') <span class="error text-red-600">{{ $message }}</span> @enderror
              </div>
              
              <div class="col-span-6 mt-4 w-full">
                <x-label for="city" class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("ZIP") }}</x-label>
                <x-input 
                    type="text" 
                    id="zip" 
                    wire:model.lazy="zip" 
                    name="zip"
                    class="block lg:w-2/3 w-full"
                    placeholder="ZIP Code"
                />
                @error('zip') <span class="error text-red-600">{{ $message }}</span> @enderror
              </div>

            

            <div class="mt-4">
                <x-label
                    for="industry"
                    class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("Industry") }}
                </x-label> 
                <x-input 
                    type="text" 
                    id="industry" 
                    wire:model.lazy="industry" 
                    name="industry"
                    class="block lg:w-2/3 w-full"
                    placeholder="Industry"
                />
                <x-input-error for="industry" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-label
                    for="coverPicture"
                    class="inline-block mb-2 text-neutral-700 dark:text-neutral-200"
                >
                Cover picture
                </x-label>
                <x-input
                    accept="image/png, image/jpeg"
                    class="relative m-0 block lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 dark:hover:file:bg-neutral-600 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                    type="file"
                    id="coverPicture"
                    wire:model='coverPicture'
                />
                <x-input-error for="coverPicture" class="mt-2" />
                    @if($coverPictureUrl)
                        <div class="flex items-center gap-4 mt-4">
                            <a href="{{ Storage::url($coverPictureUrl) }}" target="_blank" class="fflex items-center h-6 px-4 font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md hover:bg-gray-800 hover:text-white w-fit dark:border-neutral-200 dark:hover:bg-neutral-200 dark:text-neutral-200 dark:hover:text-gray-800">View cover picture</a>
                            <button wire:click="removeCoverPicture" wire:confirm="{{ __("Are you sure you want to delete your cover picutre ?") }}" class="flex items-center h-6 px-4 font-semibold text-sm text-red-600 duration-200 border-2 border-red-500 bg-transparent rounded-md hover:bg-red-500 hover:text-white">Remove cover picutre</button>   
                        </div>         
                    @endif         
            </div>

            <div class="mt-4 lg:w-2/3" wire:ignore>
                <x-label
                    for="about"
                    class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("About") }}
                </x-label> 
                <textarea id="about">{!! $about !!}</textarea>
            </div>
            <div class="mt-4 flex items-center justify-end w-full">
                <x-button>Save</x-button>
            </div>
        </form>
        
    </x-slot>
      

    @script
        <script>
            ClassicEditor
            .create(document.querySelector('#about'),{
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('about', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });

            $wire.on('success',(event)=>{
                Toastify({
                    text: event.message,
                    duration: 2000,
                    close:true,
                    gravity: "top", // `top` or `bottom`
                    position: "left", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#4DD783",
                    },
                    onClick: function(){} // Callback after click
                }).showToast();
            })
        </script>
    @endscript
</x-action-section>