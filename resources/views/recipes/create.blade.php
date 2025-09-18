<!-- Filepath: resources/views/recipes/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Resep Baru')
@section('page-title', 'Tambah Resep Baru')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
    <form action="{{ route('recipes.store') }}" method="POST" id="recipeForm">
        @csrf
        <div class="mb-4">
            <label for="name" class="block mb-2 text-sm font-medium">Nama Resep</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <h4 class="text-lg font-semibold border-t pt-4 mt-6">Bahan-bahan (per porsi)</h4>
        <div id="ingredients-container" class="space-y-3 mt-4">
            <!-- Ingredient rows will be added here by JavaScript -->
        </div>
        @error('items') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

        <button type="button" id="add-ingredient-btn" class="mt-4 text-blue-600 hover:text-blue-800 font-semibold text-sm flex items-center">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Tambah Bahan
        </button>

        <div class="flex items-center justify-end mt-8 border-t pt-4">
            <a href="{{ route('operasional.perencanaan.index') }}" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 mr-3">Batal</a>
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Resep</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('ingredients-container');
    const addButton = document.getElementById('add-ingredient-btn');
    let ingredientIndex = 0;

    const items = @json($items->map(fn($item) => ['id' => $item->id, 'name' => $item->name, 'unit' => $item->unit]));

    function addIngredientRow() {
        const div = document.createElement('div');
        div.className = 'ingredient-row grid grid-cols-12 gap-4 items-center';
        
        let optionsHtml = items.map(item => `<option value="${item.id}" data-unit="${item.unit}">${item.name}</option>`).join('');

        div.innerHTML = `
            <div class="col-span-6">
                <select name="items[${ingredientIndex}][item_id]" class="item-select bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    <option value="">-- Pilih Bahan --</option>
                    ${optionsHtml}
                </select>
            </div>
            <div class="col-span-3">
                <input type="number" name="items[${ingredientIndex}][quantity]" min="0.001" step="0.001" placeholder="e.g., 0.15" class="quantity-input bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
            </div>
            <div class="col-span-2">
                <span class="unit-text text-sm text-gray-600"></span>
            </div>
            <div class="col-span-1 flex justify-end">
                <button type="button" class="remove-btn text-red-500 hover:text-red-700 font-medium">&times;</button>
            </div>
        `;
        container.appendChild(div);

        div.querySelector('.item-select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            div.querySelector('.unit-text').textContent = selectedOption.dataset.unit || '';
        });

        div.querySelector('.remove-btn').addEventListener('click', function() {
            div.remove();
        });

        ingredientIndex++;
    }

    addButton.addEventListener('click', addIngredientRow);
    addIngredientRow();
});
</script>
@endsection

