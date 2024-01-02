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
                  class="flex items-center bg-red-500 dark:bg-red-500 dark:hover:bg-red-700 dark:hover:focus:bg-red-700 dark:focus:bg-red-700 px-4 h-8 rounded-md font-semibold text-white dark:text-white hover:bg-red-600 duration-200">
                  Remove resume</x-button>
              </div>
              @endif
            </div>
          </div>
        </div>
        @endif
        @if($stepper == 3)
        <div>
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
              <a href="/storage/uploads/cv-{{auth()->user()->name}}.pdf" target="_blank" class="flex items-center h-6 px-4
                font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md
                hover:bg-gray-800 hover:text-white w-fit dark:border-neutral-200 dark:hover:bg-neutral-200
                dark:text-neutral-200 dark:hover:text-gray-800">View CV</a>
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
          class="dark:bg-green-400 dark:text-white dark:hover:bg-green-500 dark:focus:bg-green-700 dark:hover:focus:bg-green-700 dark:hover:text-white dark:hover:border dark:hover:border-green-400 dark:focus:bg-transparent">
          Cancel</x-button>
      </div>
      <div class="w-1/2 flex justify-end ">
        @switch($stepper)
        @case(1)
        <x-button wire:click="nextStep"
          class="dark:bg-green-400 dark:text-white dark:hover:bg-green-500 dark:hover:focus:bg-green-700 dark:focus:bg-green-700">
          Next {{$stepper}}</x-button>
        @break
        @case(3)
        <x-button wire:click="stepBack"
          class="bg-red-400 hover:bg-red-600 dark:bg-red-500 dark:text-white dark:hover:bg-red-500 dark:hover:focus:bg-red-700 dark:focus:bg-red-600 dark:hover:text-slate-50 dark:focus:ring-red-600 mr-3">
          Back</x-button>
        <x-button wire:click="submitApplication"
          class="dark:bg-green-400 dark:text-white dark:hover:bg-green-500 dark:focus:bg-green-700 dark:hover:focus:bg-green-700">
          Submit</x-button>
        @break
        @default
        <x-button wire:click="stepBack"
          class="bg-red-400 hover:bg-red-600 dark:bg-red-400 dark:text-white dark:hover:bg-red-500 dark:hover:focus:bg-red-700 dark:focus:bg-red-700 dark:hover:text-slate-50 dark:focus:ring-red-600 mr-3">
          Back</x-button>
        <x-button wire:click="nextStep"
          class="dark:bg-green-400 dark:text-white dark:hover:bg-green-500 dark:hover:focus:bg-green-700">
          Next</x-button>
        @endswitch
      </div>
    </x-slot>
  </x-apply-modal>
  @if($showingSuccessMessage)
  <!-- Add this section to your Livewire component's Blade file -->
  <x-success-modal maxWidth="lg">
    <x-slot name="title">
      <svg xmlns="http://www.w3.org/2000/svg" width="125" height="125" viewBox="0 0 125 125" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M62.5 124.375C96.6726 124.375 124.375 96.6726 124.375 62.5C124.375 28.3274 96.6726 0.625 62.5 0.625C28.3274 0.625 0.625 28.3274 0.625 62.5C0.625 96.6726 28.3274 124.375 62.5 124.375ZM91.1523 42.8353C91.6827 42.1989 91.5967 41.253 90.9603 40.7227C90.3239 40.1923 89.378 40.2783 88.8477 40.9147L55.5242 80.9029L36.0607 61.4393C35.4749 60.8536 34.5251 60.8536 33.9393 61.4393C33.3536 62.0251 33.3536 62.9749 33.9393 63.5607L54.5643 84.1857L55.7258 85.3471L56.7773 84.0853L91.1523 42.8353Z"
          fill="#4DD783" />
      </svg>
    </x-slot>
    <x-slot name="content">
      <h3 class="text-[24px] tracking-wide	">You're all done</h3>
      <p class="text-[14px] dark:text-white text-gray-500 w-1/2 text-center font-light	">you can edit your profile
        informations in the
        Settings</p>
    </x-slot>
    <x-slot name="footer">
      <button wire:click="close()"
        class="w-1/2 bg-green-400 text-white focus:outline-none hover:bg-green-500 rounded-full py-2 px-5 mb-6">Close</button>
    </x-slot>
  </x-success-modal>
  @endif
</div>