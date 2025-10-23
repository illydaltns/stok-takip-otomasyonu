@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Müşteriler</h1>
        <a href="{{ route('customers.create') }}" class="bg-green-700 text-white px-4 py-2 rounded">Yeni Müşteri</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="w-full border mb-6">
        <thead>
            <tr>
                <th>Adı</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Abonelikler</th>
                <th>Abonelik Başlat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        @foreach($customer->subscriptions as $sub)
                            <div class="mb-1">
                                <span class="font-semibold">{{ $sub->type }}</span> |
                                {{ $sub->start_date }} - {{ $sub->end_date ?? 'Süresiz' }} |
                                <span class="{{ $sub->active ? 'text-green-600' : 'text-gray-500' }}">{{ $sub->active ? 'Aktif' : 'Pasif' }}</span>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('customers.addSubscription', $customer->id) }}" method="POST" class="flex flex-col gap-1">
                            @csrf
                            <input type="text" name="type" placeholder="Tip" class="border p-1 rounded" required>
                            <input type="date" name="start_date" class="border p-1 rounded" required>
                            <input type="date" name="end_date" class="border p-1 rounded">
                            <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded">Başlat</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 