<div class="dark:bg-gray-900">
    <livewire:home-page.pop-up-offer-details />
    {{-- @livewire('applying-process') --}}
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
    </div>
    <div class="flex align-top m-10 mb-20 gap-6">
        <div id="offers-list-container"
            class="blur-dev list-content-container flex-1 md:max-h-[585px] overflow-hidden md:overflow-y-scroll pr-[3%]">
            <ul class="list-content list-none">
                @foreach ($requests as $key => $request)
                    <li wire:key="{{ $request->id }}" wire:click="showOfferDetails({{ $request->id }})"
                        class="{{ $request->id - 1 == self::$selectedPostId ? 'checked' : 'unchecked' }} cursor-pointer hover:translate-x-1 duration-200 py-[4%] px-[5%] border-b-[0.5px] border-gray-300 dark:border-gray-600 dark:text-gray-300">
                        <div class="ic-name-rating-like flex justify-start items-center gap-[3%]">
                            <img class="rounded-full w-12 h-12 shadow-xl"
                                src="@foreach ($users as $user) {{ $request->user_id == $user->id ? 'storage/' . $user->profile_photo_path : null }} @endforeach">
                            <h3 class="font-bold text-xl">
                                @foreach ($users as $user)
                                    {{ $request->user_id == $user->id ? $user->name : null }}
                                @endforeach
                            </h3>
                            <div class="flex justify-end flex-1">
                                <span wire:loading.class='scale-90 opacity-50 duration-200'
                                    wire:target='addFav({{ $request->id }})'
                                    @if ($request->id - 1 == self::$selectedPostId) wire:click='addFav({{ $request->id }})' @else
                wire:click.stop='addFav({{ $request->id }})' @endif
                                    class="ic-like rounded-full hover:bg-gray-100
                dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                                    <img src="{{ $this->likedPost($request->id) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
                                        alt="ic-heart" width="30" height="30">
                                </span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex flex-col flex-1">
                                <h2 class="mt-[5%] text-xl dark:text-gray-100">{{ $request->title }}</h2>
                                <span
                                    class="font-light text-gray-400 mt-[3%]">{{ App\Models\Country::getCountry($request->country_id)->name . ', ' . App\Models\City::getCity($request->city_id)->name }}</span>
                                <span class="font-light text-gray-400">{{ "[$request->flexibility" . ']' }}</span>
                                <span class="font-medium text-[var(--color-primary)] mt-[2%]">Expected Salary:
                                    {{ ' +$' . $request->expected_salary }}</span>
                            </div>
                            <div class="flex flex-1 justify-end items-end">
                                <span class="font-thin text-gray-400 text-[14px]">
                                    {{ App\Livewire\HomePage\JobseekerOffers::getPostPublishDay($request) }}
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
                    class="rounded-full w-14 h-14 shadow-xl"
                    src="@foreach ($users as $user) {{ $requests[self::$selectedPostId]->user_id == $user->id ? 'storage/' . $user->profile_photo_path : null }} @endforeach">
                <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                    class="ml-[3%] text-xl dark:text-gray-300">
                    @foreach ($users as $user)
                        {{ $requests[self::$selectedPostId]->user_id == $user->id ? $user->name : null }}
                    @endforeach
                </h3>
                <div class="btns flex items-center flex-1 gap-2 justify-end mr-1">
                    <span wire:loading.class='scale-90 opacity-50 duration-200'
                        wire:target='addFav({{ self::$selectedPostId + 1 }})'
                        wire:click='addFav({{ self::$selectedPostId + 1 }})'
                        class="ic-like rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                        <img src="{{ $this->likedPost(self::$selectedPostId + 1) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
                            alt="ic-heart" width="30" height="30">
                    </span>
                    <button wire:click="showModal()"
                        class="bg-[var(--color-primary)] border-[1px] border-transparent px-5 lg:px-10 py-2 rounded-full text-gray-100 font-bold hover:bg-transparent hover:border-[var(--color-primary)] hover:border-[1px] hover:text-[var(--color-primary)] duration-200">Hire</button>
                </div>
            </div>
            <h3 wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                class="mt-[5%] mb-[1%] ml-[5%] text-lg font-bold dark:text-gray-300">
                {{ $requests[self::$selectedPostId]->title }}
            </h3>
            <div class="flex flex-col">
                <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                    class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ App\Models\Country::getCountry($requests[self::$selectedPostId]->country_id)->name . ', ' . App\Models\City::getCity($requests[self::$selectedPostId]->city_id)->name }}</span>
                <span wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                    class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ '[' . $requests[self::$selectedPostId]->flexibility . ']' }}</span>
            </div>
            <hr class="border-none h-[5px] bg-gray-100 dark:bg-gray-400 mt-8 mb-[5%] mx-0">
            <div wire:loading.class="opacity-50 duration-300" wire:target="showOfferDetails"
                class="content-description px-[4%] dark:text-gray-300">
                {!! $requests[self::$selectedPostId]->description !!}
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
