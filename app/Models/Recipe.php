<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function items()
    {
        // Relasi Many-to-Many ke Item
        // withPivot digunakan untuk mengambil data dari kolom tambahan di tabel pivot
        return $this->belongsToMany(Item::class)->withPivot('quantity_per_portion');
    }
}
