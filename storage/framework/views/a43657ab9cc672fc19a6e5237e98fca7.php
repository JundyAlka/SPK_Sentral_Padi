<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> - SPK Padi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        @media print {
            .no-print, nav, aside, header, .sidebar, .fixed-sidebar {
                display: none !important;
            }
            .content, main {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            body {
                background: white;
            }
        }
    </style>
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        
        .sidebar-transition { transition: width 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar (Admin Exclusive Theme) -->
        <div id="admin-sidebar" class="hidden md:flex flex-col w-64 bg-emerald-900 border-r-4 border-yellow-500 sidebar-transition relative z-20 shadow-2xl">
            <!-- Exclusive Header -->
            <div class="flex items-center justify-center h-20 bg-emerald-950 border-b border-yellow-600/30 overflow-hidden relative">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 relative z-10 px-4">
                    <div class="p-2 rounded-lg bg-gradient-to-br from-yellow-400 to-yellow-600 shadow-lg shadow-yellow-500/20">
                         <svg class="h-6 w-6 text-emerald-950" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="sidebar-text">
                        <span class="block text-yellow-500 font-bold text-lg tracking-widest leading-none">ADMIN</span>
                        <span class="block text-emerald-300 text-[10px] uppercase tracking-wider">Control Panel</span>
                    </div>
                </a>
            </div>
            
            <div class="flex-1 flex flex-col overflow-y-auto overflow-x-hidden bg-gradient-to-b from-emerald-900 to-emerald-950">
                <nav class="flex-1 px-3 py-6 space-y-2">
                    <div class="px-3 mb-2 text-xs font-bold text-yellow-500/80 uppercase tracking-widest sidebar-text border-b border-yellow-500/10 pb-1">
                        Main Navigation
                    </div>

                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'bg-emerald-800 text-white border-l-4 border-yellow-500 shadow-md' : 'text-emerald-300 hover:bg-emerald-800/50 hover:text-white'); ?> group flex items-center px-3 py-3 text-sm font-medium rounded-r-md transition-all duration-200 whitespace-nowrap mb-1">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.dashboard') ? 'text-yellow-400' : 'text-emerald-500 group-hover:text-yellow-400'); ?> transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="sidebar-text">Dashboard</span>
                    </a>

                    <div class="px-3 mt-6 mb-2 text-xs font-bold text-yellow-500/80 uppercase tracking-widest sidebar-text border-b border-yellow-500/10 pb-1">
                        MASTER DATA
                    </div>
    
                    <a href="<?php echo e(route('admin.kriteria.index')); ?>" class="<?php echo e(request()->routeIs('admin.kriteria.*') ? 'bg-emerald-800 text-white border-l-4 border-yellow-500 shadow-md' : 'text-emerald-300 hover:bg-emerald-800/50 hover:text-white'); ?> group flex items-center px-3 py-3 text-sm font-medium rounded-r-md transition-all duration-200 whitespace-nowrap mb-1">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.kriteria.*') ? 'text-yellow-400' : 'text-emerald-500 group-hover:text-yellow-400'); ?> transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span class="sidebar-text">Data Kriteria</span>
                    </a>

                    <a href="<?php echo e(route('admin.daerah.index')); ?>" class="<?php echo e(request()->routeIs('admin.daerah.*') ? 'bg-emerald-800 text-white border-l-4 border-yellow-500 shadow-md' : 'text-emerald-300 hover:bg-emerald-800/50 hover:text-white'); ?> group flex items-center px-3 py-3 text-sm font-medium rounded-r-md transition-all duration-200 whitespace-nowrap mb-1">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.daerah.*') ? 'text-yellow-400' : 'text-emerald-500 group-hover:text-yellow-400'); ?> transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="sidebar-text">Data Alternatif</span>
                    </a>
                    


                    <a href="<?php echo e(route('admin.perhitungan.index')); ?>" class="<?php echo e(request()->routeIs('admin.perhitungan.*') ? 'bg-emerald-800 text-white border-l-4 border-yellow-500 shadow-md' : 'text-emerald-300 hover:bg-emerald-800/50 hover:text-white'); ?> group flex items-center px-3 py-3 text-sm font-medium rounded-r-md transition-all duration-200 whitespace-nowrap mb-1">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.perhitungan.*') ? 'text-yellow-400' : 'text-emerald-500 group-hover:text-yellow-400'); ?> transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span class="sidebar-text">Data Perhitungan</span>
                    </a>

                    <a href="<?php echo e(route('admin.hasil.index')); ?>" class="<?php echo e(request()->routeIs('admin.hasil.*') ? 'bg-emerald-800 text-white border-l-4 border-yellow-500 shadow-md' : 'text-emerald-300 hover:bg-emerald-800/50 hover:text-white'); ?> group flex items-center px-3 py-3 text-sm font-medium rounded-r-md transition-all duration-200 whitespace-nowrap mb-1">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.hasil.*') ? 'text-yellow-400' : 'text-emerald-500 group-hover:text-yellow-400'); ?> transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="sidebar-text">Data Hasil Akhir</span>
                    </a>

                    <div class="px-3 mt-6 mb-2 text-xs font-bold text-yellow-500/80 uppercase tracking-widest sidebar-text border-b border-yellow-500/10 pb-1">
                        MASTER USER
                    </div>

                    <a href="<?php echo e(route('admin.user.index')); ?>" class="<?php echo e(request()->routeIs('admin.user.*') ? 'bg-emerald-800 text-white border-l-4 border-yellow-500 shadow-md' : 'text-emerald-300 hover:bg-emerald-800/50 hover:text-white'); ?> group flex items-center px-3 py-3 text-sm font-medium rounded-r-md transition-all duration-200 whitespace-nowrap mb-1">
                       <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.user.*') ? 'text-yellow-400' : 'text-emerald-500 group-hover:text-yellow-400'); ?> transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="sidebar-text">Data User</span>
                    </a>

                    <a href="<?php echo e(route('admin.profile.edit')); ?>" class="<?php echo e(request()->routeIs('admin.profile.*') ? 'bg-emerald-800 text-white border-l-4 border-yellow-500 shadow-md' : 'text-emerald-300 hover:bg-emerald-800/50 hover:text-white'); ?> group flex items-center px-3 py-3 text-sm font-medium rounded-r-md transition-all duration-200 whitespace-nowrap mb-1">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.profile.*') ? 'text-yellow-400' : 'text-emerald-500 group-hover:text-yellow-400'); ?> transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="sidebar-text">Data Profile</span>
                    </a>
                </nav>
            </div>
            
            <!-- User Footer (Admin) -->
            <div class="flex-shrink-0 border-t border-emerald-800/50 bg-emerald-950 p-4 overflow-hidden">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center min-w-0">
                        <div class="relative inline-block h-10 w-10 rounded-full bg-yellow-500 text-emerald-900 flex items-center justify-center font-bold text-lg flex-shrink-0 border-2 border-yellow-300 shadow-sm">
                             <?php echo e(Auth::check() ? substr(Auth::user()->name, 0, 1) : 'A'); ?>

                             <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-emerald-900 bg-green-400"></span>
                        </div>
                        <div class="ml-3 sidebar-text truncate">
                            <p class="text-sm font-bold text-yellow-50 truncate">
                                <?php echo e(Auth::check() ? Auth::user()->name : 'Admin'); ?>

                            </p>
                            <p class="text-[10px] font-medium text-yellow-500 uppercase tracking-wide">
                                Super Administrator
                            </p>
                        </div>
                    </div>
                    
                    <div class="sidebar-text flex-shrink-0 ml-2">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-emerald-400 hover:text-red-400 p-2 rounded-full hover:bg-emerald-900/50 transition-colors" title="Sign out / Logout">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden bg-gray-50">
            <!-- Mobile Header -->
            <header class="flex justify-between items-center py-4 px-6 bg-emerald-900 border-b-4 border-yellow-500 md:hidden shadow-md">
                <div class="text-xl font-bold text-white flex items-center gap-2">
                     <svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    ADMIN SPK
                </div>
                <!-- Mobile Sidebar Toggle would go here if implemented for mobile -->
            </header>

            <!-- Topbar (Desktop) -->
            <header class="hidden md:flex justify-between items-center py-4 px-8 bg-white border-b border-gray-100 shadow-sm z-10">
                 <div class="flex items-center">
                    <button id="sidebar-toggle" class="text-gray-400 hover:text-emerald-600 focus:outline-none transition-colors">
                        <svg class="h-6 w-6" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <!-- Universal Search or Breadcrumbs could go here -->
                    <div class="ml-6 text-lg font-bold text-gray-800">
                         <?php echo $__env->yieldContent('title'); ?>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-gray-500"><?php echo e(now()->translatedFormat('l, d F Y')); ?></span>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8 relative">
                <?php if(session('success')): ?>
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-r shadow-sm animate-fade-in" role="alert">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 mr-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <div>
                            <p class="font-bold">Sukses!</p>
                            <p><?php echo e(session('success')); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r shadow-sm animate-fade-in" role="alert">
                     <div class="flex items-center">
                        <svg class="h-6 w-6 mr-3 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <div>
                            <p class="font-bold">Error!</p>
                            <p><?php echo e(session('error')); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
    
    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        
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
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Website\spk_sentral_padi\resources\views/layouts/admin.blade.php ENDPATH**/ ?>