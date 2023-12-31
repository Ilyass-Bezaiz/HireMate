<x-app-layout>
  {{-- <x-slot name="header">
        
    </x-slot> --}}

  <livewire:home-page.search-section />
  @if (auth()->user()->role == "job_seeker")
  <livewire:home-page.jobseeker-offers />
  @elseif (auth()->user()->role == "employer")
  {{-- employer-offers --}}
  @endif
  <livewire:footer />

  {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                
            </div>
        </div>
    </div> --}}



</x-app-layout>