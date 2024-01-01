@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
  <div class="px-6 py-4">
    <div class="mt-8 flex items-center justify-center text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ $title }}
    </div>
    <div class="flex items-center justify-center flex-col mt-6 text-green-400 dark:text-green-400">
      {{ $content }}
    </div>
    <div class="flex items-center justify-center mt-6">
      {{$footer}}
    </div>
  </div>
</x-modal>