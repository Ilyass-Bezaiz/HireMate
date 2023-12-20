
<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">
        <x-button wire:click="showJobSeekerPostModal">Create new post</x-button>
    </div>
    <div class="m-2 p-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Id</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Image</th>
                            <th scope="col" class="relative px-6 py-3">Edit</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr></tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">id</td>
                            <td class="px-6 py-4 whitespace-nowrap">title</td>
                            <td class="px-6 py-4 whitespace-nowrap">Active</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200" />
                            </td>
                            <td class="px-6 py-4 text-right text-sm">Edit Delete</td>
                        </tr>
                        <!-- More items... -->
                        </tbody>
                    </table>
                    <div class="m-2 p-2">Pagination</div>
                    </div>
                </div>
        </div>

    </div>
    <div>
        <x-dialog-modal wire:model="showingModal">
            <x-slot name="title">Title</x-slot>
            <x-slot name="content">
            <form enctype="multipart/form-data">
                <div class="sm:col-span-6 mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700"> Post Title </label>
                    <div class="mt-1">
                        <input type="text" id="title" wire:model.lazy="title" name="title" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>
                <div class="sm:col-span-6 mb-4">
                    <label for="expectedSalary" class="block text-sm font-medium text-gray-700"> Expected salary </label>
                    <div class="mt-1">
                        <input type="text" id="expectedSalary" inputmode="numeric" name="expectedSalary" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>
                <div class="bg-gray-100 rounded-md p-2 mb-4">
                    <h3 class="w-full flex text-xl mb-2">Location</h3>
                    <div class="flex gap-5 flex-col lg:flex-row md:flex-row">
                        <div class="col-span-6 mb-4 w-full">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <select wire:model.live="selectedCountry" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                    </select>
                        </div>
                        <div class="col-span-6 w-full">
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <select id="city" name="city" autocomplete="city-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                    </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-span-6 w-full mb-4">
                    <label for="desiredContractType" class="block text-sm font-medium text-gray-700">Contract type</label>
                        <select id="desiredContractType" name="desiredContractType" autocomplete="desiredContractType-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="contract">Contract</option>
                            <option value="freelance">Freelance</option>
                    </select>
                </div>
                <div class="col-span-6 w-full">
                    <label for="flexibility" class="block text-sm font-medium text-gray-700">Flexibility</label>
                        <select id="flexibility" name="flexibility" autocomplete="flexibility-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="remote">Remote</option>
                            <option value="on-site">On-site</option>
                            <option value="hybrid">Hybrid</option>
                    </select>
                </div>
                <div class="sm:col-span-6 pt-5">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="mt-1">
                    <textarea id="description" rows="3" class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                </div>
            </form>
            </x-slot>
            <x-slot name="footer">
                <x-button wire:click="storeJobSeekerPost">Create post</x-button>
                <x-secondary-button>Close</x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>


    
