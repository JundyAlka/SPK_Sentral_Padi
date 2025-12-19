

<?php $__env->startSection('title', 'Data Hasil Akhir'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Data Hasil Akhir</h1>
        <nav class="flex text-sm text-gray-500 mt-1">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-emerald-600">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Hasil Akhir</span>
        </nav>
    </div>
    <div class="mt-4 md:mt-0">
        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-colors">
            <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Laporan
        </button>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-emerald-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider w-16">Peringkat</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Alternatif</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Provinsi</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Skor Akhir</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = collect($hasil)->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-emerald-50/50 transition duration-150 ease-in-out <?php echo e($index == 0 ? 'bg-emerald-50' : ''); ?>">
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full font-bold <?php echo e($index == 0 ? 'bg-yellow-100 text-yellow-700 ring-4 ring-yellow-50' : ($index == 1 ? 'bg-gray-100 text-gray-700' : ($index == 2 ? 'bg-orange-100 text-orange-700' : 'text-gray-500'))); ?>">
                            <?php echo e($row['rank']); ?>

                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900"><?php echo e($row['nama_daerah']); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?php echo e($row['provinsi']); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="text-base font-bold text-emerald-700"><?php echo e(number_format($row['skor_total'], 4)); ?></span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        Belum ada data perhitungan.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website\spk_sentral_padi\resources\views/admin/hasil/index.blade.php ENDPATH**/ ?>