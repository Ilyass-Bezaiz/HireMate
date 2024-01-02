<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name . "'s " . __('Profile') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12">
        <header class="relative flex justify-center items-center">
            <!-- cover picture & basic info -->
            <div class="bg-cover h-[300px] w-full rounded-lg" style="background-image: url('http://127.0.0.1:8000/images/curved0.jpg');"></div>
            <div class="absolute bg-white bg-opacity-75 dark:bg-gray-800 dark:bg-opacity-75 backdrop-blur-md rounded-2xl w-[98%] p-4 bottom-[-50px] -ml-1 shadow-lg">
                <!-- Adjust the styling based on your needs -->
                <div class="flex items-center justify-between">
                    <div class="flex flex-row gap-4 items-center">
                        <img src="{{ Storage::url($user->profile_photo_path) }}" class="w-20 h-20 rounded-md object-cover">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-neutral-200">{{ $user->name }}</h3>
                            <span class="text-md font-medium text-gray-800 dark:text-neutral-200 opacity-80">{{ $headline ? $headline : 'Looking for a job' }}</span>
                        </div>
                    </div>
                    <x-button>{{ __("Contact") }}</x-button>
                </div>
            </div>
        </header>
        <main class="mt-20 grid grid-cols-2 gap-4">
            <!-- Full-width row -->
            <div class="bg-white p-4 shadow-lg rounded-md dark:bg-gray-800 dark:text-neutral-200 ">
                <h3 class="text-xl font-semibold">{{ __("About") }}</h3>
                <p class="text-sm">{!! $about !!}</p>
            </div>
            
            <!-- Two columns with 50-50 distribution -->
            <div class="grid grid-cols-1 gap-4">
                <div class="bg-white p-4 shadow-lg rounded-md dark:bg-gray-800 dark:text-neutral-200">
                    <h3 class="text-xl font-semibold">{{ __("Education") }}</h3>
                    <p>
                        {{ $education }}
                    </p>
                </div>
                <div class="bg-white p-4 shadow-lg rounded-md dark:bg-gray-800 dark:text-neutral-200">
                    <h3 class="text-xl font-semibold">{{ __("Work experience") }}</h3>
                    <p>
                        {{ $workExperience }}
                    </p>
                </div>
            </div>
        </main>        
        
    </div>
</div>
