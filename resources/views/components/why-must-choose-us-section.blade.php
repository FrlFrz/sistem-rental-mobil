@props(['iconPath', 'title', 'description'])

<div class="flex items-start space-x-4">
    {{-- Bagian Ikon --}}
    <div class="p-3 bg-blue-700 rounded-lg text-white flex-shrink-0">
        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            {!! $iconPath !!}
        </svg>
    </div>

    {{-- Bagian Konten --}}
    <div>
        <h3 class="text-lg font-semibold text-gray-900">
            {{ $title }}
        </h3>
        <p class="mt-2 text-gray-600">
            {{ $description }}
        </p>
    </div>
</div>
