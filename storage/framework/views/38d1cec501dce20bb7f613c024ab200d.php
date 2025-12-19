

<?php $__env->startSection('title', 'Registrasi - SPK Padi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-bold text-gray-900">Buat Akun Baru</h2>
        <p class="mt-2 text-sm text-gray-600">
            atau <a href="<?php echo e(route('login')); ?>" class="font-medium text-green-600 hover:text-green-500">masuk ke akun yang ada</a>
        </p>
    </div>

    <form class="space-y-6" action="<?php echo e(route('register')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Nama Lengkap
            </label>
            <div class="mt-1">
                <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Alamat Email
            </label>
            <div class="mt-1">
                <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Kata Sandi
            </label>
            <div class="mt-1">
                <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Konfirmasi Kata Sandi
            </label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Daftar
            </button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website\spk_sentral_padi\resources\views/auth/register.blade.php ENDPATH**/ ?>