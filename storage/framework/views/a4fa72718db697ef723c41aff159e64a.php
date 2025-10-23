<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-dark-bg-secondary rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
    <!-- Başlık Kutusu -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-dark-text-primary">Kategoriler</h1>
            <p class="text-sm text-gray-500 dark:text-dark-text-secondary">Tüm kategorilerinizi yönetin ve düzenleyin.</p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-users')): ?>
            <a href="<?php echo e(route('categories.create')); ?>"
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Yeni Kategori
            </a>
        <?php endif; ?>
    </div>

    <!-- İçerik -->
    <div class="px-6 py-4">
        <?php if(session('success')): ?>
            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded mb-4 text-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border-t border-gray-200 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-dark-bg-primary text-gray-600 dark:text-dark-text-secondary uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Ad</th>
                        <th class="px-6 py-3 text-left">Açıklama</th>
                        <th class="px-6 py-3 text-left">Ürün Sayısı</th>
                        <th class="px-6 py-3 text-left">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-dark-bg-primary/50">
                            <td class="px-6 py-4 text-gray-600 dark:text-dark-text-secondary"><?php echo e($category->id); ?></td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-dark-text-primary"><?php echo e($category->name); ?></td>
                            <td class="px-6 py-4 text-gray-500 dark:text-dark-text-secondary"><?php echo e($category->description); ?></td>
                            <td class="px-6 py-4 text-green-600 dark:text-green-400 font-medium"><?php echo e($category->products_count); ?></td>
                            <td class="px-6 py-4 space-x-2">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-users')): ?>
                                    <a href="<?php echo e(route('categories.edit', $category)); ?>"
                                       class="text-blue-600 dark:text-blue-400 hover:underline hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                                        Düzenle
                                    </a>
                                    <form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" class="inline"
                                          onsubmit="return confirm('Bu kategoriyi silmek istediğinizden emin misiniz?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:underline hover:text-red-800 dark:hover:text-red-300 text-sm font-medium">
                                            Sil
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-gray-500 dark:text-gray-400 text-sm">Yetkiniz Yok</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Projelerim\StokTakipOtomasyonu\resources\views/categories/index.blade.php ENDPATH**/ ?>