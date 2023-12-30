<x-action-section>
    <x-slot name="title">
        {{ __('Update Candidate information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and update you profile information') }}
    </x-slot>
    <x-slot name="content">
                @if(session('success'))
                    <span class="text-gray-600" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition.duration.500ms>{{ Session::get('success'); }}</span>
                @endif

                <form wire:submit.prevent="save">
                    @csrf
                    <div class="mt-4">
                        <x-label for="age">Age</x-label>
                        <x-input type="text" class="block w-full mt-1 lg:w-2/3"
                                    autocomplete="age"
                                    placeholder="{{ __('Age') }}"
                                    wire:model="age"
                                    id="age"
                                    />
                        <x-input-error for="age" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label for="gender">Gender</x-label>
                        <select name="gender" id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-400 rounded-md shadow-sm block w-full mt-1 lg:w-2/3" wire:model="gender">
                            <option value="null" selected disabled>Choose your gender</option>
                            @if ($gender == "Male")
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                            @else
                                <option value="Male">Male</option>
                                <option value="Female"selected>Female</option>
                            @endif
                        </select>
                        <x-input-error for="gender" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-label
                            for="resume"
                            class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">Resume
                        </x-label>
                        <x-input
                            class="relative m-0 block w-2/3 lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-600 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                            type="file"
                            id="resume" 
                            wire:model="resume"
                        />
                        <x-input-error for="resume" class="mt-2" />
                        @if($resumeUrl)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ Storage::url($resumeUrl) }}" target="_blank" class="flex items-center h-6 px-4 font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md hover:bg-gray-800 hover:text-white w-fit">View resume</a>
                                <button wire:click="removeCV" class="flex items-center h-6 px-4 font-semibold text-sm text-red-600 duration-200 border-2 border-red-500 bg-transparent rounded-md hover:bg-red-500 hover:text-white">Remove resume</button>   
                            </div>         
                        @endif
                        
                    </div>
                    <div class="mt-4">
                        <x-label
                            for="coverPicture"
                        >
                        Cover picture
                        </x-label>
                        <x-input
                            accept="image/png, image/jpeg"
                            class="relative m-0 block lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-600 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                            type="file"
                            id="coverPicture"
                            wire:model='coverPicture'
                        />
                        <x-input-error for="coverPicture" class="mt-2" />
                        @if($coverPictureUrl)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ Storage::url($coverPictureUrl) }}" target="_blank" class="flex items-center h-6 px-4 font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md hover:bg-gray-800 hover:text-white w-fit">View cover picture</a>
                                <button wire:click="removeCoverPicture" class="flex items-center h-6 px-4 font-semibold text-sm text-red-600 duration-200 border-2 border-red-500 bg-transparent rounded-md hover:bg-red-500 hover:text-white">Remove cover picutre</button>   
                            </div>         
                        @endif
                    </div>
                    <div class="mt-4">
                        <x-label for="coverLetter">
                            {{ __('Cover Letter') }}
                        </x-label>
                       <x-input 
                                class="
                                    relative m-0 block lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-600 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary
                                    "
                                type="file"
                                id="coverLetter"
                                wire:model="coverLetter"
                       /> 
                       <x-input-error for="coverLetter" class="mt-2" />
                       @if($coverLetterUrl)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ Storage::url($coverLetterUrl) }}" target="_blank" class="flex items-center h-6 px-4 font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md hover:bg-gray-800 hover:text-white w-fit">View cover letter</a>
                                <button wire:click="removeCoverLetter" class="flex items-center h-6 px-4 font-semibold text-sm text-red-600 duration-200 border-2 border-red-500 bg-transparent rounded-md hover:bg-red-500 hover:text-white">Remove cover letter</button>   
                            </div>         
                        @endif
                    </div>
                        <div class="mt-4" wire:ignore>
                            <x-label for="skills">
                                {{ __('Skills') }}
                            </x-label>
                            <select id="skills" wire:model="skills" class="lg:w-2/3 w-full dark:bg-gray-900" multiple>
                                @if (count($skillsList) > 0)
                                    @foreach ($skillsList as $skill)
                                        <option value="{{ $skill->title }}">{{ $skill->title }}</option>
                                    @endforeach                                
                                @endif
                            </select>
                            <button wire:click.prevent="showAddSkillModal" class="block underline font-semibold text-green-400">Add skill</button>
                            @script
                                <script>
                                    $(document).ready(function() {
                                        $('#skills').select2().on('change',function(){
                                            @this.set('skills', $(this).val());
                                        });
                                    });
                                    </script>
                            @endscript
                            <div class="flex justify-end">
                                <x-button type="submit" class="mt-4">Save changes</x-button>
                            </div>
                        </div>
                    </form>
                        <!-- Add skill modal -->
                        <x-dialog-modal wire:model="showingAddSkillModal">

                            <x-slot name="title">Add new skill</x-slot>
                    
                            <x-slot name="content">
                                <form wire:submit.prevent="addSkill">
                                    <x-input 
                                        type="text"
                                        class="block w-full"
                                        placeholder="What's your skill ?"
                                        wire:model="title"
                                        id="title"
                                    />
                                    @error('title')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </form>
                            </x-slot>
                            <x-slot name="footer">
                                <x-button wire:click.prevent="addSkill">Add skill</x-button>
                            </x-slot>
                        </x-dialog-modal>
                
    </x-slot>
    
</x-action-section>