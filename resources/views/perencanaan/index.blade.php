<!-- Filepath: resources/views/perencanaan/index.blade.php -->
@extends('layouts.app')

@section('title', 'Perencanaan Menu')
@section('page-title', 'Perencanaan Menu')

@section('content')
<div x-data="{ activeTab: '{{ $activeTab ?? 'resep' }}' }">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-6">
                <a href="{{ route('operasional.perencanaan.index') }}"
                   :class="{ 'border-blue-500 text-blue-600': activeTab === 'resep', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'resep' }"
                   class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Daftar Resep
                </a>
                <a href="{{ route('operasional.siklus.index') }}"
                   :class="{ 'border-blue-500 text-blue-600': activeTab === 'siklus', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'siklus' }"
                   class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Siklus Menu
                </a>
            </nav>
        </div>

        <div class="mt-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div x-show="activeTab === 'resep'" @if(isset($activeTab) && $activeTab !== 'resep') style="display: none;" @endif>
                {{-- @include('recipes.partials.recipe-list') --}}
            </div>
            <div x-show="activeTab === 'siklus'" @if(!isset($activeTab) || $activeTab !== 'siklus') style="display: none;" @endif>
                @if(isset($menuCycles))
                    @include('siklus.partials.siklus-calendar')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

