

<?php $__env->startSection('title', 'Atur Bobot Kriteria'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Pengaturan Bobot Kriteria</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Tentukan bobot kepentingan untuk setiap kriteria. Total bobot harus berjumlah <strong>1</strong> (atau 100%).
            </p>

            <div class="mt-5">
                <form action="<?php echo e(route('admin.bobot.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg mb-6">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Kriteria</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jenis</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bobot Saat Ini</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bobot Baru</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?php echo e($kriteria->nama_kriteria); ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($kriteria->jenis == 'benefit' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo e(ucfirst($kriteria->jenis)); ?>

                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php echo e($kriteria->bobotDefault->bobot ?? '0'); ?>

                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <input type="number" step="0.0001" min="0" max="1" name="bobot[<?php echo e($kriteria->id); ?>]" 
                                            value="<?php echo e($kriteria->bobotDefault->bobot ?? ''); ?>" required
                                            class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Simpan Perubahan Bobot
                        </button>
                    </div>
                </form>
            </div>
            
            <?php if($kriterias->isNotEmpty() && $kriterias->first()->bobotDefault): ?>
            <div class="mt-4 text-xs text-gray-400 text-right">
                Bobot terakhir diperbarui pada <?php echo e($kriterias->first()->bobotDefault->updated_at->format('d M Y H:i')); ?>

                oleh <?php echo e($kriterias->first()->bobotDefault->updater->name ?? 'Admin'); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website\spk_sentral_padi\resources\views/admin/bobot/index.blade.php ENDPATH**/ ?>