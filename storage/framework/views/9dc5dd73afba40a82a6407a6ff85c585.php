<header class="bg-white shadow relative z-20">
    <div class="px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <div class="flex items-center gap-4">
            <!-- Mobile Sidebar Toggle -->
            <button type="button" class="md:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500" onclick="document.getElementById('mobile-sidebar').classList.toggle('hidden')">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Sidebar Toggle -->
            <button type="button" id="sidebar-toggle" class="hidden md:flex p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500">
                <span class="sr-only">Toggle sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>
        </div>

        <div class="flex-1 flex justify-between items-center ml-4">
            <!-- Universal Search -->
            <div class="flex-1 max-w-lg lg:max-w-xs ml-4">
                 <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm" placeholder="Cari data daerah, analisis..." type="search">
                </div>
            </div>
            
            <div class="ml-4 flex items-center md:ml-6">
                 <!-- Date Display -->
                 <span class="text-sm font-medium text-gray-500 mr-4 hidden sm:block"><?php echo e(now()->translatedFormat('l, d F Y')); ?></span>
            </div>
        </div>
    </div>
</header>
<?php /**PATH D:\Website\spk_sentral_padi\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>