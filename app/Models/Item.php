<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'unit', 'price'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)->withPivot('quantity_per_portion');
    }
}
