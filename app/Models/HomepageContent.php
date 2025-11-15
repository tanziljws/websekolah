<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'content',
        'icon',
        'meta',
        'order',
        'is_active'
    ];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * Get content by type
     */
    public static function getByType($type, $activeOnly = true)
    {
        $query = static::where('type', $type)->orderBy('order');
        
        if ($activeOnly) {
            $query->where('is_active', true);
        }
        
        return $query->get();
    }

    /**
     * Get single content by type
     */
    public static function getSingleByType($type)
    {
        return static::where('type', $type)
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
    }
}
