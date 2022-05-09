<?php

namespace PTC\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        "target_link",
        "slug_id"
    ];

    /**
     * @return BelongsTo
     */
    public function slug(): BelongsTo
    {
        return $this->belongsTo(Slug::class);
    }
}