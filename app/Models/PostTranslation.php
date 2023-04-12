<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostTranslation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'post_id',
        'locale',
        'title',
        'post',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
