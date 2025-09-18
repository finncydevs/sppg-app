<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    /**
     * Menampilkan halaman utama Perencanaan Menu dengan daftar resep.
     */
    public function index()
    {
        $recipes = Recipe::withCount('items')->orderBy('name')->get();
        return view('perencanaan.index', compact('recipes'));
    }

    /**
     * Menampilkan form untuk membuat resep baru.
     */
    public function create()
    {
        $items = Item::orderBy('name')->get();
        return view('recipes.create', compact('items'));
    }

    /**
     * Menyimpan resep baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001',
        ]);

        DB::transaction(function () use ($request) {
            $recipe = Recipe::create(['name' => $request->name]);

            $ingredients = [];
            foreach ($request->items as $ingredient) {
                $ingredients[$ingredient['item_id']] = ['quantity_per_portion' => $ingredient['quantity']];
            }
            $recipe->items()->sync($ingredients);
        });

        return redirect()->route('operasional.perencanaan.index')->with('success', 'Resep berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit resep.
     */
    public function edit(Recipe $recipe)
    {
        $items = Item::orderBy('name')->get();
        $recipe->load('items'); // Memuat relasi item
        return view('recipes.edit', compact('recipe', 'items'));
    }

    /**
     * Memperbarui resep di database.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:0.001',
        ]);

        DB::transaction(function () use ($request, $recipe) {
            $recipe->update(['name' => $request->name]);
            
            $ingredients = [];
            foreach ($request->items as $ingredient) {
                $ingredients[$ingredient['item_id']] = ['quantity_per_portion' => $ingredient['quantity']];
            }
            $recipe->items()->sync($ingredients);
        });
        
        return redirect()->route('operasional.perencanaan.index')->with('success', 'Resep berhasil diperbarui.');
    }

    /**
     * Menghapus resep dari database.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('operasional.perencanaan.index')->with('success', 'Resep berhasil dihapus.');
    }
}
