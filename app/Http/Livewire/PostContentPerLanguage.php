<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostContentPerLanguage extends Component
{
    public ?Post $post;
    public string $currentLanguage;
    public array $languagesList;

    public function mount(): void
    {
        $this->currentLanguage = app()->getLocale();
        $this->languagesList = config('app.supportedLocales', []);
    }

    public function render()
    {
        return view('livewire.post-content-per-language');
    }

    public function changeLocale($locale): void
    {
        if (in_array($locale, $this->languagesList)) {
            $this->currentLanguage = $locale;
        }
    }
}
