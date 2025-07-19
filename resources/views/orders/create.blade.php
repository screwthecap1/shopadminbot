@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 flex justify-center">
        <div class="w-full max-w-lg">
            {{-- Форма загрузки ПВЗ --}}
            <form method="GET" action="{{ route('orders.create') }}" class="bg-white p-6 rounded shadow-md mb-6">
                <h1 class="text-2xl font-bold mb-4">Оформление заказа</h1>

                <div class="mb-4">
                    <label for="city" class="block text-gray-700">Город</label>
                    <div class="flex space-x-2">
                        <input type="text" name="city" id="city"
                               class="w-full border rounded px-3 py-2"
                               value="{{ old('city', $selectedCity) }}"
                               placeholder="Например: Самара" required>
                        <button type="submit"
                                class="px-3 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 transition">
                            Загрузить ПВЗ
                        </button>
                    </div>
                </div>
            </form>

            {{-- Основная форма заказа --}}
            <form method="POST" action="{{ route('orders.store') }}" class="bg-white p-6 rounded shadow-md">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="product_id" class="block text-gray-700">Товар</label>
                    <select name="product_id" id="product_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Выберите товар --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} — {{ $product->price }} ₽
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="pvz_code" class="block text-gray-700">Пункт выдачи (ПВЗ)</label>
                    <select name="pvz_code" id="pvz_code" class="w-full border rounded px-3 py-2" required>
                        @if (!empty($pvzList))
                            @foreach ($pvzList as $pvz)
                                <option value="{{ $pvz['code'] }}">
                                    {{ $pvz['code'] }}, {{ $pvz['location']['city'] ?? '' }} — {{ $pvz['location']['address'] ?? '' }}
                                </option>
                            @endforeach
                        @else
                            <option value="">-- Сначала введите город и нажмите "Загрузить ПВЗ" --</option>
                        @endif
                    </select>
                </div>

                <div class="mb-4">
                    <label for="comment" class="block text-gray-700">Комментарий</label>
                    <textarea name="comment" id="comment"
                              class="w-full border rounded px-3 py-2"
                              placeholder="Дополнительная информация...">{{ old('comment') }}</textarea>
                </div>

                <div class="flex justify-center mt-4 space-x-4">
                    <button type="submit"
                            class="px-4 py-2 rounded text-white bg-green-500 hover:bg-green-600 transition">
                        Оформить заказ
                    </button>
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded text-gray-700 bg-gray-200 hover:bg-gray-300 transition">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
