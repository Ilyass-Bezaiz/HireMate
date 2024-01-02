<x-action-section>
    <x-slot name="title">
        {{ __('Update Candidate information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and update you profile information') }}
    </x-slot>
    <x-slot name="content">
                @if(session('success'))
                    <span class="text-gray-600 dark:text-green-500" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition.duration.500ms>{{ Session::get('success'); }}</span>
                @endif
                @if(session('error'))
                    <span class="text-red-600" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition.duration.500ms>{{ Session::get('error'); }}</span>
                @endif
                <form wire:submit.prevent="save">
                    @csrf
                    <div class="mt-4">
                        <x-label
                        for="headline"
                        class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("Headline") }}
                        </x-label> 
                        <x-input type="text" id="headline" wire:model.lazy="headline" name="headline"
                        class="block lg:w-2/3 w-full"
                        placeholder="Headline"
                        />
                        <x-input-error for="headline" class="mt-2" />
                    </div>

                    <div class="mt-4" wire:ignore>
                        <x-label
                        for="about"
                        class="block mb-2 text-neutral-700 dark:text-neutral-200">{{ __("About") }}
                        </x-label>
                        <div class="lg:w-2/3 w-full">
                            <textarea id="about" wire:model="about">{!! $about !!}</textarea>
                        </div> 
                    </div>
                    @script
                        <script>
                            ClassicEditor
                            .create(document.querySelector('#about'),{
                                    toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ],
                                    })
                                    .then(editor => {
                                    $wire.on('refreshEditor', (event) => {
                                        editor.setData(event.description);
                                    });
                                    $wire.on('resetEditor',(event)=>{
                                        editor.setData('');
                                    });
                                    editor.model.document.on('change:data', () => {
                                        @this.set('about', editor.getData());
                                    })
                                    })
                                    .catch(error => {
                                    console.error(error);
                                    });  
                            </script>
                        @endscript
                    <x-input-error for="about" class="mt-2" />

                    <div class="mt-4">
                        <x-label
                            for="resume"
                            class="inline-block mb-2 text-neutral-700 dark:text-neutral-200">Resume
                        </x-label>
                        <x-input
                            class="relative m-0 block w-2/3 lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 dark:hover:file:bg-neutral-600 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                            type="file"
                            id="resume" 
                            wire:model="resume"
                        />
                        <x-input-error for="resume" class="mt-2" />
                        @if($resumeUrl)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ Storage::url($resumeUrl) }}" target="_blank" class="flex items-center h-6 px-4 font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md hover:bg-gray-800 hover:text-white w-fit dark:border-neutral-200 dark:hover:bg-neutral-200 dark:text-neutral-200 dark:hover:text-gray-800">View resume</a>
                                <button wire:click="removeCV" wire:confirm="{{ __("Are you sure you want to delete your resume") }}" class="flex items-center h-6 px-4 font-semibold text-sm text-red-600 duration-200 border-2 border-red-500 bg-transparent rounded-md hover:bg-red-500 hover:text-white">Remove resume</button>   
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
                            class="relative m-0 block lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 dark:hover:file:bg-neutral-600 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                            type="file"
                            id="coverPicture"
                            wire:model='coverPicture'
                        />
                        <x-input-error for="coverPicture" class="mt-2" />
                        @if($coverPictureUrl)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ Storage::url($coverPictureUrl) }}" target="_blank" class="fflex items-center h-6 px-4 font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md hover:bg-gray-800 hover:text-white w-fit dark:border-neutral-200 dark:hover:bg-neutral-200 dark:text-neutral-200 dark:hover:text-gray-800">View cover picture</a>
                                <button wire:click="removeCoverPicture" wire:confirm="{{ __("Are you sure you want to delete your cover picutre ?") }}" class="flex items-center h-6 px-4 font-semibold text-sm text-red-600 duration-200 border-2 border-red-500 bg-transparent rounded-md hover:bg-red-500 hover:text-white">Remove cover picutre</button>   
                            </div>         
                        @endif
                    </div>
                    <div class="mt-4">
                        <x-label for="coverLetter">
                            {{ __('Cover Letter') }}
                        </x-label>
                       <x-input 
                                class="
                                    relative m-0 block lg:w-2/3 w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 dark:hover:file:bg-neutral-600 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary
                                    "
                                type="file"
                                id="coverLetter"
                                wire:model="coverLetter"
                       /> 
                       <x-input-error for="coverLetter" class="mt-2" />
                       @if($coverLetterUrl)
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ Storage::url($coverLetterUrl) }}" target="_blank" class="flex items-center h-6 px-4 font-semibold text-sm border-2 border-gray-800 text-gray-800 duration-200 bg-transparent rounded-md hover:bg-gray-800 hover:text-white w-fit dark:border-neutral-200 dark:hover:bg-neutral-200 dark:text-neutral-200 dark:hover:text-gray-800">View cover letter</a>
                                <button wire:click="removeCoverLetter" wire:confirm="{{ __("Are you sure you want to delete your cover letter") }}" class="flex items-center h-6 px-4 font-semibold text-sm text-red-600 duration-200 border-2 border-red-500 bg-transparent rounded-md hover:bg-red-500 hover:text-white">Remove cover letter</button>   
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
                            <x-input-error for="skills" class="mt-2" />
                            @script
                                <script>
                                    $(document).ready(function() {
                                        $('#skills').select2({
                                            tags:true
                                        }).on('change',function(){
                                            @this.set('skills', $(this).val());
                                        });
                                    });
                                    </script>
                            @endscript
                            
                        </div>
                        <div class="flex justify-end">
                            <x-button type="submit" class="mt-4">Save changes</x-button>
                        </div>
                    </form>          
    </x-slot>
    
</x-action-section>