

<?php $__env->startSection('title', 'Dashboard Admin - SPK Padi'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Alternatif Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-emerald-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Data Alternatif</p>
                    <p class="text-lg font-semibold text-gray-700"><?php echo e($daerahCount); ?> Daerah</p>
                </div>
            </div>
        </div>

        <!-- Kriteria Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Data Kriteria</p>
                    <p class="text-lg font-semibold text-gray-700"><?php echo e($kriteriasCount); ?> Kriteria</p>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Pengguna</p>
                    <p class="text-lg font-semibold text-gray-700"><?php echo e($usersCount); ?> User</p>
                </div>
            </div>
        </div>
        
        <!-- System Status Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                     <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Status Sistem</p>
                    <div class="flex items-center">
                         <span class="w-2.5 h-2.5 rounded-full bg-green-500 mr-2"></span>
                         <p class="text-lg font-semibold text-gray-700">Online</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Welcome Banner (Hero Section) -->
    <div class="relative bg-emerald-900 rounded-2xl shadow-xl mb-10 overflow-hidden min-h-[250px] flex items-center">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="<?php echo e(asset('hero_padi.png')); ?>" class="w-full h-full object-cover opacity-80" alt="Sawah Padi">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 via-emerald-800/70 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 px-8 py-10 w-full flex items-center justify-between">
            <div class="max-w-2xl text-white">
                <span class="inline-block py-1 px-3 rounded-full bg-yellow-500/20 text-yellow-300 text-sm font-semibold mb-4 border border-yellow-500/50">Admin Control Panel</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight tracking-tight text-shadow-sm">
                    Dashboard Administrator
                </h2>
                <p class="mb-8 text-lg text-emerald-100 font-light leading-relaxed text-shadow-sm">
                    Kelola data kriteria, bobot, dan alternatif daerah untuk memastikan keakuratan hasil analisis SPK.
                </p>

            </div>
            <!-- Floating Modern Stats Logo -->
            <div class="hidden md:block">
                 <img src="<?php echo e(asset('logo_stats.png')); ?>" class="w-40 h-40 object-contain drop-shadow-2xl opacity-90 hover:opacity-100 transition-opacity duration-500 animate-float" alt="Admin Icon">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Top Ranking Table -->
        <div>
            <div class="bg-white rounded-xl shadow overflow-hidden h-full">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Hasil Perankingan Saat Ini</h3>
                    <span class="text-xs bg-green-100 text-green-700 font-semibold px-2 py-1 rounded">SAW Method</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rank</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alternatif</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Provinsi</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Skor Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = collect($hasil)->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="<?php echo e($loop->first ? 'bg-yellow-50' : ''); ?> hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full <?php echo e($loop->first ? 'bg-yellow-400 text-white font-bold' : ($loop->iteration <= 3 ? 'bg-gray-200 text-gray-700' : 'text-gray-500')); ?>">
                                        <?php echo e($row['rank']); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                    <?php echo e($row['nama_daerah']); ?>

                                </td>
                                 <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                    <?php echo e($row['provinsi']); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-green-600">
                                    <?php echo e(number_format($row['skor_total'], 4)); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data untuk kalkulasi ranking.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 text-right">
                    <a href="<?php echo e(route('admin.daerah.index')); ?>" class="text-sm font-medium text-emerald-600 hover:text-emerald-800">Lihat Semua Data &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div>
             <div class="bg-white rounded-xl shadow p-6 h-full">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Perankingan</h3>
                <div class="relative h-64">
                    <canvas id="adminRankingChart"></canvas>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hasil = <?php echo json_encode(array_slice($hasil, 0, 10)) ?>; 
        
        const ctx = document.getElementById('adminRankingChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: hasil.map(h => h.nama_daerah),
                datasets: [{
                    label: 'Skor SAW',
                    data: hasil.map(h => h.skor_total),
                    backgroundColor: 'rgba(59, 130, 246, 0.2)', // Blue-500 with transparency
                    borderColor: 'rgba(37, 99, 235, 1)', // Blue-600
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(255, 255, 255, 1)',
                    pointBorderColor: 'rgba(37, 99, 235, 1)',
                    pointRadius: 4,
                    fill: true,
                    tension: 0.3 // Smooth line
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { 
                        beginAtZero: true, 
                        max: 1,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website\spk_sentral_padi\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>