<div class="dark:bg-gray-900">
    @unless (!$showingFilter)
        <div wire:loading.class='opacity-50 duration-200' wire:click.outside="$set('showingFilter', false)" class="rounded-lg absolute w-[378px] top-24 right-48 bg-gray-100 dark:bg-gray-800 z-50 p-5 shadow-2xl border-2 border-gray-300 dark:border-gray-500 ">
            @livewire('home-page.filter-offers')
        </div>
    @endunless
    <div class="flex px-14 py-4">
        <div class="job-name">
            <h3 class="text-lg font-bold text-[var(--color-primary)] ml-1">Just For You</h3>
            <p class="text-base font-light text-gray-400">Based on your interests</p>
        </div>
        <div class="flex justify-end flex-1">
            <button wire:click="$toggle('showingFilter')" class="flex gap-4 px-6 h-10 font-bold bg-gray-200 dark:bg-gray-900 text-gray-500 dark:text-gray-400 rounded-full border-[1px] border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 duration-200 shadow-sm" id="btn-filters">
                <span class="my-auto">
                    <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 2.8H21V4.2H0V2.8Z" fill="#888"/>
                        <path d="M0 10.5H21V11.9H0V10.5Z" fill="#888"/>
                        <path d="M9.41379 3.15C9.41379 4.8897 7.95486 6.3 6.15517 6.3C4.35549 6.3 2.89655 4.8897 2.89655 3.15C2.89655 1.4103 4.35549 0 6.15517 0C7.95486 0 9.41379 1.4103 9.41379 3.15Z" fill="#888"/>
                        <path d="M17.3793 10.85C17.3793 12.5897 15.9204 14 14.1207 14C12.321 14 10.8621 12.5897 10.8621 10.85C10.8621 9.1103 12.321 7.7 14.1207 7.7C15.9204 7.7 17.3793 9.1103 17.3793 10.85Z" fill="#888"/>
                        <path d="M6.15517 5.3C5.91447 5.3 5.6844 5.26482 5.46948 5.2H6.84086C6.62594 5.26482 6.39588 5.3 6.15517 5.3ZM7.91221 1.8H4.39814C4.80687 1.31653 5.43317 1 6.15517 1C6.87718 1 7.50347 1.31653 7.91221 1.8ZM14.1207 13C13.88 13 13.6499 12.9648 13.435 12.9H14.8064C14.5915 12.9648 14.3614 13 14.1207 13ZM15.8777 9.5H12.3637C12.7724 9.01653 13.3987 8.7 14.1207 8.7C14.8427 8.7 15.469 9.01653 15.8777 9.5Z" stroke="#888" stroke-width="2"/>
                    </svg>                                                                                                                    
                </span>
                <span class="my-auto">
                    Filters
                </span>
            </button>
        </div>
    </div>
    <div class="flex align-top m-10 mb-20 gap-6">
        <div id="offers-list-container" class="blur-dev list-content-container flex-1 md:max-h-[585px] overflow-hidden md:overflow-y-scroll pr-[3%]">
            <ul class="list-content list-none">
                @foreach($offers as $key => $offer)
                <li wire:key="{{ $offer->id }}" wire:click="showOfferDetails({{$offer->id}})" class="{{ $offer->id-1 == self::$selectedPostId ? "checked" : "unchecked" }} cursor-pointer hover:translate-x-1 duration-200 py-[4%] px-[5%] border-b-[0.5px] border-gray-300 dark:border-gray-600 dark:text-gray-300">
                    <div class="ic-name-rating-like flex justify-start items-center gap-[3%]">
                        <img class="rounded-full w-10 h-10 shadow-xl" src="@foreach ($users as $user) {{ $offer->user_id == $user->id ? 'storage/'.$user->profile_photo_path : null}} @endforeach" alt="{{ "img_" . $employers[$offer->id-1]->companyName }}">
                        <h3 class="font-bold text-xl">
                            @foreach ($employers as $employer)
                                {{ $employer->user_id == $offer->user_id ? $employer->companyName : null }}
                            @endforeach
                        </h3>
                        {{-- <p class="flex text-sm">4.6
                            <span class="my-auto ml-1">
                                <svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-gray-800 dark:fill-gray-300" d="M3.5316 1.5848C3.94197 0.528266 4.14716 0 4.5 0C4.85284 0 5.05803 0.528266 5.4684 1.5848L5.48751 1.634C5.71935 2.23089 5.83528 2.52933 6.07153 2.71073C6.30778 2.89213 6.61791 2.92081 7.23818 2.97818L7.35031 2.98855C8.36545 3.08244 8.87302 3.12938 8.98163 3.46287C9.09023 3.79636 8.71329 4.15052 7.95941 4.85884L7.7078 5.09524C7.32617 5.4538 7.13535 5.63308 7.04642 5.86806C7.02983 5.91189 7.01603 5.9568 7.00513 6.00249C6.94667 6.24745 7.00255 6.50753 7.1143 7.0277L7.14909 7.18961C7.35447 8.14558 7.45716 8.62356 7.27786 8.82973C7.21086 8.90677 7.12378 8.96224 7.02705 8.98949C6.76818 9.06244 6.40065 8.75316 5.66559 8.1346C5.18293 7.72843 4.94159 7.52534 4.66452 7.47966C4.55553 7.46168 4.44447 7.46168 4.33548 7.47966C4.0584 7.52534 3.81707 7.72843 3.33441 8.1346C2.59935 8.75316 2.23182 9.06244 1.97295 8.98949C1.87622 8.96224 1.78914 8.90677 1.72214 8.82973C1.54284 8.62356 1.64553 8.14558 1.85092 7.18961L1.8857 7.0277C1.99745 6.50753 2.05333 6.24745 1.99487 6.00249C1.98397 5.9568 1.97017 5.91189 1.95358 5.86806C1.86465 5.63308 1.67383 5.4538 1.2922 5.09524L1.04059 4.85884C0.28671 4.15052 -0.0902328 3.79636 0.0183748 3.46287C0.126982 3.12938 0.634552 3.08244 1.64969 2.98855L1.76182 2.97818C2.38209 2.92081 2.69222 2.89213 2.92847 2.71073C3.16472 2.52933 3.28065 2.23089 3.51249 1.634L3.5316 1.5848Z"/>
                                </svg>
                            </span>
                        </p>   --}}
                        <div class="flex justify-end flex-1">
                            <span wire:loading.class='scale-90 opacity-50 duration-200' wire:target='addFav({{ $offer->id }})' @if ($offer->id-1 == self::$selectedPostId) wire:click='addFav({{ $offer->id }})' @else wire:click.stop='addFav({{ $offer->id }})' @endif class="ic-like rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                                <img src="{{ $this->likedPost($offer->id) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png'}} " alt="ic-heart" width="30" height="30">
                            </span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col flex-1">
                            <h2 class="mt-[5%] text-xl dark:text-gray-100">{{ $offer->title }}</h2>
                            <span class="font-light text-gray-400 mt-[3%]">{{ App\Models\Country::getCountry($offer->country_id)->name . ", ". App\Models\City::getCity($offer->city_id)->name }}</span>
                            <span class="font-light text-gray-400">{{ "[$offer->flexibility" . "]"}}</span>
                            <span class="font-medium text-[var(--color-primary)] mt-[2%]">{{'$'. $offer->salary }}</span>
                        </div>
                        <div class="flex flex-1 justify-end items-end">
                            <span class="font-thin text-gray-400 text-[14px]">
                                {{ App\Livewire\HomePage\JobseekerOffers::getPostPublishDay($offer) }}
                            </span>
                        </div>
                    </div>
                </li>
                @endforeach           
            </ul>
        </div>
        
        <div class="blur-dev content-details flex-1 max-w-[50%] max-h-[585px] border-l border-gray-400 overflow-y-auto hidden md:block" id="offer-description">
            <div class="flex items-center ml-[5%]">
                <img wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails" class="rounded-full w-10 h-10 shadow-xl" src="@foreach ($users as $user) {{ $offers[self::$selectedPostId]->user_id == $user->id ? 'storage/'.$user->profile_photo_path : null}} @endforeach" alt="{{ "img_" . $employers[$offer->id-1]->companyName }}">
                <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails" class="ml-[3%] text-xl dark:text-gray-300">
                    @foreach ($employers as $employer)
                        {{ $offers[self::$selectedPostId]->user_id == $employer->user_id ? $employer->companyName : null }}
                    @endforeach
                </h3>
                <div class="btns flex items-center flex-1 gap-2 justify-end mr-1">
                    <span class="rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                        <img src="images/ic-report.png" alt="ic-heart" width="30" height="30">                            
                    </span>
                    <span wire:loading.class='scale-90 opacity-50 duration-200' wire:target='addFav({{ self::$selectedPostId+1 }})' wire:click='addFav({{ self::$selectedPostId+1 }})' class="ic-like rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                        <img src="{{ $this->likedPost(self::$selectedPostId+1) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} " alt="ic-heart" width="30" height="30">
                    </span>
                    <button class="bg-[var(--color-primary)] border-[1px] border-transparent px-5 lg:px-10 py-2 rounded-full text-gray-100 font-bold hover:bg-transparent hover:border-[var(--color-primary)] hover:border-[1px] hover:text-[var(--color-primary)] duration-200">Apply</button>
                </div>                        
            </div>
            <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails" class="mt-[5%] mb-[1%] ml-[5%] text-lg font-bold dark:text-gray-300">
                {{ $offers[self::$selectedPostId]->title }}
            </h3>
            <div class="flex flex-col">
                <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails" class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ App\Models\Country::getCountry($offers[self::$selectedPostId]->country_id)->name . ", ". App\Models\City::getCity($offers[self::$selectedPostId]->city_id)->name }}</span>
                <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails" class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ "[". $offers[self::$selectedPostId]->flexibility . "]"}}</span>
            </div>
            <hr class="border-none h-[5px] bg-gray-100 dark:bg-gray-400 mt-8 mb-[5%] mx-0">
            <div wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails" class="content-description px-[4%] dark:text-gray-300">
                {!! $offers[self::$selectedPostId]->description !!}
            </div>
        </div>
    </div>
</div>