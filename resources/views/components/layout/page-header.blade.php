@props([
    'title' => '',
    'description' => null,
    'breadcrumbs' => [],
])

<div class="mb-8">
    @if(count($breadcrumbs) > 0)
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                @foreach($breadcrumbs as $index => $breadcrumb)
                    <li class="inline-flex items-center">
                        @if($index > 0)
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                        
                        @if(isset($breadcrumb['url']) && $index < count($breadcrumbs) - 1)
                            <a href="{{ $breadcrumb['url'] }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                @if(isset($breadcrumb['icon']))
                                    <x-icon :name="$breadcrumb['icon']" class="w-4 h-4 mr-2" />
                                @endif
                                {{ $breadcrumb['label'] }}
                            </a>
                        @else
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                @if(isset($breadcrumb['icon']))
                                    <x-icon :name="$breadcrumb['icon']" class="w-4 h-4 mr-2" />
                                @endif
                                {{ $breadcrumb['label'] }}
                            </span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
            @if($description)
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $description }}</p>
            @endif
        </div>
        
        @if(isset($actions))
            <div class="mt-4 sm:mt-0 sm:ml-4">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>