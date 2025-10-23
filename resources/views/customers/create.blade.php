@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Yeni Müşteri Ekle</h1>
    <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1 font-semibold">Adı</label>
            <input type="text" name="name" class="border p-2 rounded w-full" required>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block mb-1 font-semibold">Telefon</label>
            <input type="text" name="phone" class="border p-2 rounded w-full">
        </div>
        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Kaydet</button>
        <a href="{{ route('customers.index') }}" class="ml-2 text-gray-600">Geri Dön</a>
    </form>
</div>
@endsection 