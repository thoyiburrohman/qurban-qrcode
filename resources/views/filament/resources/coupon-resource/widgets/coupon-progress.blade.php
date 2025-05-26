<x-filament-widgets::widget>
    <x-filament::card>
        <div class="text-lg font-semibold mb-2">Progress Pengambilan Kupon</div>

        <div class="flex justify-between mb-2">
            <span class="text-sm text-gray-600">Total: {{ $total }}</span>
            <span class="text-sm text-gray-600">Diambil: {{ $taken }} ({{ $percentage }}%)</span>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="h-4 rounded-full transition-all duration-500"
                style="width: {{ $percentage }}%; background-color: 
                @if ($progressColor === 'green') #22c55e 
                @elseif($progressColor === 'yellow') #eab308 
                @else #ef4444 @endif;">
            </div>
        </div>

    </x-filament::card>
</x-filament-widgets::widget>
