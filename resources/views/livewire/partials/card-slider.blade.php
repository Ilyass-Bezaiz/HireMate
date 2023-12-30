<div wire:transition class="flex flex-col gap-4 mt-8 dark:*:text-gray-200">
    <div class="flex px-2">
        <h1 class="flex-1 text-2xl font-semibold">Your Favourites</h1>
        <div class="flex gap-3">
            <span onclick="document.getElementById('cards-container').scrollBy(-300, 0)" class="p-2 rounded-full border-[1px] border-gray-300 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 6L9 12L15 18" stroke="#888888" stroke-width="2"/>
                </svg>                    
            </span>
            <span onclick="document.getElementById('cards-container').scrollBy(300, 0)" class="p-2 rounded-full border-[1px] border-gray-300 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="#888888" stroke-width="2"/>
                </svg>                    
            </span>
        </div>
    </div>
    <div>
        <ul id="cards-container" class="blur-dev card-slider flex gap-4 overflow-y-hidden overflow-x-auto scroll-smooth">
            @foreach ($posts as $post)
                <li wire:key='{{$post->id}}' class="flex flex-col gap-6 border-[1px] border-gray-200 rounded-lg min-w-72 p-5 cursor-pointer hover:border-gray-600 hover:scale-[1.01] duration-200">                
                    <div class="flex items-center justify-end">
                        <img class="rounded-full w-14 h-14" src="@foreach ($users as $user) {{ $post->user_id == $user->id ? 'storage/'.$user->profile_photo_path : null}} @endforeach" alt="Offer-img">
                        <p class="font-medium ml-3 text-lg text-gray-300">@foreach ($users as $user) {{ $post->user_id == $user->id ? App\Models\Employer::where('user_id', $user->id)->get()[0]->companyName : null}}@endforeach</p>
                        <p class="text-[var(--color-primary)] font-bold flex-1 text-end">{{"$". $post->salary }} </p>
                    </div>
                    <h3 class="font-medium text-xl my-0">{{$post->title}}</h3>
                    <div class="text-gray-400 font-thing p-0 mt-0 flex justify-between items-center">
                        <p>{{App\Livewire\HomePage\JobseekerOffers::getPostPublishDay($post)}}</p>
                    </div>
                    <div class="flex gap-3">
                        <button class="btn-primary flex-1 items-center">Hire Now</button>
                        <span class="rounded-full p-2 cursor-pointer border-1px border-green-400 hover:bg-gray-700">
                            <img src="{{ $this->likedPost($post->id) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png'}} " alt="ic-heart" width="30" height="30">
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

