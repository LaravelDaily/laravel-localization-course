<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create new Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('orders.store') }}">

                        @csrf

                        <div class="mt-4">
                            <x-input-label for="user_id" :value="__('User')"/>

                            <select name="user_id" id="user_id">
                                @foreach($users as $userID => $name)
                                    <option value="{{$userID}}" @selected(old('user_id') == $userID)>{{ $name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="ordered_at" :value="__('Ordered at')"/>

                            <x-text-input id="ordered_at" class="block mt-1 w-full" type="date" name="ordered_at"
                                          :value="old('ordered_at')"/>

                            <x-input-error :messages="$errors->get('ordered_at')" class="mt-2"/>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="completed" :value="__('Completed?')"/>

                            <input type="checkbox" name="completed" id="completed" @checked(old('completed'))>

                            <x-input-error :messages="$errors->get('completed')" class="mt-2"/>
                        </div>
                        @for($i = 0; $i <= 10; $i++)
                            <div class="mt-4 flex w-full space-x-4">
                                <div class="flex-1 justify-center align-middle">
                                    Product: {{ $i }}
                                </div>
                                <div class="flex-auto">
                                    <x-input-label for="products[{{ $i }}][name]" :value="__('Product')"/>

                                    <x-text-input id="products[{{ $i }}][name]" class="block mt-1 w-full" type="text"
                                                  name="products[{{ $i }}][name]"
                                                  :value="old('products.'.$i.'.name')"/>

                                    <x-input-error :messages="$errors->get('products.'.$i.'.name')" class="mt-2"/>
                                </div>

                                <div class="flex-auto">
                                    <x-input-label for="products[{{ $i }}][quantity]" :value="__('Quantity')"/>

                                    <x-text-input id="products[{{ $i }}][quantity]" class="block mt-1 w-full" type="text"
                                                  name="products[{{ $i }}][quantity]"
                                                  :value="old('products.'.$i.'.quantity')"/>

                                    <x-input-error :messages="$errors->get('products.'.$i.'.quantity')" class="mt-2"/>
                                </div>
                            </div>
                        @endfor

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
