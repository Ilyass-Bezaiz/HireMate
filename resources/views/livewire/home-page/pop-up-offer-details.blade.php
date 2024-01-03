<div class="dark:*:text-gray-300">
    <x-dialog-modal wire:model.live="showingModal">
        <x-slot name="title"></x-slot>
        @if (auth()->user()->role == 'job_seeker')
            <x-slot name="content">
                <div class="flex items-center ml-[5%]">
                    <img class="rounded-full w-10 h-10 shadow-xl"
                        src="@foreach ($users as $user) {{ $offers[$postId]->user_id == $user->id ? 'storage/' . $user->profile_photo_path : null }} @endforeach">
                    <h3 class="ml-[3%] text-xl dark:text-gray-300">
                        @foreach ($employers as $employer)
                            {{ $offers[$postId]->user_id == $employer->user_id ? $employer->companyName : null }}
                        @endforeach
                    </h3>
                    <div class="btns flex items-center flex-1 gap-2 justify-end mr-1">
                        <span
                            class="rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                            <img src="images/ic-report.png" alt="ic-heart" width="30" height="30">
                        </span>
                        <span wire:loading.class='scale-90 opacity-50 duration-200'
                            wire:target='addFav({{ $postId }})' wire:click='addFav({{ $postId }})'
                            class="ic-like rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                            <img src="{{ $this->likedPost($postId) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
                                alt="ic-heart" width="30" height="30">
                        </span>
                        <button wire:click="showModal"
                            class="bg-[var(--color-primary)] border-[1px] border-transparent px-5 lg:px-10 py-2 rounded-full text-gray-100 font-bold hover:bg-transparent hover:border-[var(--color-primary)] hover:border-[1px] hover:text-[var(--color-primary)] duration-200">Apply</button>
                    </div>
                </div>
                <h3 class="mt-[5%] mb-[1%] ml-[5%] text-lg font-bold dark:text-gray-300">
                    {{ $offers[$postId]->title }}
                </h3>
                <div class="flex flex-col">
                    <span
                        class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ App\Models\Country::getCountry($offers[$postId]->country_id)->name . ', ' . App\Models\City::getCity($offers[$postId]->city_id)->name }}</span>
                    <span
                        class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ '[' . $offers[$postId]->flexibility . ']' }}</span>
                </div>
                <hr class="border-none h-[5px] bg-gray-100 dark:bg-gray-400 mt-8 mb-[5%] mx-0">
                <div class="content-description px-[4%] dark:text-gray-300">
                    {!! $offers[$postId]->description !!}
                </div>
            </x-slot>
        @else
            <x-slot name="content">
                <div class="flex items-center ml-[5%]">
                    <img class="rounded-full w-10 h-10 shadow-xl"
                        src="@foreach ($users as $user) {{ $requests[$postId]->user_id == $user->id ? 'storage/' . $user->profile_photo_path : null }} @endforeach">
                    <h3 class="ml-[3%] text-xl dark:text-gray-300">
                        @foreach ($users as $user) {{ $requests[$postId]->user_id == $user->id ? $user->name : null }} @endforeach
                    </h3>
                    <div class="btns flex items-center flex-1 gap-2 justify-end mr-1">
                        <span wire:loading.class='scale-90 opacity-50 duration-200'
                            wire:target='addFav({{ $postId }})' wire:click='addFav({{ $postId }})'
                            class="ic-like rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 duration-200 cursor-pointer">
                            <img src="{{ $this->likedPost($postId) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
                                alt="ic-heart" width="30" height="30">
                        </span>
                        <button wire:click="showModal"
                            class="bg-[var(--color-primary)] border-[1px] border-transparent px-5 lg:px-10 py-2 rounded-full text-gray-100 font-bold hover:bg-transparent hover:border-[var(--color-primary)] hover:border-[1px] hover:text-[var(--color-primary)] duration-200">Hire</button>
                    </div>
                </div>
                <h3 class="mt-[5%] mb-[1%] ml-[5%] text-lg font-bold dark:text-gray-300">
                    {{ $requests[$postId]->title }}
                </h3>
                <div class="flex flex-col">
                    <span
                        class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ App\Models\Country::getCountry($requests[$postId]->country_id)->name . ', ' . App\Models\City::getCity($requests[$postId]->city_id)->name }}</span>
                    <span
                        class="text-[14spanx] font-light text-gray-400 ml-[5%]">{{ '[' . $requests[$postId]->flexibility . ']' }}</span>
                </div>
                <hr class="border-none h-[5px] bg-gray-100 dark:bg-gray-400 mt-8 mb-[5%] mx-0">
                <div class="content-description px-[4%] dark:text-gray-300">
                    {!! $requests[$postId]->description !!}
                </div>
            </x-slot>
        @endif

        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
