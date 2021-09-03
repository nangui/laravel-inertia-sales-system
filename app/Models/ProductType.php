<?php

namespace App\Models;

use App\Http\Traits\ScopeTrait;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ScopeTrait;

    protected $fillable = ['code', 'description'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
