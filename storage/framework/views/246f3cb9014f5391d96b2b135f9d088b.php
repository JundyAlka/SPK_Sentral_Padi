

<?php $__env->startSection('title', 'Dashboard User - SPK Padi'); ?>

<?php $__env->startSection('content'); ?>


    <!-- Main Welcome Banner (Hero Section) -->
    <div class="relative bg-emerald-900 rounded-2xl shadow-xl mb-10 overflow-hidden min-h-[400px] flex items-center">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="<?php echo e(asset('hero_padi.png')); ?>" class="w-full h-full object-cover opacity-80" alt="Sawah Padi">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 via-emerald-800/70 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 px-8 py-10 w-full flex items-center justify-between">
            <div class="max-w-2xl text-white">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight tracking-tight text-shadow-sm">
                    Selamat Datang, <br>
                    <span class="text-yellow-400"><?php echo e(Auth::check() ? Auth::user()->name : 'Tamu (Demo)'); ?>!</span>
                </h2>
                <p class="mb-8 text-lg text-emerald-100 font-light leading-relaxed text-shadow-sm">
                    Sistem Pendukung Keputusan cerdas untuk menentukan sentral produksi padi terbaik di Pulau Jawa.
                </p>

            </div>
            <!-- Floating Modern Stats Logo -->
            <div class="hidden md:block">
                <img src="<?php echo e(asset('logo_stats.png')); ?>" class="w-48 h-48 object-contain drop-shadow-2xl opacity-90 hover:opacity-100 transition-opacity duration-500 animate-float" alt="Analytics Icon">
            </div>
        </div>
    </div>

    <!-- Top Ranking & Chart Section -->
    <div class="grid grid-cols-1 gap-8 mb-8">
        <!-- Chart Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Tren Perankingan 5 Besar</h3>
            <div class="relative h-[450px]"> 
                <canvas id="rankingChart"></canvas>
            </div>
        </div>

        <!-- Top 5 Rankings Table -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="text-lg font-semibold text-gray-800">5 Besar Daerah Terbaik</h3>
                <button onclick="window.print()" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Hasil
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Daerah</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Skor</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = array_slice($hasil, 0, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-6 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full <?php echo e($h['rank'] == 1 ? 'bg-yellow-100 text-yellow-800' : ($h['rank'] == 2 ? 'bg-gray-100 text-gray-800' : ($h['rank'] == 3 ? 'bg-orange-100 text-orange-800' : 'bg-emerald-50 text-emerald-800'))); ?> text-xs font-bold">
                                    <?php echo e($h['rank']); ?>

                                </span>
                            </td>
                            <td class="px-4 py-6 whitespace-nowrap text-sm font-medium text-gray-900">
                                <?php echo e($h['nama_daerah']); ?>

                                <span class="block text-xs text-gray-500"><?php echo e($h['provinsi']); ?></span>
                            </td>
                            <td class="px-4 py-6 whitespace-nowrap text-right text-sm font-bold text-emerald-600">
                                <?php echo e(number_format($h['skor_total'], 4)); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-gray-500 text-sm">Belum ada data perhitungan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kriteria Reference Table -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hasil = <?php echo json_encode(array_slice($hasil, 0, 10)) ?>; // Top 10 for chart
        
        const ctx = document.getElementById('rankingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hasil.map(h => h.nama_daerah),
                datasets: [{
                    label: 'Skor SAW',
                    data: hasil.map(h => h.skor_total),
                    backgroundColor: 'rgba(16, 185, 129, 0.7)', 
                    borderColor: 'rgba(5, 150, 105, 1)', 
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, max: 1 }
                },
                plugins: { legend: { display: false } }
            }
        });
    });
</script>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Website\spk_sentral_padi\resources\views/user/dashboard.blade.php ENDPATH**/ ?>