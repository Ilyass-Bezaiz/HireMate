@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
  <div class="px-6 py-2">
    <div class="mt-5 flex items-center justify-center text-2xl font-medium text-gray-900 dark:text-gray-100">
      {{ $title }}
    </div>
    <div class="flex items-center justify-center flex-col mt-6">
      {{ $content }}
    </div>
  </div>
</x-modal>