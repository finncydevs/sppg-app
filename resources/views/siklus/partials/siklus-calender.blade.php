<!-- Filepath: resources/views/siklus/partials/siklus-calendar.blade.php -->
@php
    $startDate = $date->copy()->startOfMonth()->startOfWeek(\Carbon\Carbon::SUNDAY);
    $endDate = $date->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SATURDAY);
@endphp
<form action="{{ route('siklus.save') }}" method="POST">
    @csrf
    <input type="hidden" name="month" value="{{ $date->month }}">
    <input type="hidden" name="year" value="{{ $date->year }}">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('operasional.siklus.index', ['month' => $date->copy()->subMonth()->month, 'year' => $date->copy()->subMonth()->year]) }}" class="p-2 rounded-full hover:bg-gray-200">
                 <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <h3 class="text-xl font-semibold w-48 text-center">{{ $date->format('F Y') }}</h3>
            <a href="{{ route('operasional.siklus.index', ['month' => $date->copy()->addMonth()->month, 'year' => $date->copy()->addMonth()->year]) }}" class="p-2 rounded-full hover:bg-gray-200">
                <svg class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold text-sm mt-4 md:mt-0">Simpan Jadwal</button>
    </div>

    <div class="grid grid-cols-7 gap-px mt-4 bg-gray-200 border border-gray-200 rounded-lg overflow-hidden">
        <div class="text-center font-semibold text-sm py-2 bg-gray-50 text-gray-600">Min</div>
        <div class="text-center font-semibold text-sm py-2 bg-gray-50 text-gray-600">Sen</div>
        <div class="text-center font-semibold text-sm py-2 bg-gray-50 text-gray-600">Sel</div>
        <div class="text-center font-semibold text-sm py-2 bg-gray-50 text-gray-600">Rab</div>
        <div class="text-center font-semibold text-sm py-2 bg-gray-50 text-gray-600">Kam</div>
        <div class="text-center font-semibold text-sm py-2 bg-gray-50 text-gray-600">Jum</div>
        <div class="text-center font-semibold text-sm py-2 bg-gray-50 text-gray-600">Sab</div>
    </div>
    <div class="grid grid-cols-7 gap-px bg-gray-200 border-l border-r border-b border-gray-200 rounded-b-lg">
        @while ($startDate->lte($endDate))
            <div class="h-36 p-2 flex flex-col justify-between
                        {{ $startDate->month != $date->month ? 'bg-gray-50' : 'bg-white' }}
                        border-t border-l border-gray-200">
                @if ($startDate->month == $date->month)
                    <div class="font-semibold text-sm text-gray-700 text-right">{{ $startDate->day }}</div>
                    <div class="mt-1">
                        @php
                            $currentDateStr = $startDate->format('Y-m-d');
                            $selectedRecipeId = $menuCycles[$currentDateStr]['recipe_id'] ?? null;
                        @endphp
                        <select name="menus[{{ $currentDateStr }}]" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                            <option value="">-- Pilih Menu --</option>
                            @foreach ($recipes as $recipe)
                                <option value="{{ $recipe->id }}" @if($recipe->id == $selectedRecipeId) selected @endif>{{ $recipe->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            @php $startDate->addDay(); @endphp
        @endwhile
    </div>
</form>

