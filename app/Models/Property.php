<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'size',
        'for_sale',
        'for_rent',
        'sale_price',
        'rent_price',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'for_sale' => 'boolean',
        'for_rent' => 'boolean',
        'is_active' => 'boolean',
        'sale_price' => 'float',
        'rent_price' => 'float'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
