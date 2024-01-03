<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name . "'s " . __('Profile') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-12">
        <header class="relative flex justify-center items-center">
            <!-- cover picture & basic info -->
            @if ($userData['coverPicture'])
                <div class="bg-cover bg-no-repeat h-[300px] w-full rounded-lg" style="background-image: url('{{ Storage::url($userData['coverPicture']) }}');"></div>
            @else
                <div class="bg-cover h-[300px] w-full rounded-lg" style="background-image: url('http://127.0.0.1:8000/images/curved0.jpg');"></div>
            @endif
            <div class="absolute bg-white bg-opacity-75 dark:bg-gray-800 dark:bg-opacity-75 backdrop-blur-md rounded-2xl w-[98%] p-4 bottom-[-50px] shadow-lg">
                <!-- Adjust the styling based on your needs -->
                <div class="flex lg:items-center lg:justify-between lg:flex-row flex-col justify-start items-start gap-4">
                    <div class="flex flex-row gap-4 items-center">
                        @if($user->profile_photo_path)
                            <img src="{{ Storage::url($user->profile_photo_path) }}" class="w-20 h-20 rounded-md object-cover"> 
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&color=4DD783&background=EBF0EB" class="w-20 h-20 rounded-md object-cover">
                        @endif
                        
                        <div class="flex flex-col">
                            @if($userRole == 'job_seeker')
                                <h3 class="text-xl font-bold text-gray-800 dark:text-neutral-200">{{ $user->name }}</h3>
                            @else
                                <h3 class="text-xl font-bold text-gray-800 dark:text-neutral-200">{{ $userData['companyName'] ? $userData['companyName'] : $user->name }}</h3>
                            @endif

                            @if($userRole == 'job_seeker')
                                <span class="text-md font-medium text-gray-800 dark:text-neutral-200 opacity-80">{{ $userData['headline'] ? $userData['headline'] : 'Looking for a job' }}</span>
                            @else  
                                <span class="text-md font-medium text-gray-800 dark:text-neutral-200 opacity-80">{{ $userData['industry'] ? $userData['industry'] : 'Hiring' }}</span>
                            @endif

                            @if($userRole == 'employer' && $userData['city'] && $userData['country'] && $userData['employee_count'])
                                <span class="text-sm font-light text-gray-800 dark:text-neutral-200 opacity-80">
                                    {{ $this->getCountryName($userData['country']). ", ". $userData['city']. " | ". $userData['employee_count'] . " Employees" }}
                                </span>
                            @endif

                            </div>
                    </div>
                    @if($user_id != auth()->user()->id)
                    <x-button wire:click="contactUser">{{ __("Send message") }}</x-button>
                    @endif
                </div>
            </div>
        </header>
        <main class="mt-20 grid grid-cols-1 gap-4">
            @if($userRole == 'job_seeker')

            <!-- Job seeker profile view -->
            @if($userData['about'] && $userData['workExperience'] && $userData['education'])
                <!-- Full-width row -->
                @if($userData['about'])
                <div class="bg-white p-4 rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                    <div class="flex w-full items-center justify-between">
                        <h3 class="text-xl font-semibold">{{ __("About") }}</h3>
                        @if($user_id == auth()->user()->id)
                            <a href="{{ route('profile.show') }}#job_seeker_info" target="_blank" class="p-4 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-green-400 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-200 duration-200"><i class="fa-solid fa-pen"></i></a>
                        @endif
                    </div>
                    <p class="text-sm">{!! $userData['about'] !!}</p>
                    <div class="flex gap-4 items-center mt-4 lg:flex-row md:flex-col flex-col">
                        @if($userData['resume'])
                            <a class="flex text-center w-fit bg-green-400 text-center px-4 py-1 rounded-full text-white font-semibold duration-200 hover:bg-green-500" href="{{ Storage::url($userData['resume']) }}" target="_blank">{{ __("Download resume") }}</a>
                        @endif
                        @if($userData['coverLetter'])
                            <a class="flex bg-transparent w-fit text-center py-1 px-4 rounded-full text-green-400 border border-green-400 font-semibold duration-200 hover:bg-green-400 hover:text-white" href="{{ Storage::url($userData['coverLetter']) }}" target="_blank">{{ __("Download cover letter") }}</a>
                        @endif
                    </div>
                </div>
                @endif
                
                <!-- Two columns with 50-50 distribution -->
                @if($userData['education'] && count($userData['education']) > 0)
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                @else
                <div class="grid lg:grid-cols-1 grid-cols-1 gap-4">
                @endif
                    @if($userData['education'] && count($userData['education']) > 0)
                    <div class="bg-white rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                        <div class="flex flex-row gap-4 items-center w-full p-4">
                            <h3 class="text-xl font-semibold w-full">{{ __("Education") }}</h3>  
                            @if($user_id == auth()->user()->id)
                                <a href="{{ route('profile.show') }}#education" target="_blank" class="p-4 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-green-400 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-200 duration-200"><i class="fa-solid fa-pen"></i></a>
                            @endif 
                        </div>
                        <div>
                            @foreach ($userData['education'] as $e)
                                <div class="p-4 flex items-center gap-4 border-b border-gray-200 dark:border-neutral-600 hover:bg-gray-100 dark:hover:bg-gray-600 duration-200 ">
                                    <div class="bg-neutral-200 dark:bg-gray-700 w-12 h-12 flex justify-center items-center rounded-md">
                                        <i class="fa-solid fa-school"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h3 class="font-semibold">{{ $e->education_level }}</h3>
                                        <h4 class="font-medium text-sm">{{ $e->education_field }}</h4>
                                        <span class="dark:text-white text-gray-800 text-sm">{{ __("Started") }} : {{ $e->start_date }} 
                                            @if ($e->end_date)
                                                - {{ __("Ended") }} : {{ $e->end_date }}
                                            @else
                                                - {{ __("Present") }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if(count($userData['languages'])>0)
                    <div class="bg-white rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                        <div class="flex flex-row gap-4 items-center w-full p-4">
                            <h3 class="text-xl font-semibold w-full">{{ __("Languages") }}</h3>
                            @if($user_id == auth()->user()->id)
                                    <a href="{{ route('profile.show') }}#languages" target="_blank" class="p-4 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-green-400 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-200 duration-200"><i class="fa-solid fa-pen"></i></a>
                            @endif
                        </div>
                         
                        @foreach($userData['languages'] as $lang)
                        <div class="p-4 flex items-center gap-4 border-b border-gray-200 dark:border-neutral-600 hover:bg-gray-100 dark:hover:bg-gray-600 duration-200">
                            <div class="bg-neutral-200 dark:bg-gray-700 w-12 h-12 flex justify-center items-center rounded-md">
                                <i class="fa-solid fa-language"></i>
                            </div>
                            <div class="flex flex-col">
                                <h3 class="font-semibold">{{ $this->getLanguageName($lang->language_id) }}</h3>
                                <h4 class="font-medium text-sm">{{ $lang->proficiency }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @if($userData['workExperience'] && count($userData['workExperience']) > 0)
                <div class="bg-white rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                    
                    <div class="flex flex-row gap-4 items-center w-full p-4">
                        <h3 class="text-xl font-semibold w-full">{{ __("Work experience") }}</h3>
                        @if($user_id == auth()->user()->id)
                            <a href="{{ route('profile.show') }}#experience" target="_blank" class="p-4 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-green-400 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-200 duration-200"><i class="fa-solid fa-pen"></i></a>
                        @endif
                    </div>

                    <div>
                        @foreach ($userData['workExperience'] as $exp)
                            <div class="flex justify-between items-center p-4 odd:border-b odd:border-gray-200 dark:odd:border-neutral-600 hover:bg-gray-100 dark:hover:bg-gray-600 duration-200">
                                <div class="flex items-center gap-4">
                                    <div class="bg-neutral-200 dark:bg-gray-700 w-12 h-12 flex justify-center items-center rounded-md">
                                        <i class="fa-solid fa-briefcase"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <h3 class="font-semibold">{{ $exp->position }}</h3>
                                        <h4 class="font-medium text-sm">{{ $exp->company_name }}</h4>
                                        <span class="dark:text-white text-gray-800 text-sm">{{ __("Started") }} : {{ $exp->start_date }} 
                                            @if ($exp->end_date)
                                                - {{ __("Ended") }} : {{ $exp->end_date }}
                                            @else
                                                - {{ __("Present") }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <a href="" wire:click.prevent="showDetailsModal('{{ Crypt::encrypt($exp->id) }}')" class="text-green-400 underline hover:text-green-500 duration-200">Details</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($userData['skills'] && count($userData['skills']) > 0)
                <div class="bg-white rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                    <div class="flex flex-row gap-4 items-center w-full p-4">
                        <h3 class="text-xl font-semibold w-full">{{ __("Skills") }}</h3>
                        @if($user_id == auth()->user()->id)
                            <a href="{{ route('profile.show') }}#job_seeker_info" target="_blank" class="p-4 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-green-400 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-200 duration-200"><i class="fa-solid fa-pen"></i></a>
                        @endif
                    </div>
                    <div class="p-4 flex gap-2 flex-wrap">
                        @foreach ($userData['skills'] as $skill)
                            <span class="bg-transparent border border-green-400 text-green-400 font-semibold px-4 py-1 cursor-pointer rounded-md hover:shadow-lg hover:shadow-green-400/50 duration-200">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            @else
            <div class="flex flex-col items-center justify-center gap-8 bg-white p-12 rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                <h3 class="text-2xl font-semibold h-0   ">{{ __("Profile under construction.") }}</h3>
                <p>This user's profile is still incomplete, but you could still make contact.</p>
                <img src="{{ asset('vectors/career.svg') }}" class="w-[250px]">
            </div>
            @endif

            <!-- Employer profile view -->
            @else
                @if($userData['about'])
                <div class="bg-white p-4 rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                    <div class="flex w-full items-center justify-between">
                        <h3 class="text-xl font-semibold">{{ __("About") }}</h3>
                        @if($user_id == auth()->user()->id)
                            <a href="{{ route('profile.show') }}#employer-info" target="_blank" class="p-4 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-green-400 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-200 duration-200"><i class="fa-solid fa-pen"></i></a>
                        @endif
                    </div>
                    <p class="text-sm">{!! $userData['about'] !!}</p>
                </div>
                @if($userData['posts'])
                <div class="bg-white p-4 rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                    <div class="flex w-full items-center justify-between">
                        <h3 class="text-xl font-semibold">{{ __("Job offers") }}</h3>
                        @if($user_id == auth()->user()->id)
                            <a href="{{ route('jobofferposts.index') }}" target="_blank" class="p-4 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-green-400 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-200 duration-200"><i class="fa-solid fa-pen"></i></a>
                        @endif
                    </div>
                    <div class="flex px-2 w-full justify-end py-8">
                        <div class="flex gap-3">
                            <span onclick="document.getElementById('cards-container').scrollBy(-300, 0)"
                                class="p-2 rounded-full border-[1px] border-gray-300 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 6L9 12L15 18" stroke="#888888" stroke-width="2" />
                                </svg>
                            </span>
                            <span onclick="document.getElementById('cards-container').scrollBy(300, 0)"
                                class="p-2 rounded-full border-[1px] border-gray-300 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="#888888" stroke-width="2" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <ul id="cards-container"
                        class="blur-dev card-slider flex gap-4 overflow-y-hidden overflow-x-auto scroll-smooth">
                        @foreach ($userData['posts'] as $post)
                            <li 
                                wire:key='{{ $post->id }}'
                                class="flex flex-col gap-6 border-[1px] border-gray-200 rounded-lg w-72 min-w-72 max-w-72 p-5 cursor-pointer hover:border-gray-600 hover:scale-[1.01] duration-200">
                                <div class="flex items-center justify-end">
                                    <img class="rounded-full w-14 h-14"
                                        src="{{ Storage::url($user->profile_photo_path) }}"
                                        alt="Offer-img">
                                    <p class="font-medium ml-3 text-lg text-gray-300">
                                    {{ $userData['companyName'] }}
                                    </p>
                                    <p class="text-[var(--color-primary)] font-bold flex-1 text-end">${{ $post->salary }}</p>
                                </div>
                                <h3 class="font-medium text-xl my-0 text-gray-800 dark:text-neutral-200">{{ $post->title }}</h3>
                                <div class="text-gray-400 font-thing p-0 mt-0 flex justify-between items-center">
                                    <p class="h-0">
                                        {{ $post->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                                <p class="h-0">{{ $this->getCountryName($post->country_id). ", ". $this->getCityName($post->city_id) }}</p>
                                <p class="px-4 py-1 rounded-md bg-orange-300 text-sm w-fit text-orange-900 font-semibold">{{ __("Requires "). $post->required_experience . " years of experience" }}</p>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                @else
                <div class="flex flex-col items-center justify-center gap-8 bg-white p-12 rounded-md dark:bg-gray-800 dark:text-neutral-200 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-2xl font-semibold h-0   ">{{ __("Profile under construction.") }}</h3>
                    <p>This user's profile is still incomplete, but you could still make contact.</p>
                    <img src="{{ asset('vectors/career.svg') }}" class="w-[250px]">
                </div>
                @endif
            @endif
        </main>        
        
    </div>

    <x-dialog-modal wire:model="showingModal">
        <x-slot name="title">{{ __("Contact ") . $user->name }}</x-slot>
        <x-slot name="content">
            <form>
                @csrf
                <div class="sm:col-span-6 mb-4">
                    <div class="mt-1">
                      <x-label for="subject">{{ __("Subject") }}</x-label>
                      <select id="subject" wire:model.live="subject" name="subject" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm dark:bg-gray-900">
                        <option value="null" selected disabled>{{ __("Select subject") }}</option>
                        <option value="{{ __("Feedback and Suggestions") }}">{{ __("Feedback and Suggestions") }}</option>
                        <option value="{{ __("Reporting an Issue") }}">{{ __("Reporting an Issue") }}</option>
                        <option value="{{ __("Interested in working with you") }}">{{ __("Interested in working with you") }}</option>
                        <option value="{{ __("General Inquiry") }}">{{ __("General Inquiry") }}</option>
                        <option value="{{ __("Advertising and Sponsorship") }}">{{ __("Advertising and Sponsorship") }}</option>
                      </select>
                    @error('subject') <span class="error text-red-600">{{ $message }}</span> @enderror
                </div>
                </div>
                <div class="sm:col-span-6 mb-4">
                    <div class="mt-1" wire:ignore>
                      <x-label for="message">{{ __("Message") }}</x-label>
                      <textarea id="message"></textarea>
                      @script
                        <script>
                        ClassicEditor
                        .create(document.querySelector('#message'),{
                                    toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
                                })
                                .then(editor => {
                                    editor.model.document.on('change:data', () => {
                                    @this.set('message', editor.getData());
                                    })
                                })
                                .catch(error => {
                                    console.error(error);
                                });  
                        </script>
                        @endscript
                    </div>
                    @error('message') <span class="error text-red-600">{{ $message }}</span> @enderror
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:click="sendMail('{{ $user->email }}')">Send message</x-button>
            <div wire:loading wire:target="sendMail" class="text-gray-800 dark:text-gray-200 ml-2">{{ __("Sending message") }}...</div>
        </x-slot>
    </x-dialog-modal>
    <x-dialog-modal wire:model="showingDetails">
        <x-slot name="title">Responsibilities</x-slot>
        <x-slot name="content">
            <p>
                {{ $responsibilities ? $responsibilities : "No details provided" }}
            </p>
        </x-slot>
        <x-slot name="footer"><x-button wire:click="closeDetailsModal">{{ __("Close") }}</x-button></x-slot>
    </x-dialog-modal>
    @script
    <script>
            $wire.on('email-sent',(event)=>{
                Toastify({
                    text: "Email sent successfully !",
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
            });

            $wire.on('email-failed',(event)=>{
                Toastify({
                    text: "Email failed !",
                    duration: 2000,
                    close:true,
                    gravity: "top", // `top` or `bottom`
                    position: "left", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#D43E3E",
                    },
                    onClick: function(){} // Callback after click
                }).showToast();
            })
            $wire.on('error',(event)=>{
                Toastify({
                    text: event.message,
                    duration: 2000,
                    close:true,
                    gravity: "top", // `top` or `bottom`
                    position: "left", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#D43E3E",
                    },
                    onClick: function(){} // Callback after click
                }).showToast();
            })

    </script>
    @endscript
</div>
