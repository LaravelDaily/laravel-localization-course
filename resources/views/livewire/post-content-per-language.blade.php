<div>
    <div class="w-full mb-4">
        @foreach($languagesList as $locale)
            <button type="button" wire:click="changeLocale('{{ $locale }}')"
                    @class([
                        'bg-blue-500 text-white px-4 py-2 rounded font-medium inline' => $locale == $currentLanguage,
                        'bg-gray-200 text-gray-500 px-4 py-2 rounded font-medium inline' => $locale != $currentLanguage,
                    ])
                            >
                Translations for: {{ $locale }}
            </button>
        @endforeach
    </div>

    @foreach($languagesList as $locale)
        <fieldset @class(['hidden' => $locale != $currentLanguage, 'border-2 w-full p-4 rounded-lg mb-4'])>
            <div class="mb-4">
                <label for="title[{{$locale}}]" class="sr-only">Title</label>
                <input type="text" name="title[{{$locale}}]" id="title[{{$locale}}]"
                       placeholder="Title"
                       class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror"
                       value="{{ old('title.'. $locale, $post?->translations->where('locale', $locale)->first()?->title) }}">
                @error('title.'.$locale)
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="">
                <label for="post[{{$locale}}]" class="sr-only">Body</label>
                <textarea name="post[{{$locale}}]" id="post[{{$locale}}]" cols="30" rows="4"
                          placeholder="Post"
                          class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('post'.$locale) border-red-500 @enderror">{{ old('post'.$locale, $post?->translations->where('locale', $locale)->first()?->post) }}</textarea>
                @error('post.'.$locale)
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </fieldset>
    @endforeach
</div>