<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function scopeOrderByCode($query)
    {
        $query->orderBy('label');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('label', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    protected $fillable = ['label', 'description', 'product_ype_id'];

    public function types(): HasMany
    {
        return $this->hasMany('App\Models\ProductType');
    }

    public function children(): HasMany
    {
        return $this->hasMany('App\Models\ProductType')->with('types');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
