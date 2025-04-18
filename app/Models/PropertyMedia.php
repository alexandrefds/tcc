<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyMedia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'property_medias';

    protected $fillable = [
        'title',
        'media_type',
        'file_path',
        'file_type',
        'file_size',
        'property_id'
    ];

    protected $casts = [
        'media_type' => 'string',
        'file_size' => 'integer',
        'deleted_at' => 'datetime'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
