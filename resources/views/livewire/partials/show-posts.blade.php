<div class="max-w-6xl mx-auto">
  @if($showApplicants)
  <div class="dark:bg-gray-900">
    <x-applicants-modal maxWidth="3xl">
      <x-slot name="title">All Applicants for you post</x-slot>
      <x-slot name="content">
        @if(count($UserApplicants)>0)
        <div class="w-full p-4 flex items-center justify-between flex-col">
          @foreach($UserApplicants as $UserApplicant)
          <div class="mb-4 flex justify-between items-center w-full ">
            <div class="w-1/7 flex items-center justify-start p-1">
              <img class="rounded-full w-10 h-10 shadow-xl" src="storage/{{$UserApplicant['path']}}">
            </div>
            <a href="{{ route('user.profile', ['userId' => $UserApplicant['id']]) }}">
              {{$UserApplicant['name']}}</a>
            <div>
              @if($UserApplicant['status']=='pending')
              <x-button wire:click="RejectUser({{$UserApplicant['id']}})"
                class="bg-red-400 hover:bg-red-600 dark:bg-red-500 dark:text-white dark:hover:bg-red-600 dark:hover:focus:bg-red-600 dark:focus:bg-red-500 dark:hover:text-slate-50 dark:focus:ring-red-600 mr-3">
                Reject Applicant</x-button>
              <x-button wire:click="AcceptUser({{$UserApplicant['id']}})"
                class="bg-green-400 hover:bg-green-600 dark:bg-green-500 dark:text-white dark:hover:bg-green-600 dark:hover:focus:bg-green-600 dark:focus:bg-green-500 dark:hover:text-slate-50 dark:focus:ring-green-600 mr-3">
                Accept Applicant</x-button>
              @elseif($UserApplicant['status']=='Rejected')
              <x-button wire:click="RejectUser({{$UserApplicant['id']}})"
                class="bg-red-400 hover:bg-red-600 dark:bg-red-500 dark:text-white dark:hover:bg-red-600 dark:hover:focus:bg-red-600 dark:focus:bg-red-500 dark:hover:text-slate-50 dark:focus:ring-red-600 mr-3">
                Reject Applicant</x-button>
              <x-button disabled wire:click="AcceptUser({{$UserApplicant['id']}})"
                class=" disabled:opacity-60 bg-green-400 hover:bg-green-600 dark:bg-green-500 dark:text-white dark:hover:bg-green-600 dark:hover:focus:bg-green-600 dark:focus:bg-green-500 dark:hover:text-slate-50 dark:focus:ring-green-600 mr-3">
                Accept Applicant</x-button>
              @elseif($UserApplicant['status']=='Accepted')
              <x-button disabled wire:click="RejectUser({{$UserApplicant['id']}})"
                class="disabled:opacity-60 bg-red-400 hover:bg-red-600 dark:bg-red-500 dark:text-white dark:hover:bg-red-600 dark:hover:focus:bg-red-600 dark:focus:bg-red-500 dark:hover:text-slate-50 dark:focus:ring-red-600 mr-3">
                Reject Applicant</x-button>
              <x-button wire:click="AcceptUser({{$UserApplicant['id']}})"
                class="bg-green-400 hover:bg-green-600 dark:bg-green-500 dark:text-white dark:hover:bg-green-600 dark:hover:focus:bg-green-600 dark:focus:bg-green-500 dark:hover:text-slate-50 dark:focus:ring-green-600 mr-3">
                Accept Applicant</x-button>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="p-6 lg:text-xl md:text-md text-md text-center dark:bg-gray-800 dark:text-green-400">
          You don't have any applicant yet. Please wait until someone apply to your post offer
        </div>
        @endif
      </x-slot>
    </x-applicants-modal>
  </div>
  @endif
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
                  Required Experience</th>
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
                <td class="px-6 py-4 whitespace-nowrap">{!! Str::limit($post->description, 20) !!}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post->flexibility }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post->required_experience }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  {{ $post->requestedContract }}
                </td>
                <td class="flex gap-4 px-6 py-4 text-right text-sm">
                  <x-button wire:click="showApplicant({{ $post->id }})" class="bg-gray-900 hover:bg-gray-600">
                    Show Applicant</x-button>
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
        </div>
      </div>
    </div>
  </div>
</div>