<?php

namespace App\Http\Controllers;

use App\Models\MenuCycle;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MenuCycleController extends Controller
{
    /**
     * Menampilkan kalender siklus menu.
     */
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $date = Carbon::createFromDate($year, $month, 1);
        $startDate = $date->copy()->startOfMonth();
        $endDate = $date->copy()->endOfMonth();

        $menuCycles = MenuCycle::whereBetween('menu_date', [$startDate, $endDate])
            ->pluck('recipe_id', 'menu_date')
            ->map(function ($value, $key) {
                return ['recipe_id' => $value, 'date' => Carbon::parse($key)->format('Y-m-d')];
            })->keyBy('date');
            
        $recipes = Recipe::orderBy('name')->get();

        return view('operasional.perencanaan.index', [
            'recipes' => $recipes,
            'menuCycles' => $menuCycles,
            'date' => $date,
            'activeTab' => 'siklus' // Untuk memberitahu view tab mana yang aktif
        ]);
    }

    /**
     * Menyimpan jadwal siklus menu.
     */
    public function save(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
            'menus' => 'nullable|array',
        ]);

        $month = $request->month;
        $year = $request->year;
        $menus = $request->menus ?? [];

        DB::transaction(function () use ($month, $year, $menus) {
            // Hapus data lama untuk bulan dan tahun yang dipilih
            MenuCycle::whereYear('menu_date', $year)
                     ->whereMonth('menu_date', $month)
                     ->delete();

            // Masukkan data baru
            foreach ($menus as $date => $recipeId) {
                if (!empty($recipeId)) {
                    MenuCycle::create([
                        'menu_date' => $date,
                        'recipe_id' => $recipeId,
                    ]);
                }
            }
        });

        return redirect()->route('operasional.siklus.index', ['month' => $month, 'year' => $year])
                         ->with('success', 'Siklus menu berhasil disimpan.');
    }
}
