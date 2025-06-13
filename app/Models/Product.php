<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'image_url',
        'is_active',
    ];

    // Accesor para obtener la imagen final
    public function getImageAttribute()
    {
        return $this->image_url ?? ($this->image_path ? asset('storage/' . $this->image_path) : null);
    }
}




