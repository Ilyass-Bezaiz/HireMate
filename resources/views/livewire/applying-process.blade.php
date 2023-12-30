<div class="dark:bg-gray-900">
  <x-apply-modal wire:model.live="showingModal">
    <x-slot name="header">Apply to {{$companyApplied}}</x-slot>
    <x-slot name="title">Your information</x-slot>
    <x-slot name="content">
      <form enctype="multipart/form-data" wire:submit.prevent="">
        @if($stepper==1)
        <div>
          <div class="sm:col-span-6 mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white">Email </label>
            <div class="mt-1">
              <input type="text" id="email" wire:model="email" name="email"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 dark:text-black" />
            </div>
            @error('email') <span class="error text-red-600">{{ $message }}</span> @enderror
          </div>
          <div class="sm:col-span-6 mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-white"> Phone Number</label>
            <div class="mt-1">
              <input type="text" wire:model="phone" id="phone" inputmode="numeric" name="phone"
                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:text-black" />
            </div>
            @error('phone') <span class="error text-red-600">{{ $message }}</span> @enderror
          </div>
        </div>
        @endif
        @if($stepper == 2)
        <div>
          <div class="sm:col-span-6 mb-4">
            <div class="mt-4">
              @if($resumeUrl == null)
              <x-label for="resume" class="mb-2 inline-block text-neutral-700 dark:text-neutral-200">Resume</x-label>
              <x-input wire:model.live="resume"
                class="relative m-0 block w-2/3 lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                type="file" id="resume" />
              @error('resume') <span class="error text-red-600">{{ $message }}</span> @enderror
              @endif
              @if($resumeUrl)
              <x-label for="resume" class="mb-2 inline-block text-neutral-700 dark:text-neutral-200">Resume already
                uploaded</x-label>
              <div
                class="relative text-[15px] flex items-center w-full min-w-0 rounded border border-solid border-neutral-300">
                <span class="bg-gray-200 h-full border-r-2 dark:bg-white dark:text-black p-3">Your Resume</span>
                <span class=" text-neutral-700 dark:text-neutral-200 p-3">{{ auth()->user()->name }}'s
                  resume</span>
                <div class="flex-grow"></div> <!-- This will make the SVG take up the remaining space -->
                <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                  stroke="#4DD783">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4C16.4183 4 20 7.58172 20 12ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z"
                      fill="#4DD783"></path>
                  </g>
                </svg>
              </div>
              <div class="flex items-center gap-4 mt-4">
                <a href="{{ Storage::url($resumeUrl) }}" target="_blank"
                  class="flex items-center bg-gray-800 dark:bg-white dark:text-black dark:hover:bg-transparent dark:hover:text-white dark:hover:border dark:hover:border-solid dark:hover:border-white  hover:bg-gray-600 duration-200 h-8 px-4 w-fit rounded-md text-white font-semibold">View
                  resume</a>
                <x-button wire:click="removeCV"
                  class="flex items-center bg-red-500 dark:bg-red-500 px-4 h-8 rounded-md font-semibold text-white dark:text-white dark:hover:bg-red-600 hover:bg-red-600 duration-200">
                  Remove resume</x-button>
              </div>
              @endif
            </div>
          </div>
        </div>
        @endif
        @if($stepper == 3)
        <div wire:transition.duration.400ms>
          <div class="sm:col-span-6 mb-4">
            <div class="mb-3">
              <h3 class="text-xl text-gray-700 dark:text-white">Review your application</h3>
              <!-- <div class="text-base text-slate-400">The employer will also receive a copy of your profile.</div> -->
            </div>
            <hr>
            <div class="mt-3">
              <div class="flex w-full items-center justify-between mb-3">
                <h4 class="text-base font-bold text-black dark:text-white">Personal information</h4>
                <button class="text-green-400 text-base " wire:click="edit(1)">Edit</button>
              </div>
              <div class="mb-3">
                <div class=" text-gray-500 text-[13px] dark:text-white">Email:</div>
                <div class=" text-black text-[15px] dark:text-white">{{$email}}</div>
              </div>
              <div class="mb-3">
                <div class=" text-gray-500 text-[13px] dark:text-white">Phone:</div>
                <div class=" text-black text-[15px] dark:text-white">{{$phone}}</div>
              </div>
            </div>
            <hr>
            <div class="mt-3">
              <div class="flex w-full items-center justify-between mb-3">
                <h4 class="text-base font-bold text-black dark:text-white">Resume</h4>
                <button class="text-green-400 text-base" wire:click="edit(2)">Edit</button>
              </div>
              @if ($resumeUrl != null)
              <a href="/storage/uploads/cv-{{auth()->user()->name}}.pdf" target="_blank" class="inline-block px-8 py
                2 rounded-md border border-transparent leading-6 font-medium text-white bg-blue-600 hover:bg
                -blue-500 focus:outline-none transition duration-150 ease">View CV</a>
              @else
              <!-- <p class="py-2 rounded-md border border-dashed flex items-center justify-center text-base font-medium text" -->
              <p class="py-2 rounded-md leading-6 font-medium text-red-600 ">Please upload a CV</p>
              @endif
            </div>
          </div>
        </div>
        @endif
      </form>
    </x-slot>
    <x-slot name="footer" class="w-full flex justify-between">
      <div>
        <x-button wire:click="cancelApplying"
          class="dark:bg-green-400 dark:text-white dark:hover:bg-transparent dark:hover:text-green-400 dark:hover:border dark:hover:border-green-400 dark:focus:bg-transparent">
          Cancel</x-button>
      </div>
      <div class="w-1/2 flex justify-end ">
        @switch($stepper)
        @case(1)
        <x-button wire:click="nextStep"
          class="dark:bg-green-400 dark:text-white dark:hover:bg-green-600 dark:focus:bg-green-600">
          Next {{$stepper}}</x-button>
        @break
        @case(3)
        <x-button wire:click="stepBack"
          class="bg-red-400 hover:bg-red-600 dark:bg-red-500 dark:text-white dark:hover:bg-red-600 dark:focus:bg-red-600 dark:hover:text-slate-50 dark:focus:ring-red-600 mr-3">
          Back</x-button>
        <x-button wire:click="submitApplication"
          class="dark:bg-green-400 dark:text-white dark:hover:bg-green-600 dark:focus:bg-green-600">Submit</x-button>
        @break
        @default
        <x-button wire:click="stepBack"
          class="bg-red-400 hover:bg-red-600 dark:bg-red-500 dark:text-white dark:hover:bg-red-600 dark:focus:bg-red-600 dark:hover:text-slate-50 dark:focus:ring-red-600 mr-3">
          Back</x-button>
        <x-button wire:click="nextStep"
          class="dark:bg-green-400 dark:text-white dark:hover:bg-green-600 dark:focus:bg-green-600">
          Next</x-button>
        @endswitch
      </div>
    </x-slot>
  </x-apply-modal>
  @if($showingSuccessMessage)
  <!-- Add this section to your Livewire component's Blade file -->
  <x-success-modal>
    <x-slot name="title">
      <div class="w-full p-4 text-center dark:text-white">Your application has been submitted!</div>
    </x-slot>
    <x-slot name="content">
      <svg class="h-20 w-20 " fill="#4DD783" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"
        enable-background="new 0 0 52 52" xml:space="preserve">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M26,2C12.7,2,2,12.7,2,26s10.7,24,24,24s24-10.7,24-24S39.3,2,26,2z M39.4,20L24.1,35.5 c-0.6,0.6-1.6,0.6-2.2,0L13.5,27c-0.6-0.6-0.6-1.6,0-2.2l2.2-2.2c0.6-0.6,1.6-0.6,2.2,0l4.4,4.5c0.4,0.4,1.1,0.4,1.5,0L35,15.5 c0.6-0.6,1.6-0.6,2.2,0l2.2,2.2C40.1,18.3,40.1,19.3,39.4,20z">
          </path>
        </g>
      </svg>
    </x-slot>
  </x-success-modal>
  @endif
</div>