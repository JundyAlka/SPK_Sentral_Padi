<div id="desktop-sidebar" class="hidden md:flex flex-col w-64 bg-emerald-900 border-r border-emerald-800 transition-all duration-300 ease-in-out">
    <div class="flex items-center justify-center h-16 shadow-md bg-emerald-800 overflow-hidden">
        <a href="/" class="flex items-center gap-2">
            <img src="<?php echo e(asset('logo.png')); ?>" alt="Logo" class="h-8 w-8 rounded-full bg-white p-1 flex-shrink-0">
            <span class="text-white font-bold text-lg tracking-wider sidebar-text whitespace-nowrap">SPK PADI</span>
        </a>
    </div>
    
    <div class="flex-1 flex flex-col overflow-y-auto overflow-x-hidden">
        <nav class="flex-1 px-2 py-4 space-y-1">
            <?php if(Auth::check() && Auth::user()->role === 'admin'): ?>
                <div class="px-2 mb-2 text-xs font-semibold text-emerald-400 uppercase tracking-wider sidebar-text">
                    Menu Admin
                </div>
                
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'bg-emerald-800 text-white' : 'text-emerald-100 hover:bg-emerald-700'); ?> group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors whitespace-nowrap" title="Dashboard">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.dashboard') ? 'text-white' : 'text-emerald-300'); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <a href="<?php echo e(route('admin.kriteria.index')); ?>" class="<?php echo e(request()->routeIs('admin.kriteria.*') ? 'bg-emerald-800 text-white' : 'text-emerald-100 hover:bg-emerald-700'); ?> group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors whitespace-nowrap" title="Data Kriteria">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.kriteria.*') ? 'text-white' : 'text-emerald-300'); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    <span class="sidebar-text">Data Kriteria</span>
                </a>
                
                <a href="<?php echo e(route('admin.bobot.index')); ?>" class="<?php echo e(request()->routeIs('admin.bobot.*') ? 'bg-emerald-800 text-white' : 'text-emerald-100 hover:bg-emerald-700'); ?> group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors whitespace-nowrap" title="Pembobotan Evaluasi">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.bobot.*') ? 'text-white' : 'text-emerald-300'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                    <span class="sidebar-text">Pembobotan Evaluasi</span>
                </a>

                <a href="<?php echo e(route('admin.daerah.index')); ?>" class="<?php echo e(request()->routeIs('admin.daerah.*') ? 'bg-emerald-800 text-white' : 'text-emerald-100 hover:bg-emerald-700'); ?> group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors whitespace-nowrap" title="Data Daerah">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('admin.daerah.*') ? 'text-white' : 'text-emerald-300'); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sidebar-text">Data Daerah</span>
                </a>
            <?php endif; ?>

            <?php if(Auth::check() && Auth::user()->role === 'user' || !Auth::check()): ?>
                 <div class="px-2 mb-2 text-xs font-semibold text-emerald-400 uppercase tracking-wider mt-4 sidebar-text">
                    Menu User
                </div>
                
                <a href="<?php echo e(route('user.dashboard')); ?>" class="<?php echo e(request()->routeIs('user.dashboard') ? 'bg-emerald-800 text-white' : 'text-emerald-100 hover:bg-emerald-700'); ?> group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors whitespace-nowrap" title="Dashboard">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('user.dashboard') ? 'text-white' : 'text-emerald-300'); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <a href="<?php echo e(route('user.analisis.index')); ?>" class="<?php echo e(request()->routeIs('user.analisis.*') ? 'bg-emerald-800 text-white' : 'text-emerald-100 hover:bg-emerald-700'); ?> group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors whitespace-nowrap" title="Analisis SAW">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 <?php echo e(request()->routeIs('user.analisis.*') ? 'text-white' : 'text-emerald-300'); ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="sidebar-text">Analisis SAW</span>
                </a>
            <?php endif; ?>
        </nav>
        
        <!-- Sidebar Mascot -->
        <div class="px-4 pb-4 mt-auto hidden md:block">
            <div class="bg-emerald-800/50 rounded-xl p-3 flex flex-col items-center text-center transform hover:scale-105 transition-transform duration-300">
                <img src="<?php echo e(asset('logo_padi_mascot.png')); ?>" alt="Mascot" class="w-12 h-12 mb-2 animate-bounce-slow sidebar-text">
                <p class="text-[10px] text-emerald-200 leading-tight sidebar-text">
                    SPK Padi<br>Siap Membantu!
                </p>
            </div>
        </div>
    </div>
    
    <div class="flex-shrink-0 border-t border-emerald-800 p-4 overflow-hidden">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center min-w-0">
                <div class="inline-block h-9 w-9 rounded-full bg-emerald-200 text-emerald-800 flex items-center justify-center font-bold flex-shrink-0">
                     <?php echo e(Auth::check() ? substr(Auth::user()->name, 0, 1) : 'G'); ?>

                </div>
                <div class="ml-3 sidebar-text truncate">
                    <p class="text-sm font-medium text-white truncate">
                        <?php echo e(Auth::check() ? Auth::user()->name : 'Guest User'); ?>

                    </p>
                    <p class="text-xs font-medium text-emerald-300">
                        <?php echo e(Auth::check() ? ucfirst(Auth::user()->role) : 'Demo Mode'); ?>

                    </p>
                </div>
            </div>
            
            <div class="sidebar-text flex-shrink-0 ml-2">
                <?php if(Auth::check()): ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-emerald-300 hover:text-white p-1 rounded-full hover:bg-emerald-800 transition-colors" title="Sign out">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
                <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="text-emerald-300 hover:text-white p-1 rounded-full hover:bg-emerald-800 transition-colors" title="Login">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Website\spk_sentral_padi\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>