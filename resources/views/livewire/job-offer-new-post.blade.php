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
              <tr></tr>
              @if (count($posts) > 0)
              @foreach($posts as $post)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($post->description, 20) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post->flexibility }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  {{ $post->requestedContract }}
                </td>
                <td class="flex gap-4 px-6 py-4 text-right text-sm">
                  <x-button wire:click="showEditPostModal({{ $post->id }})" class="bg-gray-900 hover:bg-gray-600">EDIT
                  </x-button>
                  <x-button wire:click="deletePost({{ $post->id }})" class="bg-red-700 hover:bg-red-600">DELETE
                  </x-button>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="5" class="p-6 lg:text-2xl md:text-md text-md text-center">No posts to show !</td>
              </tr>
              @endif
            </tbody>
          </table>

          @if(count($posts) > 0)
          <div class="m-2 p-2" wire:ignore>{{ $posts->links() }}</div>
          @endif
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
              <label for="title" class="block text-sm font-medium text-gray-700"> Post Title </label>
              <div class="mt-1">
                <input type="text" id="title" wire:model.lazy="title" name="title"
                  class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
              </div>
              @error('title') <span class="error text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="sm:col-span-6 mb-4">
              <label for="expectedSalary" class="block text-sm font-medium text-gray-700"> Expected salary </label>
              <div class="mt-1">
                <input type="text" wire:model.lazy="salary" id="salary" inputmode="numeric" name="expectedSalary"
                  class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
              </div>
              @error('salary') <span class="error text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="bg-gray-100 rounded-md p-2 mb-4">
              <h3 class="w-full flex text-xl mb-2">Location</h3>
              <div class="flex gap-5 flex-col lg:flex-row md:flex-row">
                <div class="col-span-6 mb-4 w-full">
                  <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                  <select wire:model.live="selectedCountry" id="country" name="country" autocomplete="country-name"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                  <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                  <select id="city" wire:model.live="cityId" name="city" autocomplete="city-name"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
              <label for="contractType" class="block text-sm font-medium text-gray-700">Contract type</label>
              <select id="contractType" name="contractType" autocomplete="contractType-name"
                wire:model.live="contractType"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="null" disabled selected>Choose your desired Contract type</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Contract">Contract</option>
                <option value="Freelance">Freelance</option>
              </select>
              @error('contractType') <span class="error text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-6 w-full">
              <label for="flexibility" class="block text-sm font-medium text-gray-700">Flexibility</label>
              <select id="flexibility" wire:model.live="flexibility" name="flexibility" autocomplete="flexibility-name"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="null" disabled selected>Choose your flexibility</option>
                <option value="Remote" selected>Remote</option>
                <option value="On site">On site</option>
                <option value="Hybrid">Hybrid</option>
              </select>
              @error('flexibility') <span class="error text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="sm:col-span-6 pt-5">
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <div class="mt-1">
                <textarea id="description" wire:model.lazy="description" rows="3"
                  class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
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