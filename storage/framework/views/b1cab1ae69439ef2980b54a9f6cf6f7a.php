<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8, 0, 1, 1); }
            50% { transform: translateY(0); animation-timing-function: cubic-bezier(0, 0, 0.2, 1); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 3s infinite;
        }
        .text-shadow-sm {
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <div class="min-h-screen flex overflow-hidden">
        
        <!-- Sidebar for Desktop -->
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Mobile Sidebar (Hidden by default) -->
        <div id="mobile-sidebar" class="hidden fixed inset-0 z-40 flex md:hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true" onclick="document.getElementById('mobile-sidebar').classList.add('hidden')"></div>
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-emerald-800">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Reuse Sidebar Content for Mobile (Simpler version or same logic) -->
                 <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4 mb-5">
                       <img src="<?php echo e(asset('logo.png')); ?>" class="h-8 w-8 rounded-full bg-white p-1" alt="Logo">
                       <span class="ml-2 text-white font-bold text-lg">SPK PADI</span>
                    </div>
                    <nav class="mt-5 px-2 space-y-1">
                         <!-- Copy of Sidebar Links (Ideally extract to a partial, but inline for now to avoid complexity) -->
                         <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-emerald-100 hover:bg-emerald-700 block px-3 py-2 rounded-md text-base font-medium">Menu Admin (Jika Login)</a>
                         <a href="<?php echo e(route('user.dashboard')); ?>" class="text-emerald-100 hover:bg-emerald-700 block px-3 py-2 rounded-md text-base font-medium">Dashboard User</a>
                         <a href="<?php echo e(route('user.analisis.index')); ?>" class="text-emerald-100 hover:bg-emerald-700 block px-3 py-2 rounded-md text-base font-medium">Analisis</a>
                         <a href="<?php echo e(route('login')); ?>" class="text-emerald-100 hover:bg-emerald-700 block px-3 py-2 rounded-md text-base font-medium mt-4 border-t border-emerald-700 pt-4">Login / Logout</a>
                    </nav>
                </div>
            </div>
            <div class="flex-shrink-0 w-14"></div>
        </div>

        <!-- Main Content Column -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            
            <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
                <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </main>
        </div>
    </div>
    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('desktop-sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');
                
                // Toggle text visibility
                const texts = sidebar.querySelectorAll('.sidebar-text');
                texts.forEach(text => {
                    text.classList.toggle('hidden');
                });
            });
        }
    </script>
</body>
</html>
<?php /**PATH D:\Website\spk_sentral_padi\resources\views/layouts/app.blade.php ENDPATH**/ ?>