<div class="max-w-6xl mx-auto">
  <div class="flex items-align justify-start gap-x-8 w-full mt-[32px]">

    <!--Filters for posts-->
    <div
      class="sticky top-0 width-[350px] bg-white dark:bg-gray-800 p-7 rounded-md border-[1px] border-[#d9d9d9] h-[320px] dark:border-gray-700">
      <form wire:submit.prevent="" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
          <label for="categoryFilter" class="block text-[20px] font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by category</label>
          @if($categories)
            <select wire:model="categoryId" id="categoryFilter" name="categoryFilter"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:text-white dark:bg-gray-800 dark:border-gray-700">
                <option value="null" selected disabled>Select your category</option>
                @if($categories)
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
          @endif
        </div>
        <div class="mb-6">
          <label for="dateFilter" class="block text-[20px] font-medium text-gray-700 mb-2 dark:text-gray-300">Filter by date</label>
          <select wire:model="selectedDate" id="dateFilter" name="dateFilter"
            class="mt-1 block w-[350px] py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:text-white dark:bg-gray-800 dark:border-gray-700">
            <option value="null" selected disabled>Select your date</option>
            <option value="24h">Last 24h</option>
            <option value="week">Last week</option>
            <option value="month">Last month</option>
            <option value="3months">Last 3 months</option>
          </select>
        </div>
      </form>
      <button wire:click="applyFilters" class="w-full rounded-full py-2 border border-[1px] border-[#4DD783] text-[#4DD783] hover:bg-[#4DD783] hover:text-[white]">Filter posts</button>
    </div>

    <!--Create post box-->
    <div class="w-2/3 overflow-y-hidden">
        <div class="w-full bg-white p-7 rounded-md border-[1px] border-[#d9d9d9] dark:bg-gray-800 dark:border-gray-700">
            <span wire:transition.out.opacity.duration.200ms wire:loading wire:target="createPost()" class="bg-green-400 rounded-md text-white font-bold p-2 border border-green-500">Post created successfully</span>
            <form enctype="multipart/form-data">
                @csrf
                <div class="mb-6 width-[800px]">
                    <label for="post-title" class="block text-[20px] font-medium text-gray-700 mb-2 dark:text-white">Create post</label>
                    <input wire:model="title" placeholder="Title" type="text" id="post-title" name="post-title" class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5 dark:text-white dark:bg-gray-800 dark:border-gray-700"/>
                    @error('title') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror

                @if($categories)
                    <select wire:model="selectedCategory" id="category" name="category" class="mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:text-white dark:bg-gray-800 dark:border-gray-700">
                        <option wire:model="category" value="null" selected disabled>Choose category</option>
                        @if($categories)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                        @error('selectedCategory') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                    @endif
                    <textarea wire:model="description" placeholder="What's on your mind?" id="description" rows="3" class="block w-full mt-4 bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5 overflow-y-hidden dark:text-white dark:bg-gray-800 dark:border-gray-700"></textarea>
                    @error('description') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                    </select>
                </div>
            </form>
            <button class="w-1/3 rounded-full py-2 bg-[#4DD783] text-[white] border border-[1px] border-[#4DD783] hover:bg-green-500 dark:text-white" wire:click="createPost">+ Create post</button>
        </div>

      <!--Display posts here-->
      @if(count($posts) > 0)
      @foreach($posts as $post)
      <div class="my-6 p-6 bg-white h-auto rounded-md border-[1px] border-[#d9d9d9] dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between rounded-md w-full">
          <div class="flex items-center">
            <div class="flex items-center justify-center">
              <div class="img-picture w-[60px] h-[60px] rounded-full overflow-hidden">
                <!--Check if the user has uploaded a profile picture-->
                @if($post->user->profile_photo_path)
                    <img src="{{ Storage::url($post->user->profile_photo_path) }}" alt="Profile picture" class="w-full h-full object-cover">
                @else
                <!--Fall back to default picture if no profile picture uploaded-->
                    <img src="{{ asset('storage/profile-photos/defaultUser.jpg') }}" alt="Default picture" class="w-full h-full object-cover">
                @endif
              </div>
            </div>
            <div class="ml-2 flex flex-col items-start">
              <span class="font-bold dark:text-white">{{$post->user->name}} -
                <span class="font-light text-[14px] text-[#4DD783]">{{ $this->getHeadline($post->user_id) }}</span>
              </span>
              <span class="text-[12px] text-[#888]">{{ $post->created_at->diffForHumans() }}</span>
            </div>
          </div>
          <span class="bg-[#4DD783] text-[12px] rounded-md py-1 px-2 text-white font-bold border border-green-500 dark:text-gray-800">{{$post->category->name}}</span>
        </div>
        <div class="pt-6">
          <h2 class="font-bold text-[16px] mb-2 dark:text-white">{{ $post->title }}</h2>
          <p class="font-light text-[14px] m-0 break-words dark:text-white">{{ $post->description }}</p>
        </div>
        <div class="mt-6 flex flex-row items-center">
          <button wire:click="toggleLikePost({{$post->id}})"
            class="cursor-pointer flex flex-row items-center justify-between p-2 hover:bg-[#f5f5f5] rounded-md dark:hover:bg-gray-700">
            <svg wire:target="toggleLikePost({{$post->id}})" wire:loading.delay aria-hidden="true"
              class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor" />
              <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="#4DD783" />
            </svg>
            <svg wire:target="toggleLikePost({{$post->id}})" wire:loading.delay.remove xmlns="http://www.w3.org/2000/svg" width="26" height="24" viewBox="0 0 26 24"
              fill="{{ Auth::user()->hasLiked($post) ? '#4DD783' : 'none' }}">
              <path d="M2.79452 13.3699L12.3219 22.1601C12.6437 22.457 12.8046 22.6054 13 22.6054C13.1954 22.6054 13.3563 22.457 13.6781 22.1601L23.2055 13.3699C25.9108 10.874 26.2379 6.71586 23.9562 3.82755L23.6008 3.37759C20.9037 -0.0365739 15.5651 0.542922 13.6634 4.45627C13.3944 5.00988 12.6056 5.00987 12.3366 4.45627C10.4349 0.542921 5.09629 -0.0365701 2.39921 3.37759L2.04375 3.82756C-0.23792 6.71586 0.0892327 10.874 2.79452 13.3699Z" stroke="{{ Auth::user()->hasLiked($post) ? '#4DD783' : '#888' }}" />
            </svg>
            <span class="ml-2 text-[#888] font-bold">
              @if($post->likes()->count() == 0) Like
              @elseif($post->likes()->count() == 1) {{$post->likes()->count() }} Like
              @else {{$post->likes()->count() }} Likes
              @endif
            </span>
          </button>
          <div wire:click="showCommentModal({{$post->id}})"
            class="cursor-pointer ml-2 flex flex-row items-center justify-between p-2 hover:bg-[#f5f5f5] rounded-md dark:hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
              <path
                d="M24.1573 7.22215C25 8.48327 25 10.2388 25 13.75C25 17.2612 25 19.0167 24.1573 20.2779C23.7926 20.8238 23.3238 21.2926 22.7779 21.6573C21.6762 22.3935 20.1971 22.4865 17.5 22.4983V22.5L16.118 25.2639C15.6574 26.1852 14.3426 26.1852 13.882 25.2639L12.5 22.5V22.4983C9.80287 22.4865 8.32384 22.3935 7.22215 21.6573C6.6762 21.2926 6.20744 20.8238 5.84265 20.2779C5 19.0167 5 17.2612 5 13.75C5 10.2388 5 8.48327 5.84265 7.22215C6.20744 6.6762 6.6762 6.20744 7.22215 5.84265C8.48327 5 10.2388 5 13.75 5H16.25C19.7612 5 21.5167 5 22.7779 5.84265C23.3238 6.20744 23.7926 6.6762 24.1573 7.22215Z"
                stroke="#888888" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M11.25 11.25L18.75 11.25" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M11.25 16.25H15" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="ml-2 text-[#888] font-bold">Comment</span>
          </div>
          @if(auth()->user()->id == $post->user_id)
            <div wire:click="showUpdateModal({{$post->id}})" class="cursor-pointer ml-2 flex flex-row items-center justify-between p-2 hover:bg-[#f5f5f5] rounded-md dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M16.9393 7.23223L16.5858 7.58579L16.9393 7.23223L16.7678 7.06066L16.7445 7.03738C16.4311 6.72395 16.1611 6.45388 15.9157 6.2667C15.6528 6.0661 15.3604 5.91421 15 5.91421C14.6396 5.91421 14.3472 6.0661 14.0843 6.2667C13.8389 6.45388 13.5689 6.72395 13.2555 7.03739L13.2322 7.06066L6.03816 14.2547C6.02714 14.2658 6.01619 14.2767 6.00533 14.2875C5.84286 14.4496 5.69903 14.5932 5.59766 14.7722C5.4963 14.9512 5.44723 15.1484 5.39179 15.3711C5.38809 15.386 5.38435 15.401 5.38057 15.4162L4.71704 18.0703C4.71483 18.0791 4.7126 18.088 4.71036 18.097C4.67112 18.2537 4.62921 18.421 4.61546 18.5615C4.60032 18.7163 4.60385 18.9773 4.81326 19.1867C5.02267 19.3961 5.28373 19.3997 5.43846 19.3845C5.57899 19.3708 5.74633 19.3289 5.90301 19.2896C5.91195 19.2874 5.92085 19.2852 5.92971 19.283L5.92972 19.283L5.95149 19.2775L5.95151 19.2775L8.58384 18.6194C8.59896 18.6156 8.61396 18.6119 8.62885 18.6082C8.85159 18.5528 9.04877 18.5037 9.2278 18.4023C9.40683 18.301 9.55035 18.1571 9.71248 17.9947C9.72332 17.9838 9.73425 17.9729 9.74527 17.9618L16.9393 10.7678L16.9393 10.7678L16.9626 10.7445C17.2761 10.4311 17.5461 10.1611 17.7333 9.91573C17.9339 9.65281 18.0858 9.36038 18.0858 9C18.0858 8.63961 17.9339 8.34719 17.7333 8.08427C17.5461 7.83894 17.276 7.5689 16.9626 7.2555L16.9393 7.23223Z" stroke="#888888"/>
                    <path d="M12.5 7.5L15.5 5.5L18.5 8.5L16.5 11.5L12.5 7.5Z" fill="#888888"/>
                </svg>
                <span class="ml-2 text-[#888] font-bold">Edit</span>
            </div>
          @endif
        </div>
      </div>
      @endforeach
      @else
      <div class="my-6 p-6 bg-white h-auto rounded-md border-[1px] border-[#d9d9d9] dark:bg-gray-800 dark:border-gray-900">
        <div class="p-6 lg:text-2xl md:text-md text-md text-cente dark:text-white">Nothing to show!</div>
      </div>
      @endif
    </div>

    <!--Display Comments-->
    @if($selectedPost)
    <x-dialog-modal wire:model="showModal">
      <x-slot name="title">
        <h1 class="text-[20px] text-[#3A3838] dark:text-white">{{ $selectedPost->title }}</h1>
      </x-slot>
      <x-slot name="content">
        <span wire:transition.out.opacity.duration.200ms wire:loading wire:target="createComment()" class="bg-green-400 rounded-md text-white font-bold p-2 border border-green-500">Comment created successfully</span>
        <form wire:submit.prevent="" class="relative">
          @csrf
          <textarea wire:model="body" placeholder="What would you like to comment?" rows="3"
            class="relative w-full block mt-4 bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5 overflow-y-hidden dark:text-white dark:bg-gray-800 dark:border-gray-700"></textarea>
          @error('body') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
          <div class="mt-4">
            <button class="w-1/6 rounded-full py-2 bg-white text-[#4DD783] border border-[1px] border-[#4DD783] hover:bg-[#4DD783] hover:text-white dark:hover:bg-[#4DD783] dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:border-[#4dd783]" wire:click="closeModal">Cancel</button>
            @if($editComment)
                <button class="w-1/4 rounded-full py-2 bg-[#4DD783] text-[white] border border-[1px] border-[#4DD783] hover:bg-green-500" wire:click="updateComment()">Update comment</button>
            @else
                <button class="w-1/6 rounded-full py-2 bg-[#4DD783] text-[white] border border-[1px] border-[#4DD783] hover:bg-green-500" wire:click="createComment()">Comment</button>
            @endif
          </div>
        </form>
      </x-slot>
      <x-slot name="footer">
        <div
          class="flex flex-col w-full blur-dev list-content-container flex-1 md:max-h-[300px] overflow-hidden md:overflow-y-scroll pr-2">
          @if(count($comments) > 0)
            @foreach($comments as $comment)
            <div class="w-full my-3 p-4 bg-white h-auto rounded-md border-[1px] border-[#d9d9d9] dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between rounded-md w-full">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center rounded-full overflow-hidden">
                            <div class="w-[40px] h-[40px]">
                                @if($comment->user->profile_photo_path)
                                <img src="{{ Storage::url($comment->user->profile_photo_path) }}" alt="Profile picture"
                                class="w-full h-full object-cover">
                                @else
                                <!-- Fall back to default picture if no profile picture uploaded -->
                                <img src="{{ asset('storage/profile-photos/defaultUser.jpg') }}" alt="Default picture"
                                class="w-full h-full object-cover">
                                @endif
                            </div>
                        </div>
                        <div class="ml-2 flex flex-col items-start">
                            <span class="font-bold dark:text-white">{{$comment->user->name}} - <span
                                class="font-light text-[14px] text-[#4DD783]">{{ $this->getHeadline($comment->user_id) }}</span></span>
                            <span class="text-[12px] text-[#888]">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @if(auth()->user()->id == $comment->user_id)
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            <button @click="open = !open" class="bg-gray-200 text-gray-700 font-semibold w-[30px] h-[30px] flex items-center justify-center rounded-full inline-flex items-center hover:bg-gray-300 dark:bg-gray-500 dark:hover:bg-gray-400">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="4" viewBox="0 0 16 4" fill="none">
                                    <circle cx="8" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round" />
                                    <circle cx="2" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round" />
                                    <circle cx="14" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </span>
                            </button>
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-[100px] rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 dark:bg-gray-800">
                                <div class="py-1 flex-col items-center justify-center">
                                    <button wire:click="editCommentFunction({{$comment->id}})" class="w-full font-bold text-[#4DD783] block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">Edit</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="pt-3">
                    <p class="text-justify font-light text-[14px] m-0 break-words dark:text-white">{{ $comment->body }}</p>
                </div>
            </div>
            @endforeach
          @else
            <div class="w-full my-3 p-4 bg-white h-auto rounded-md border-[1px] border-[#d9d9d9] dark:border-gray-700">
                <p class="text-left text-base font-bold dark:text-white">Be the first to share your thoughts!</p>
            </div>
          @endif
        </div>
      </x-slot>
    </x-dialog-modal>
    @endif

    <!--Display Edit popUp-->
    @if($showEditModal)
        <x-dialog-modal>
            <x-slot name="title">
                <h1 class="block text-[20px] font-medium text-gray-700 mb-2 dark:text-white">Update your post</h1>
            </x-slot>
            <x-slot name="content">
                <form enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6 width-[800px]">
                        <input wire:model="editTitle" placeholder="Title" type="text" id="post-title" name="post-title" class="relative w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5 dark:bg-gray-800 dark:border-gray-700 dark:text-white"/>
                        @error('editTitle') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                        @if($categories)
                        <select wire:model="editCategory" id="category" name="category" class="mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                            <option wire:model="category" value="null" selected disabled>Choose category</option>
                            @if($categories)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                            @error('editCategory') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                        @endif
                        <textarea wire:model="editDescription" placeholder="What's on your mind?" id="description" rows="3" class="block w-full mt-4 bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5 overflow-y-hidden dark:bg-gray-800 dark:border-gray-700 dark:text-white"></textarea>
                        @error('editDescription') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                        </select>
                    </div>
                </form>
                <div class="mt-4">
                    <button class="w-1/6 rounded-full py-2 bg-white text-[#4DD783] border border-[1px] border-[#4DD783] hover:bg-[#4DD783] hover:text-white dark:hover:bg-[#4DD783] dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:border-[#4dd783]" wire:click="closeEditModal()">Cancel</button>
                    <button class="w-1/4 rounded-full py-2 bg-[#4DD783] text-[white] border border-[1px] border-[#4DD783] hover:bg-green-500" wire:click="updatePost()">Update your post</button>
                </div>
            </x-slot>
            <x-slot name="footer"></x-slot>
        </x-dialog-modal>
    @endif

  </div>
</div>