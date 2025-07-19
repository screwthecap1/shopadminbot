@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Детали заказа</h1>

        <div class="bg-white rounded shadow p-4 space-y-2">
            <p><strong>Товар:</strong> {{ $order->product->name ?? 'N/A' }}</p>
            <p><strong>ПВЗ:</strong> {{ $order->pvz_code }}</p>
            <p><strong>Комментарий:</strong> {{ $order->comment }}</p>
            <p><strong>Статус:</strong> {{ $order->status }}</p>
            <p><strong>Создан:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
        </div>

        <a href="{{ route('orders.index') }}"
           class="inline-block mt-4 text-blue-600 hover:underline">
            ← Вернуться к списку заказов
        </a>
    </div>
@endsection
