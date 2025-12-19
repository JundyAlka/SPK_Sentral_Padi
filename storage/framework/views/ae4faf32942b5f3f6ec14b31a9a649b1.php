

<?php $__env->startSection('title', 'Tambah Kriteria'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Kriteria Baru</h3>
            <div class="mt-5">
                <form action="<?php echo e(route('admin.kriteria.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="kode_kriteria" class="block text-sm font-medium text-gray-700">Kode Kriteria</label>
                            <input type="text" name="kode_kriteria" id="kode_kriteria" required class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Contoh: C1">
                        </div>

                        <div class="col-span-6">
                            <label for="nama_kriteria" class="block text-sm font-medium text-gray-700">Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" id="nama_kriteria" required class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6">
                            <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Kriteria</label>
                            <select id="jenis" name="jenis" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                <option value="benefit">Benefit (Semakin besar semakin baik)</option>
                                <option value="cost">Cost (Semakin kecil semakin baik)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end">
                        <a href="<?php echo e(route('admin.kriteria.index')); ?>" class="text-sm font-medium text-gray-700 hover:text-gray-500 mr-4">Batal</a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website\spk_sentral_padi\resources\views/admin/kriteria/create.blade.php ENDPATH**/ ?>