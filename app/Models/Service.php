<?php

namespace App\Models;

use App\Http\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ScopeTrait;

    protected $fillable = ['code', 'description'];

    public function dailyInventories(): BelongsToMany
    {
        return $this->belongsToMany(
            DailyInventory::class,
            'service_daily_inventory',
            'service_id',
            'daily_inventory_id'
        );
    }
}
