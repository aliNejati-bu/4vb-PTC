<?php

namespace PTC\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Click extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "clicker_ip",
        "slug_id",
        "link_id",
        "refer"
    ];

    /**
     * @return BelongsTo
     */
    public function slug(): BelongsTo
    {
        return $this->belongsTo(Slug::class);
    }

    /**
     * @return BelongsTo
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }

}