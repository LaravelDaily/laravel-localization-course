<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('orders.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create order</a>

                    <table class="w-full mt-4">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Order Date</th>
                            <th>Product count</th>
                            <th>Total</th>
                            <th>Completed</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->ordered_at)->isoFormat('dddd, D MMMM YYYY') }}</td>
                                <td>{{ $order->products_count }}</td>
                                <td>{{ $order->completed ? 'Yes' : 'No' }}</td>
                                <td>{{ formatCurrency($order->price) }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}">Show</a>
                                    <a href="{{ route('orders.edit', $order) }}">Edit</a>
                                    <form action="{{ route('orders.destroy', $order) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">Delete</button>
                                    </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
