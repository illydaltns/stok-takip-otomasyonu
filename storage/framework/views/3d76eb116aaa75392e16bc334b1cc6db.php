

<?php $__env->startSection('content'); ?>
<div class="container mx-auto max-w-5xl p-6 font-sans">
    <div class="bg-white dark:bg-dark-bg-secondary border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm overflow-hidden">
        <!-- Başlık -->
        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4 bg-white dark:bg-dark-bg-secondary">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-dark-text-primary">POS Satış Ekranı</h1>
        </div>

        <!-- Ürün Arama -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-dark-bg-primary border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <input type="text" id="search" placeholder="Ürün adı ya da barkod..." class="flex-1 border border-gray-300 dark:border-gray-600 px-4 py-2 rounded-md text-sm focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 text-gray-700 dark:text-dark-text-primary bg-white dark:bg-dark-bg-secondary">
                <button id="add-product" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-md">Ekle</button>
            </div>
            <div id="stock-info" class="mt-2 text-xs text-gray-500 dark:text-dark-text-secondary">Bir ürün arayın ve ekleyin.</div>
        </div>

        <!-- Sepet -->
        <div class="px-6 py-4 bg-white dark:bg-dark-bg-secondary">
            <h2 class="text-lg font-medium text-gray-700 dark:text-dark-text-primary mb-3">Sepet</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-t border-b border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="text-left text-gray-500 dark:text-dark-text-secondary">
                            <th class="py-2">Ürün</th>
                            <th class="py-2">Adet</th>
                            <th class="py-2">Stok</th>
                            <th class="py-2">Fiyat</th>
                            <th class="py-2">Toplam</th>
                            <th class="py-2 text-right">İşlem</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items" class="text-gray-700 dark:text-dark-text-primary">
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-400 dark:text-gray-500">Sepetiniz boş.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 dark:bg-dark-bg-primary border-t border-gray-200 dark:border-gray-700">
    <div class="grid grid-cols-2 gap-6">
        <!-- Sol Alan: İndirim ve Ödeme Tipi -->
        <div class="space-y-4">
            <!-- İndirim -->
            <div class="flex items-center gap-2">
                <label for="indirim" class="text-sm text-gray-600 dark:text-dark-text-secondary w-32">İndirim:</label>
                <input type="text"
                       id="indirim"
                       name="indirim"
                       class="w-48 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:outline-none focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 text-gray-700 dark:text-dark-text-primary bg-white dark:bg-dark-bg-secondary"
                       placeholder="TL / %">
            </div>

            <!-- Ödeme Tipi -->
            <div class="flex items-center gap-2">
                <label for="odeme-tipi" class="text-sm text-gray-600 dark:text-dark-text-secondary w-32">Ödeme Tipi:</label>
                <select id="odeme-tipi"
                        class="w-48 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-800 text-gray-700 dark:text-dark-text-primary bg-white dark:bg-dark-bg-secondary">
                    <option value="Nakit">Nakit</option>
                    <option value="Kredi Kartı">Kredi Kartı</option>
                    <option value="Havale">Havale</option>
                </select>
            </div>
        </div>

        <!-- Sağ Alan: Toplam Bilgileri -->
        <div class="space-y-2 text-right text-gray-800 dark:text-dark-text-primary">
            <div class="flex justify-between text-sm text-gray-600 dark:text-dark-text-secondary">
                <span>Ara Toplam:</span>
                <span id="ara-toplam">₺0.00</span>
            </div>
            <div class="flex justify-between text-sm text-red-500 dark:text-red-400">
                <span>İndirim:</span>
                <span id="indirim-tutari">-₺0.00</span>
            </div>
            <div class="flex justify-between text-base font-semibold border-t pt-2 border-gray-200 dark:border-gray-700">
                <span>Genel Toplam:</span>
                <span id="genel-toplam">₺0.00</span>
            </div>
        </div>
    </div>

    <!-- Butonlar -->
    <div class="mt-6 flex justify-end gap-3">
        <button id="iptal-et"
                class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-dark-text-secondary px-5 py-2 rounded hover:bg-gray-100 dark:hover:bg-dark-bg-secondary text-sm">
            Temizle
        </button>
        <button id="satisi-tamamla"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-sm">
            Satışı Tamamla
        </button>
    </div>
</div>


<!-- Satış sonrası modal -->
<div id="sale-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black dark:bg-black/70 bg-opacity-50 hidden">
    <div class="bg-white dark:bg-dark-bg-secondary rounded-2xl shadow-xl w-full max-w-md p-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-dark-text-primary mb-4">Satış Tamamlandı</h2>

        <div class="mb-4">
            <label for="receipt-email" class="block text-sm font-medium text-gray-700 dark:text-dark-text-secondary mb-1">
                Fiş göndermek için e-posta adresi:
            </label>
            <input type="email" id="receipt-email"
       class="w-full border border-gray-300 dark:border-gray-600 px-4 py-2 rounded-md text-sm focus:ring focus:ring-blue-200 dark:focus:ring-blue-800 text-gray-700 dark:text-dark-text-primary bg-white dark:bg-dark-bg-secondary"
       placeholder="ornek@mail.com">

        </div>

        <div class="flex justify-between items-center mb-4 gap-3">
            <button id="send-mail"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">
                Mail Gönder
            </button>
            <button id="print-receipt"
                    class="flex-1 bg-gray-700 dark:bg-gray-600 hover:bg-gray-800 dark:hover:bg-gray-700 text-white font-semibold py-2 rounded-md transition">
                Çıktı Al
            </button>
        </div>

        <div id="receipt-area" class="hidden border-t pt-4 mt-4 text-sm text-gray-600 dark:text-dark-text-secondary border-gray-200 dark:border-gray-700">
            <div class="font-semibold text-base text-gray-800 dark:text-dark-text-primary mb-1">Fiş Özeti</div>
            <div><strong>Toplam Tutar:</strong> <span id="receipt-total"></span></div>
            <div><strong>Kasiyer:</strong> <span id="receipt-cashier"></span></div>
            <div><strong>Tarih:</strong> <span id="receipt-date"></span></div>
        </div>

        <div class="mt-6 text-center">
            <button id="close-modal" class="text-red-600 dark:text-red-400 font-medium hover:underline text-sm">Kapat</button>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    let cart = [];
    let cashierName = '<?php echo e(auth()->user()->name ? explode(" ", auth()->user()->name)[0] : "Kasiyer"); ?>';

    // DOM Elementleri
    const searchInput = document.getElementById('search');
    const addBtn = document.getElementById('add-product');
    const cartTable = document.getElementById('cart-items');
    const stockInfo = document.getElementById('stock-info');
    const indirimInput = document.getElementById('indirim');
    const indirimGosterge = document.getElementById('indirim-tutari');
    const araToplamGosterge = document.getElementById('ara-toplam');
    const genelToplamGosterge = document.getElementById('genel-toplam');
    const iptalEtBtn = document.getElementById('iptal-et');
    const satisiTamamlaBtn = document.getElementById('satisi-tamamla');

    // Sepeti Render Etme
    const renderCart = () => {
        cartTable.innerHTML = '';
        let total = 0;

        if (cart.length === 0) {
            cartTable.innerHTML = `<tr><td colspan="6" class="text-center text-gray-400 dark:text-gray-500">Sepet boş.</td></tr>`;
            updateTotals(0);
            return;
        }

        cart.forEach((item, i) => {
            const itemTotal = item.quantity * item.price;
            total += itemTotal;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="py-2 text-gray-700 dark:text-dark-text-primary">${item.name}</td>
                <td class="py-2 text-gray-700 dark:text-dark-text-primary">
                    <button data-index="${i}" data-delta="-1" class="qty-btn text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">-</button>
                    <span class="mx-2">${item.quantity}</span>
                    <button data-index="${i}" data-delta="1" class="qty-btn text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">+</button>
                </td>
                <td class="py-2 text-gray-700 dark:text-dark-text-primary">${item.stock_quantity}</td>
                <td class="py-2 text-green-600 dark:text-green-400">₺${item.price.toFixed(2)}</td>
                <td class="py-2 text-gray-700 dark:text-dark-text-primary">₺${itemTotal.toFixed(2)}</td>
                <td class="text-right pr-4 py-2">
    <button data-index="${i}" class="remove-btn text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">Sil</button>
</td>

            `;
            cartTable.appendChild(row);
        });

        // Buton event listener'larını ekle
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.target.getAttribute('data-index'));
                const delta = parseInt(e.target.getAttribute('data-delta'));
                updateQty(index, delta);
            });
        });

        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.target.getAttribute('data-index'));
                removeItem(index);
            });
        });

        updateTotals(total);
    };

    // Toplamları Güncelleme
    const updateTotals = (total) => {
        if (!indirimInput) return;

        const raw = indirimInput.value.trim();
        let indirim = 0;

        if (raw.includes('%')) {
            const oran = parseFloat(raw.replace('%', '')) || 0;
            indirim = total * (oran / 100);
        } else {
            indirim = parseFloat(raw) || 0;
        }

        const genelToplam = total - indirim;

        araToplamGosterge.innerText = `₺${total.toFixed(2)}`;
        indirimGosterge.innerText = `-₺${indirim.toFixed(2)}`;
        genelToplamGosterge.innerText = `₺${genelToplam.toFixed(2)}`;
    };

    // Miktar Güncelleme
    const updateQty = (index, delta) => {
        if (delta > 0 && cart[index].quantity >= cart[index].stock_quantity) {
            alert("Stokta yeterli ürün yok!");
            return;
        }

        cart[index].quantity += delta;
        
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        
        renderCart();
    };

    // Ürün Silme
    const removeItem = (index) => {
        cart.splice(index, 1);
        renderCart();
    };

    // Ürün Arama ve Ekleme
    const fetchProduct = (keyword, callback) => {
        fetch('/sales/search-product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ query: keyword })
        })
        .then(res => res.json())
        .then(products => callback(products))
        .catch(err => {
            console.error(err);
            stockInfo.innerHTML = '<span class="text-red-600">Hata oluştu.</span>';
        });
    };

    // Event Listeners
    searchInput.addEventListener('input', () => {
        const keyword = searchInput.value.trim();
        if (!keyword) {
            stockInfo.innerHTML = 'Bir ürün arayın ve ekleyin.';
            return;
        }

        fetchProduct(keyword, (products) => {
            if (products.length > 0) {
                stockInfo.innerHTML = `Stok: <b>${products[0].stock_quantity}</b>`;
            } else {
                stockInfo.innerHTML = '<span class="text-red-600">Ürün bulunamadı</span>';
            }
        });
    });

    addBtn.addEventListener('click', () => {
        const keyword = searchInput.value.trim();
        if (!keyword) {
            alert("Lütfen bir ürün adı girin!");
            return;
        }

        fetchProduct(keyword, (products) => {
            if (products.length === 0) {
                alert('Ürün bulunamadı!');
                return;
            }

            const found = products[0];
            const idx = cart.findIndex(p => p.id === found.id);

            if (idx > -1) {
                if (cart[idx].quantity >= found.stock_quantity) {
                    alert("Stokta yeterli ürün yok!");
                    return;
                }
                cart[idx].quantity++;
            } else {
                cart.push({
                    id: found.id,
                    name: found.name,
                    price: parseFloat(found.price),
                    stock_quantity: found.stock_quantity,
                    quantity: 1
                });
            }

            renderCart();
            searchInput.value = '';
            stockInfo.innerHTML = '';
        });
    });

    iptalEtBtn.addEventListener('click', () => {
        cart = [];
        renderCart();
    });

    satisiTamamlaBtn.addEventListener('click', () => {
        if (cart.length === 0) {
            alert('Sepet boş!');
            return;
        }

        const paymentType = document.getElementById('odeme-tipi').value;
        const discount = indirimInput.value.trim();

        fetch('/sales/complete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ 
                items: cart,
                payment_type: paymentType,
                discount: discount
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('sale-modal').classList.remove('hidden');
                document.getElementById('receipt-total').innerText = `₺${cart.reduce((a, b) => a + (b.price * b.quantity), 0).toFixed(2)}`;
                document.getElementById('receipt-cashier').innerText = cashierName;
                document.getElementById('receipt-date').innerText = new Date().toLocaleString('tr-TR');
                cart = [];
                renderCart();
            } else {
                alert(data.message || 'Satış başarısız.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Satış sırasında bir hata oluştu.');
        });
    });

    // Modal İşlemleri
    document.getElementById('close-modal').addEventListener('click', () => {
        document.getElementById('sale-modal').classList.add('hidden');
        document.getElementById('receipt-area').classList.add('hidden');
    });

    document.getElementById('print-receipt').addEventListener('click', () => {
        document.getElementById('receipt-area').classList.remove('hidden');
        setTimeout(() => window.print(), 500);
    });

    document.getElementById('send-mail').onclick = () => {
    const email = document.getElementById('receipt-email').value.trim();
    const total = parseFloat(document.getElementById('receipt-total').innerText.replace('₺', ''));

    if (!email) {
        alert('E-posta adresi girin!');
        return;
    }

    fetch("<?php echo e(url('/sales/send-simple-receipt')); ?>", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            receiptEmail: email,
            totalAmount: total
        })
    })
    .then(res => {
        if (!res.ok) throw new Error('Sunucudan başarısız yanıt alındı');
        return res.json();
    })
    .then(data => {
        alert(data.message || 'Fiş e-posta ile gönderildi.');
    })
    .catch(err => {
        console.error(err);
        alert('E-posta gönderilirken bir hata oluştu.');
    });
};

    // İndirim inputu değiştiğinde toplamları güncelle
    indirimInput.addEventListener('input', () => {
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        updateTotals(total);
    });

    // İlk render
    renderCart();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Projelerim\StokTakipOtomasyonu\resources\views/sales/index.blade.php ENDPATH**/ ?>