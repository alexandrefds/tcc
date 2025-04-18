<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'country',
        'state',
        'city',
        'district',
        'street',
        'address_line',
        'reference_point',
        'postal_code',
        'latitude',
        'longitude'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
