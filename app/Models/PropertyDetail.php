<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected $table = 'property_details';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type',
        'size',
        'bedrooms',
        'suites',
        'bathrooms',
        'garages',
        'living_rooms',
        'dining_rooms',
        'kitchens',
        'pantry',
        'gardens',
        'pools',
        'barbecue_area',
        'condominium_fee',
        'annual_tax',
        'pet_friendly',
        'newer',
        'construction_year',
        'extra_info',
        'property_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'type' => 'string',
        'size' => 'decimal:2',
        'condominium_fee' => 'decimal:2',
        'annual_tax' => 'decimal:2',
        'barbecue_area' => 'boolean',
        'pet_friendly' => 'boolean',
        'extra_info' => 'array',
        'construction_year' => 'integer',
        'deleted_at' => 'datetime',
        'property_id' => 'string'
    ];

    /**
     * The model's default values for attributes.
     */
    protected $attributes = [
        'barbecue_area' => false,
        'pet_friendly' => false,
    ];

    /**
     * Get the property that owns the details.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
