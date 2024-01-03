<div wire:transition class="relative flex flex-col gap-4 mt-8 dark:*:text-gray-200">
  <div class="flex px-2">
    <h1 class="flex-1 text-2xl font-semibold">{{ $title }}</h1>
    <div class="flex gap-3">
      <span onclick="document.getElementById('cards-container').scrollBy(-300, 0)"
        class="p-2 rounded-full border-[1px] border-gray-300 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 6L9 12L15 18" stroke="#888888" stroke-width="2" />
        </svg>
      </span>
      <span onclick="document.getElementById('cards-container').scrollBy(300, 0)"
        class="p-2 rounded-full border-[1px] border-gray-300 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 18L15 12L9 6" stroke="#888888" stroke-width="2" />
        </svg>
      </span>
    </div>
  </div>
  <div>
    @if (auth()->user()->role == 'job_seeker')
    <ul id="cards-container" class="blur-dev card-slider flex gap-4 overflow-y-hidden overflow-x-auto scroll-smooth">
      @foreach ($posts as $key => $post)
      <li wire:click="showPopUpDetails({{ App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->id }})"
        wire:key='{{ $post->id }}'
        class="flex flex-col gap-6 border-[1px] border-gray-200 rounded-lg w-72 min-w-72 max-w-72 p-5 cursor-pointer hover:border-gray-600 hover:scale-[1.01] duration-200">
        <div class="flex items-center justify-end">
          <img class="rounded-full w-14 h-14"
            src="{{ 'storage/' . App\Models\User::where('id', App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->user_id)->get()[0]->profile_photo_path }}"
            alt="Offer-img">
          <p class="font-medium ml-3 text-lg text-gray-300">
            {{ App\Models\Employer::where('user_id', App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->user_id)->get()[0]->companyName }}
          </p>
          <p class="text-[var(--color-primary)] font-bold flex-1 text-end">
            {{ "$" . App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->salary }} </p>
        </div>
        <h3 class="font-medium text-xl my-0">
          {{ App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->title }}</h3>
        <div class="text-gray-400 font-thing p-0 mt-0 flex justify-between items-center">
          <p>
            {{ App\Livewire\HomePage\JobseekerOffers::getPostPublishDay(App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]) }}
          </p>
        </div>
        <div class="flex gap-3">
          @if($post->status == 'pending')
          <button disabled
            class="bg-[#FBE4B7] rounded-full hover:bg-[#ffd98e] dark:text-black flex-1 items-center">{{$post->status}}</button>
          @elseif($post->status == 'Accepted')
          <button disabled
            class="bg-green-400 rounded-full hover:bg-green-600 dark:text-black flex-1 items-center">{{$post->status}}</button>
          @elseif($post->status == 'Rejected')
          <button disabled
            class="bg-red-400 rounded-full hover:bg-red-600 dark:text-black flex-1 items-center">{{$post->status}}</button>
          @endif
          <span wire:loading.class='scale-90 opacity-50 duration-200'
            wire:target='addFav({{ App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->id }})'
            wire:click.stop='addFav({{ App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->id }})'
            class="rounded-full p-2 cursor-pointer border-1px border-green-400 hover:bg-gray-700">
            <img
              src="{{ $this->likedPost(App\Models\JobOfferPost::where('id', $post->post_id)->get()[0]->id) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
              alt="ic-heart" width="30" height="30">
          </span>
        </div>
      </li>
      @endforeach
    </ul>
    @else
    <ul id="cards-container" class="blur-dev card-slider flex gap-4 overflow-y-hidden overflow-x-auto scroll-smooth">
      @foreach ($posts as $key => $post)
      <li wire:click="showPopUpDetails({{ App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->id }})"
        wire:key='{{ $post->id }}'
        class="flex flex-col gap-6 border-[1px] border-gray-200 rounded-lg w-72 min-w-72 max-w-72 p-5 cursor-pointer hover:border-gray-600 hover:scale-[1.01] duration-200">
        <div class="flex items-center justify-end">
          <img class="rounded-full w-14 h-14"
            src="{{ 'storage/' . App\Models\User::where('id', App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->user_id)->get()[0]->profile_photo_path }}"
            alt="Offer-img">
          <p class="font-medium ml-3 text-lg text-gray-300">
            {{ App\Models\User::where('id', App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->user_id)->get()[0]->name }}
          </p>
          <p class="text-[var(--color-primary)] font-bold flex-1 text-end">
            {{ "+$" . App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->expected_salary }}
          </p>
        </div>
        <div class="flex-1 flex items-center">
          <h3 class="font-medium text-xl my-0">
            {{ App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->title }}</h3>
        </div>
        <div class="text-gray-400 font-thing p-0 mt-1 flex items-end">
          <p>
            {{ App\Livewire\HomePage\JobseekerOffers::getPostPublishDay(App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]) }}
          </p>
        </div>
        <div class="flex gap-3">
          <button class="btn-primary flex-1 items-center">Hire Now</button>
          <span wire:loading.class='scale-90 opacity-50 duration-200'
            wire:target='addFav({{ App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->id }})'
            wire:click.stop='addFav({{ App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->id }})'
            class="rounded-full p-2 cursor-pointer border-1px border-green-400 hover:bg-gray-700">
            <img
              src="{{ $this->likedPost(App\Models\JobSeekerPost::where('id', $post->post_id)->get()[0]->id) ? 'images/ic-full-heart.png' : 'images/ic-empty-heart.png' }} "
              alt="ic-heart" width="30" height="30">
          </span>
        </div>
      </li>
      @endforeach
    </ul>
    @endif
  </div>
</div>