@props([
    'headers' => [],
    'striped' => true,
    'hoverable' => true,
    'compact' => false,
])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'w-full']) }}>
            @if(count($headers) > 0)
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        @foreach($headers as $header)
                            <th class="px-6 {{ $compact ? 'py-2' : 'py-3' }} text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            
            <tbody class="bg-white dark:bg-gray-800 {{ $striped ? 'divide-y divide-gray-200 dark:divide-gray-700' : '' }}">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>