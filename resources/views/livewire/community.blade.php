<div class="max-w-6xl mx-auto">
    <div class="flex items-align justify-start gap-x-8 w-full mt-[32px]">

        <!--Filters for posts-->
        <form enctype="multipart/form-data" class="sticky top-0 width-[350px] bg-white dark:bg-gray-800 p-7 rounded-md border-[1px] border-[#d9d9d9] h-[320px]">
            @csrf
            <div class="mb-6">
                <label for="categoryFilter" class="block text-[20px] font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by category</label>
                @if($categories)
                    <select wire:model.live="selectedCategoryFilter" id="categoryFilter" name="categoryFilter" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
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
                <label for="Filter by date" class="block text-[20px] font-medium text-gray-700 mb-2 dark:text-gray-300">Filter by date</label>
                <select wire:model.live="selectedDate" id="date" name="date" class="mt-1 block w-[350px] py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    <option value="null" selected disabled>Select your date</option>
                    <option value="24h">Last 24h</option>
                    <option value="week">Last week</option>
                    <option value="month">Last month</option>
                    <option value="3months">Last 3 months</option>
                </select>
            </div>
            <button class="w-full rounded-full py-2 border border-[1px] border-[#4DD783] text-[#4DD783] hover:bg-[#4DD783] hover:text-[white]" type="submit">Filter posts</button>
        </form>

        <!--Create post box-->
        <div class="w-2/3 overflow-y-hidden">
            <div class="w-full bg-white p-7 rounded-md border-[1px] border-[#d9d9d9]">
                <form enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6 width-[800px]">
                        <label for="Filter by category" class="block text-[20px] font-medium text-gray-700 mb-2">Create post</label>
                        <input wire:model="title" placeholder="Title" type="text" id="post-title" name="post-title" class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5" />
                        @error('title') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror

                        @if($categories)
                            <select wire:model.live="selectedCategory" id="category" name="category" class="mt-4 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <option wire:model="category" value="null" selected disabled>Choose category</option>
                            @if($categories)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                            @error('selectedCategory') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                        @endif

                        <textarea wire:model="description" placeholder="What's on your mind?" id="description" rows="3" class="block w-full mt-4 bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5 overflow-y-hidden"></textarea>
                        @error('description') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                    </select>
                    </div>
                </form>
                <button class="w-1/3 rounded-full py-2 bg-[#4DD783] text-[white] border border-[1px] border-[#4DD783] hover:bg-white hover:text-[#4DD783]" wire:click = "createPost">+ Create post</button>
            </div>

            <!--Display posts here-->
            @if(count($posts) > 0)
                @foreach($posts as $post)
                    <div class="my-6 p-6 bg-white h-auto rounded-md border-[1px] border-[#d9d9d9]">
                        <div class="flex items-center justify-between rounded-md w-full">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center">
                                    <div class="img-picture w-[60px] h-[60px] rounded-full overflow-hidden">
                                        <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}" alt="Profil picture" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="ml-2 flex flex-col items-start">
                                    <span class="font-bold">{{$post->user->name}} - <span class="font-light text-[14px] text-[#4DD783]">Business Consultant</span></span> 
                                    <span class="text-[12px] text-[#888]">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <button @click="open = !open" class="bg-gray-200 text-gray-700 font-semibold w-[35px] h-[35px] flex items-center justify-center rounded-full inline-flex items-center hover:bg-gray-300">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="4" viewBox="0 0 16 4" fill="none">
                                            <circle cx="8" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                            <circle cx="2" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                            <circle cx="14" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                </button>
                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-[120px] rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                    <div class="py-1 flex-col items-center justify-center">
                                        @if(auth()->user()->id == $post->user_id)
                                            <button class="w-full font-bold text-[#4DD783] block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit</button>
                                        @else
                                            <button class="w-full font-bold text-[#D43E3E] block px-4 py-2 text-gray-700 hover:bg-gray-100">Report</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-6">
                            <h2 class="font-bold text-[16px] mb-2">{{ $post->title }}</h2>
                            <p class="font-light text-[14px] m-0 break-words">{{ $post->description }}</p>
                        </div>
                        <div class="mt-6 flex flex-row items-center">
                            <livewire:posts.like-button :key="$post->id" :$post/>
                            <div wire:click="showCommentModal({{$post->id}})" class="cursor-pointer ml-2 flex flex-row items-center justify-between p-2 hover:bg-[#f5f5f5] rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                    <path d="M24.1573 7.22215C25 8.48327 25 10.2388 25 13.75C25 17.2612 25 19.0167 24.1573 20.2779C23.7926 20.8238 23.3238 21.2926 22.7779 21.6573C21.6762 22.3935 20.1971 22.4865 17.5 22.4983V22.5L16.118 25.2639C15.6574 26.1852 14.3426 26.1852 13.882 25.2639L12.5 22.5V22.4983C9.80287 22.4865 8.32384 22.3935 7.22215 21.6573C6.6762 21.2926 6.20744 20.8238 5.84265 20.2779C5 19.0167 5 17.2612 5 13.75C5 10.2388 5 8.48327 5.84265 7.22215C6.20744 6.6762 6.6762 6.20744 7.22215 5.84265C8.48327 5 10.2388 5 13.75 5H16.25C19.7612 5 21.5167 5 22.7779 5.84265C23.3238 6.20744 23.7926 6.6762 24.1573 7.22215Z" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.25 11.25L18.75 11.25" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.25 16.25H15" stroke="#888888" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="ml-2 text-[#888] font-bold">Comment</span>
                            </div>
                            <div class="cursor-pointer ml-2 flex flex-row items-center justify-between p-2 hover:bg-[#f5f5f5] rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                    <path d="M25 12.5L25.7071 13.2071L26.4142 12.5L25.7071 11.7929L25 12.5ZM4 22.5C4 23.0523 4.44772 23.5 5 23.5C5.55228 23.5 6 23.0523 6 22.5L4 22.5ZM19.4571 19.4571L25.7071 13.2071L24.2929 11.7929L18.0429 18.0429L19.4571 19.4571ZM25.7071 11.7929L19.4571 5.54289L18.0429 6.95711L24.2929 13.2071L25.7071 11.7929ZM25 11.5L11 11.5L11 13.5L25 13.5L25 11.5ZM4 18.5L4 22.5L6 22.5L6 18.5L4 18.5ZM11 11.5C7.13401 11.5 4 14.634 4 18.5L6 18.5C6 15.7386 8.23858 13.5 11 13.5L11 11.5Z" fill="#888888"/>
                                </svg>
                                <span class="ml-2 text-[#888] font-bold">Share</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else 
                <div class="my-6 p-6 bg-white h-auto rounded-md border-[1px] border-[#d9d9d9]">
                    <div class="p-6 lg:text-2xl md:text-md text-md text-cente">Nothing to show!</div>
                </div>
            @endif
        </div>

        <!--Display Comments-->
        @if($selectedPost)
            <x-dialog-modal wire:model="showModal">
                <x-slot name="title">
                    <h1 class="text-[20px] text-[#3A3838]">{{ $selectedPost->title }}</h1>
                </x-slot>
                <x-slot name="content">
                    <form wire:submit.prevent="" class="relative">
                        @csrf
                        <textarea wire:model="body" placeholder="What would you like to comment?" rows="3" class="relative w-full block mt-4 bg-white border border-gray-300 rounded-md py-2 px-3 text-base focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5 overflow-y-hidden"></textarea>
                        @error('body') <span class="error text-red-600 text-[12px]">{{ $message }}</span> @enderror
                        <div class="mt-4">
                            <button class="w-1/6 rounded-full py-2 bg-white text-[#4DD783] border border-[1px] border-[#4DD783] hover:bg-[#4DD783] hover:text-white" wire:click="closeModal">Cancel</button>
                            <button class="w-1/6 rounded-full py-2 bg-[#4DD783] text-[white] border border-[1px] border-[#4DD783] hover:bg-green-500" wire:click="createComment">Comment</button>
                        </div>
                    </form>
                </x-slot>
                <x-slot name="footer">
                    <div class="flex flex-col w-full blur-dev list-content-container flex-1 md:max-h-[300px] overflow-hidden md:overflow-y-scroll pr-2">
                        @if(count($comments) > 0)
                            @foreach($comments as $comment)
                                <div class="w-full my-3 p-4 bg-white h-auto rounded-md border-[1px] border-[#d9d9d9]">
                                    <div class="flex items-center justify-between rounded-md w-full">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center">
                                                <div class="img-picture w-[40px] h-[40px] rounded-full">
                                                    <img src="" alt="Profil picture" class="w-full h-full">
                                                </div>
                                            </div>
                                            <div class="ml-2 flex flex-col items-start">
                                                <span class="font-bold">{{$comment->user->name}} - <span class="font-light text-[14px] text-[#4DD783]">Business Consultant</span></span> 
                                                <span class="text-[12px] text-[#888]">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open" class="bg-gray-200 text-gray-700 font-semibold w-[30px] h-[30px] flex items-center justify-center rounded-full inline-flex items-center hover:bg-gray-300">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="4" viewBox="0 0 16 4" fill="none">
                                                        <circle cx="8" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                                        <circle cx="2" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                                        <circle cx="14" cy="2" r="1" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </span>
                                            </button>
                                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-[100px] rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                                <div class="py-1 flex-col items-center justify-center">
                                                    @if(auth()->user()->id == $comment->user_id)
                                                        <button class="w-full font-bold text-[#4DD783] block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit</button>
                                                    @else
                                                        <button class="w-full font-bold text-[#D43E3E] block px-4 py-2 text-gray-700 hover:bg-gray-100">Report</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <p class="text-justify font-light text-[14px] m-0 break-words">{{ $comment->body }}</p>
                                    </div>
                                    <div class="mt-3 flex flex-row items-center">
                                        <div class="cursor-pointer flex flex-row items-center justify-between p-2 hover:bg-[#f5f5f5] rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 26 24" fill="none">
                                                <path d="M2.79452 13.3699L12.3219 22.1601C12.6437 22.457 12.8046 22.6054 13 22.6054C13.1954 22.6054 13.3563 22.457 13.6781 22.1601L23.2055 13.3699C25.9108 10.874 26.2379 6.71586 23.9562 3.82755L23.6008 3.37759C20.9037 -0.0365739 15.5651 0.542922 13.6634 4.45627C13.3944 5.00988 12.6056 5.00987 12.3366 4.45627C10.4349 0.542921 5.09629 -0.0365701 2.39921 3.37759L2.04375 3.82756C-0.23792 6.71586 0.0892327 10.874 2.79452 13.3699Z" stroke="#888888"/>
                                            </svg>
                                            <span class="ml-2 text-[#888] font-bold">Like</span>
                                        </div>
                                        <div class="cursor-pointer ml-2 flex flex-row items-center justify-between p-2 hover:bg-[#f5f5f5] rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 30 30" fill="none">
                                                <path d="M25 12.5L25.7071 13.2071L26.4142 12.5L25.7071 11.7929L25 12.5ZM4 22.5C4 23.0523 4.44772 23.5 5 23.5C5.55228 23.5 6 23.0523 6 22.5L4 22.5ZM19.4571 19.4571L25.7071 13.2071L24.2929 11.7929L18.0429 18.0429L19.4571 19.4571ZM25.7071 11.7929L19.4571 5.54289L18.0429 6.95711L24.2929 13.2071L25.7071 11.7929ZM25 11.5L11 11.5L11 13.5L25 13.5L25 11.5ZM4 18.5L4 22.5L6 22.5L6 18.5L4 18.5ZM11 11.5C7.13401 11.5 4 14.634 4 18.5L6 18.5C6 15.7386 8.23858 13.5 11 13.5L11 11.5Z" fill="#888888"/>
                                            </svg>
                                            <span class="ml-2 text-[#888] font-bold">Share</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </x-slot>
            </x-dialog-modal>
        @endif

    </div>
</div>