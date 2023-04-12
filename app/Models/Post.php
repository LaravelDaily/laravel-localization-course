<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'publish_date',
        'user_id',
    ];

    protected $casts = [
        'publish_date' => 'datetime',
    ];

    protected $with = [
        'defaultTranslation' // Preloading current locale translation at all times
    ];

    public function title(): Attribute
    {
        return new Attribute(
            get: fn() => $this->defaultTranslation->title, // <-- Always making sure that we have current locale title
        );
    }

    public function post(): Attribute
    {
        return new Attribute(
            get: fn() => $this->defaultTranslation->post, // <-- Always making sure that we have current locale post content
        );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(PostTranslation::class);
    }

    public function defaultTranslation(): HasOne
    {
        return $this->translations()->one()->where('locale', app()->getLocale()); // <-- Making sure that we always retrieve current locale information
    }
}
