<div class="dark:bg-gray-900">
    <div>
        <livewire:home-page.pop-up-offer-details />
    </div>
    @livewire('applying-process')
    @unless (!$showingFilter)
        <div wire:loading.class='opacity-50 duration-200' wire:click.outside="$set('showingFilter', false)"
            class="rounded-lg absolute w-[378px] top-24 right-48 bg-gray-100 dark:bg-gray-800 z-50 p-5 shadow-xl">
            @livewire('home-page.filter-offers')
        </div>
    @endunless
    <div class="flex px-14 py-4">
        <div class="job-name">
            <h3 class="text-lg font-bold text-[var(--color-primary)] ml-1">Just For You</h3>
            <p class="text-base font-light text-gray-400">Based on your interests</p>
        </div>
        <div class="flex justify-end flex-1">
            <button wire:click="$toggle('showingFilter')"
                class="flex gap-4 px-6 h-10 font-bold bg-gray-200 dark:bg-gray-900 text-gray-500 dark:text-gray-400 rounded-full border-[1px] border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 duration-200 shadow-sm"
                id="btn-filters">
                <span class="my-auto">
                    <svg width="21" height="14" viewBox="0 0 21 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 2.8H21V4.2H0V2.8Z" fill="#888" />
                        <path d="M0 10.5H21V11.9H0V10.5Z" fill="#888" />
                        <path
                            d="M9.41379 3.15C9.41379 4.8897 7.95486 6.3 6.15517 6.3C4.35549 6.3 2.89655 4.8897 2.89655 3.15C2.89655 1.4103 4.35549 0 6.15517 0C7.95486 0 9.41379 1.4103 9.41379 3.15Z"
                            fill="#888" />
                        <path
                            d="M17.3793 10.85C17.3793 12.5897 15.9204 14 14.1207 14C12.321 14 10.8621 12.5897 10.8621 10.85C10.8621 9.1103 12.321 7.7 14.1207 7.7C15.9204 7.7 17.3793 9.1103 17.3793 10.85Z"
                            fill="#888" />
                        <path
                            d="M6.15517 5.3C5.91447 5.3 5.6844 5.26482 5.46948 5.2H6.84086C6.62594 5.26482 6.39588 5.3 6.15517 5.3ZM7.91221 1.8H4.39814C4.80687 1.31653 5.43317 1 6.15517 1C6.87718 1 7.50347 1.31653 7.91221 1.8ZM14.1207 13C13.88 13 13.6499 12.9648 13.435 12.9H14.8064C14.5915 12.9648 14.3614 13 14.1207 13ZM15.8777 9.5H12.3637C12.7724 9.01653 13.3987 8.7 14.1207 8.7C14.8427 8.7 15.469 9.01653 15.8777 9.5Z"
                            stroke="#888" stroke-width="2" />
                    </svg>
                </span>
                <span class="my-auto">
                    Filters
                </span>
            </button>
        </div>
    </div>
    <div class="flex align-top m-10 mb-20 gap-6">
        <div id="offers-list-container"
            class="blur-dev list-content-container flex-1 md:max-h-[585px] overflow-hidden md:overflow-y-scroll pr-[3%]">
            <ul class="list-content list-none">
                @foreach ($offers as $key => $offer)
                    <li wire:key="{{ $offer->id }}" wire:click="showOfferDetails({{ $offer->id }})"
                        class="{{ $offer->id - 1 == self::$selectedPostId ? 'checked' : 'unchecked' }} cursor-pointer hover:translate-x-1 duration-200 py-[4%] px-[5%] border-b-[0.5px] border-gray-300 dark:border-gray-600 dark:text-gray-300">
                        <div class="ic-name-rating-like flex justify-start items-center gap-[3%]">
                            <img class="rounded-full w-10 h-10 shadow-xl"
                                src="@foreach ($users as $user) {{ $offer->user_id == $user->id ? 'storage/' . $user->profile_photo_path : null }} @endforeach"
                                alt="{{ 'img_' . $employers[$offer->id - 1]->companyName }}">
                            <h3 class="font-bold text-xl">
                                @foreach ($employers as $employer)
                                    {{ $employer->user_id == $offer->user_id ? $employer->companyName : null }}
                                @endforeach
                            </h3>
                            <div class="flex justify-end flex-1">
                                <span wire:loading.class='scale-90 opacity-50 duration-200'
                                    wire:target='addFav({{ $offer->id }})'
                                    @if ($offer->id - 1 == self::$selectedPostId) wire:click='addFav({{ $offer->id }})' @else
                wire:click.stop='addFav({{ $offer->id }})' @endif
                                    class="ic-like rounded-full hover:bg-gray-100
                dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                                    <img src="{{ $this->likedPost($offer->id) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
                                        alt="ic-heart" width="30" height="30">
                                </span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex flex-col flex-1">
                                <h2 class="mt-[5%] text-xl dark:text-gray-100">{{ $offer->title }}</h2>
                                <span
                                    class="font-light text-gray-400 mt-[3%]">{{ App\Models\Country::getCountry($offer->country_id)->name . ', ' . App\Models\City::getCity($offer->city_id)->name }}</span>
                                <span class="font-light text-gray-400">{{ "[$offer->flexibility" . ']' }}</span>
                                <span
                                    class="font-medium text-[var(--color-primary)] mt-[2%]">{{ '$' . $offer->salary }}</span>
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

        <div class="blur-dev content-details flex-1 max-w-[50%] max-h-[585px] border-l border-gray-400 overflow-y-auto hidden md:block"
            id="offer-description">
            <div class="flex items-center ml-[5%]">
                <img wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                    class="rounded-full w-10 h-10 shadow-xl"
                    src="@foreach ($users as $user) {{ $offers[self::$selectedPostId]->user_id == $user->id ? 'storage/' . $user->profile_photo_path : null }} @endforeach"
                    alt="{{ 'img_' . $employers[$offer->id - 1]->companyName }}">
                <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                    class="ml-[3%] text-xl dark:text-gray-300">
                    @foreach ($employers as $employer)
                        {{ $offers[self::$selectedPostId]->user_id == $employer->user_id ? $employer->companyName : null }}
                    @endforeach
                </h3>
                <div class="btns flex items-center flex-1 gap-2 justify-end mr-1">
                    <span
                        class="rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                        <img src="images/ic-report.png" alt="ic-heart" width="30" height="30">
                    </span>
                    <span wire:loading.class='scale-90 opacity-50 duration-200'
                        wire:target='addFav({{ self::$selectedPostId + 1 }})'
                        wire:click='addFav({{ self::$selectedPostId + 1 }})'
                        class="ic-like rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                        <img src="{{ $this->likedPost(self::$selectedPostId + 1) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
                            alt="ic-heart" width="30" height="30">
                    </span>
                    @if ($this->alreadyApplied(self::$selectedPostId))
                        <button disabled
                            class="disabled:opacity-60 bg-[var(--color-primary)] border-[1px] border-transparent px-5 lg:px-10 py-2 rounded-full text-gray-100 font-bold hover:bg-transparent hover:border-[var(--color-primary)] hover:border-[1px] hover:text-[var(--color-primary)] duration-200">Applied</button>
                    @else
                        <button wire:click="showModal()"
                            class="bg-[var(--color-primary)] border-[1px] border-transparent px-5 lg:px-10 py-2 rounded-full text-gray-100 font-bold hover:bg-transparent hover:border-[var(--color-primary)] hover:border-[1px] hover:text-[var(--color-primary)] duration-200">Apply</button>
                    @endif
                </div>
            </div>
            <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                class="mt-[5%] mb-[1%] ml-[5%] text-lg font-bold dark:text-gray-300">
                {{ $offers[self::$selectedPostId]->title }}
            </h3>
            <div class="flex flex-col">
                <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                    class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ App\Models\Country::getCountry($offers[self::$selectedPostId]->country_id)->name . ', ' . App\Models\City::getCity($offers[self::$selectedPostId]->city_id)->name }}</span>
                <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                    class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ '[' . $offers[self::$selectedPostId]->flexibility . ']' }}</span>
            </div>
            <hr class="border-none h-[5px] bg-gray-100 dark:bg-gray-400 mt-8 mb-[5%] mx-0">
            <div wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                class="content-description px-[4%] dark:text-gray-300">
                {!! $offers[self::$selectedPostId]->description !!}
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        let component = @this;
        component.windowWidth = window.innerWidth;
    })
</script>
