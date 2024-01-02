<div class="max-w-6xl mx-auto">
  <div class="flex justify-end m-2 p-2">
    <x-button wire:click="showJobOfferPostModal">Create new post</x-button>
  </div>
  <div class="m-2 p-2">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
              <tr>
                <th scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                  Title</th>
                <th scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                  Description</th>
                <th scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                  Flexibility</th>
                <th scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                  Requested Contract</th>
                <th scope="col" class="relative px-6 py-3">Edit</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @if (count($posts) > 0)
              @foreach($posts as $post)
              <tr class="dark:bg-gray-700 dark:text-white">
                <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($post->description, 20) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post->flexibility }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  {{ $post->requestedContract }}
                </td>
                <td class="flex gap-4 px-6 py-4 text-right text-sm">
                  <x-button wire:click="showEditPostModal({{ $post->id }})" class="bg-gray-900 hover:bg-gray-600">EDIT
                  </x-button>
                  <x-button wire:click="deletePost({{ $post->id }})" class="bg-red-700 hover:bg-red-600"
                    wire:confirm="Are you sure you want to delete this post?">DELETE
                  </x-button>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="5"
                  class="p-6 lg:text-2xl md:text-md text-md text-center dark:bg-gray-800 dark:text-neutral-200">No posts
                  to show !</td>
              </tr>
              @endif
            </tbody>
          </table>
          @if(count($posts) > 0)
          <div class="p-2 dark:bg-gray-200">{{ $posts->links() }}</div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div>
    <x-dialog-modal wire:model="showingModal">

      @if($isEditMode)
      <x-slot name="title">Update Job seeker post</x-slot>
      @else
      <x-slot name="title">Create Job Offer post</x-slot>
      @endif
      <x-slot name="content">
        <form enctype="multipart/form-data">
          <div class="sm:col-span-6 mb-4">
            <x-label for="title">{{ __("Post title") }}</x-label>
            <div class="mt-1">
              <x-input type="text" id="title" wire:model.lazy="title" name="title"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-900" />
            </div>
            @error('title') <span class="error text-red-600">{{ $message }}</span> @enderror
          </div>
          <div class="sm:col-span-6 mb-4">
            <div class="mt-1">
              <x-label for="salary">{{ __("Salary") }}</x-label>
              <x-input type="text" wire:model.lazy="salary" id="salary" inputmode="numeric" name="salary"
                class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            @error('salary') <span class="error text-red-600">{{ $message }}</span> @enderror
          </div>

          <div class="bg-gray-100 rounded-md p-2 mb-4 dark:bg-transparent dark:p-0">
            <h3 class="w-full flex text-xl mb-2 dark:hidden">Location</h3>
            <div class="flex gap-5 flex-col lg:flex-row md:flex-row">
              <div class="col-span-6 mb-4 w-full">
                <x-label for="country">{{ __("Country") }}</x-label>
                <select wire:model.live="selectedCountry" id="country" name="country"
                  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-green-400 sm:text-sm dark:bg-gray-900"
                  autocomplete="country-name">
                  <option value="null" selected disabled>Select your country</option>
                  @if ($countries)
                  @foreach($countries as $country)
                  <option value="{{ $country->id }}">{{ $country->name }}</option>
                  @endforeach
                  @endif
                </select>
                @error('selectedCountry') <span class="error text-red-600">{{ $message }}</span> @enderror
              </div>
              <div class="col-span-6 w-full">
                <x-label for="city">{{ __("City") }}</x-label>
                <select id="city" wire:model.live="cityId" name="city" autocomplete="city-name"
                  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm dark:bg-gray-900">
                  <option value="null" selected disabled>Select city</option>
                  @if ($cities)
                  @foreach($cities as $city)
                  @if ($oldCityId == $city->id)
                  <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                  @else
                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                  @endif
                  @endforeach
                  @endif

                </select>
                @error('cityId') <span class="error text-red-600">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>

          <div class="col-span-6 w-full mb-4">
            <x-label for="contractType">{{ __("Contract type") }}</x-label>
            <select id="contractType" name="contractType" autocomplete="contractType-name"
              wire:model.live="contractType"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm dark:bg-gray-900">
              <option value="null" disabled selected>Choose your desired Contract type</option>
              <option value="Full-time">Full-time</option>
              <option value="Part-time">Part-time</option>
              <option value="Contract">Contract</option>
              <option value="Freelance">Freelance</option>
            </select>
            @error('contractType') <span class="error text-red-600">{{ $message }}</span> @enderror
          </div>
          <div class="col-span-6 w-full">
            <x-label for="flexibility">{{ __("Flexibility") }}</x-label>
            <select id="flexibility" wire:model.live="flexibility" name="flexibility" autocomplete="flexibility-name"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-400 focus:border-green-400 sm:text-sm dark:bg-gray-900">
              <option value="null" disabled selected>Choose your flexibility</option>
              <option value="Remote" selected>Remote</option>
              <option value="On site">On site</option>
              <option value="Hybrid">Hybrid</option>
            </select>
            @error('flexibility') <span class="error text-red-600">{{ $message }}</span> @enderror
          </div>
          <div class="sm:col-span-6 pt-5">
            <x-label for="description">{{ __("Description") }}</x-label>
            <div class="mt-1">
              <textarea id="description" wire:model.lazy="description" rows="3"
                class="shadow-sm focus:ring-green-400 appearance-none bg-white border border-gray-600 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-green-400 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-900"></textarea>
              @error('description') <span class="error text-red-600">{{ $message }}</span> @enderror
            </div>
          </div>
        </form>
      </x-slot>
      <x-slot name="footer">
        @if($isEditMode)
        <x-button wire:click="updateJobOfferPost">Update post</x-button>
        @else
        <x-button wire:click="storeJobOfferPost">Create post</x-button>
        @endif
      </x-slot>
    </x-dialog-modal>
  </div>
</div>