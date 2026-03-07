<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TouristProvider extends Model
{
    protected $fillable = [
        'num_rtn',
        'rif',
        'razon_social',
        'direccion',
        'telefono',
        'email',
        'category_id',
        'municipality_id',
        'status',
        'valid_until',
        'capacity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
