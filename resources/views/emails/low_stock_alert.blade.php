@component('mail::message')
# Stok Uyarısı

<strong>{{ $product->name }}</strong> ürününün stoğu kritik seviyeye düştü.

- Stok Miktarı: **{{ $product->stock_quantity }}**
- Uyarı Seviyesi: {{ $product->stock_alert_level }}

Lütfen stok takibini yapın.

@endcomponent
