

<?php $__env->startSection('title', 'Input Nilai Daerah'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Input Nilai Kriteria: <?php echo e($daerah->nama_daerah); ?></h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Masukkan nilai untuk setiap kriteria pada daerah ini.</p>
            
            <div class="mt-5">
                <form action="<?php echo e(route('admin.daerah.nilai.store', ['daerah' => $daerah->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-6">
                        <?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kriteria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <label for="kriteria_<?php echo e($kriteria->id); ?>" class="block text-sm font-medium text-gray-700">
                                <?php echo e($kriteria->nama_kriteria); ?> <span class="text-gray-400 text-xs">(<?php echo e(ucfirst($kriteria->jenis)); ?>)</span>
                            </label>
                            <div class="mt-1">
                                <input type="text" inputmode="decimal" name="nilai[<?php echo e($kriteria->id); ?>]" id="kriteria_<?php echo e($kriteria->id); ?>" 
                                    value="<?php echo e($nilaiDaerah[$kriteria->id] ?? ''); ?>" required
                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Masukkan nilai..."
                                    oninput="this.value = this.value.replace(/[^0-9.,]/g, '').replace(/,/g, '.');">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-6 flex items-center justify-end">
                        <a href="<?php echo e(route('admin.daerah.index')); ?>" class="text-sm font-medium text-gray-700 hover:text-gray-500 mr-4">Batal</a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website\spk_sentral_padi\resources\views/admin/daerah/nilai.blade.php ENDPATH**/ ?>