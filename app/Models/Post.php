<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['title', 'post'];

    protected $fillable = [
        'user_id',
        'publish_date',
        'title',
        'post'
    ];

    protected $casts = [
        'publish_date' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
