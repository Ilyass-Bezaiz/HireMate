<div class="max-w-6xl mx-auto">
    <div class="flex items-align justify-start gap-x-8 w-full mt-[32px]">
        @csrf
        <form method="post" action="" class="width-[350px] bg-white dark:bg-gray-800 p-7 rounded-md border-[1px] border-[#d9d9d9] h-[320px]">
            <div class="mb-6">
                <label for="categoryFilter" class="block text-[20px] font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by category</label>
                @if($categories)
                    <select wire:model.live="selectedCategory" id="categoryFilter" name="categoryFilter" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
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

        <div class="w-2/3 bg-white p-7 rounded-md border-[1px] border-[#d9d9d9]">
            @csrf
            <form action="" method="post" class="">
                <div class="mb-6 width-[800px]">
                    <label for="Filter by category" class="block text-[20px] font-medium text-gray-700 mb-2">Create post</label>
                    <input placeholder="Title" type="text" id="post-title" wire:model.lazy="post-title" name="post-title" class="block w-full mb-4 transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5" />

                    @if($categories)
                        <select wire:model.live="selectedCategory" id="category" name="category" class="mt-1 block w-full py-2 px-3 mb-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        <option value="null" selected disabled>Select your date</option>
                        @if($categories)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    @endif

                    <textarea placeholder="What's on your mind?" id="description" wire:model.lazy="description" rows="3" class="block w-full mb-4 transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm sm:leading-5"></textarea>
                </select>
                </div>
                <button class="w-1/3 rounded-full py-2 bg-[#4DD783] text-[white] border border-[1px] border-[#4DD783] hover:bg-white hover:text-[#4DD783]" type="submit">+ Create post</button>
            </form>
        </div>

    </div>
</div>
