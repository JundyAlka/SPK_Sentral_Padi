@extends('layouts.app')

@section('title', 'Dashboard User - SPK Padi')

@section('content')
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-emerald-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Kriteria</p>
                    <p class="text-lg font-semibold text-gray-700">4 Kriteria Utama</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Daerah Terdata</p>
                    <p class="text-lg font-semibold text-gray-700">Pulau Jawa</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                     <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
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
            <img src="{{ asset('hero_padi.png') }}" class="w-full h-full object-cover opacity-80" alt="Sawah Padi">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 via-emerald-800/70 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 px-8 py-10 w-full flex items-center justify-between">
            <div class="max-w-2xl text-white">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight tracking-tight text-shadow-sm">
                    Selamat Datang, <br>
                    <span class="text-yellow-400">{{ Auth::check() ? Auth::user()->name : 'Tamu (Demo)' }}!</span>
                </h2>
                <p class="mb-8 text-lg text-emerald-100 font-light leading-relaxed text-shadow-sm">
                    Sistem Pendukung Keputusan cerdas untuk menentukan sentral produksi padi terbaik di Pulau Jawa.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('user.analisis.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-full text-emerald-900 bg-yellow-400 hover:bg-yellow-300 shadow-lg transform transition hover:-translate-y-1 hover:shadow-yellow-400/50">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mulai Analisis
                    </a>
                </div>
            </div>
            <!-- Floating Modern Stats Logo -->
            <div class="hidden md:block">
                <img src="{{ asset('logo_stats.png') }}" class="w-48 h-48 object-contain drop-shadow-2xl opacity-90 hover:opacity-100 transition-opacity duration-500 animate-float" alt="Analytics Icon">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Chart Section (Mock Visual) -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Tren Produksi (Visualisasi Data)</h3>
            <div class="h-64 flex items-end space-x-2 sm:space-x-4 justify-between pt-4 px-2">
                <!-- Simple CSS Bar Chart -->
                <div class="flex flex-col items-center w-full group">
                    <div class="relative w-full bg-emerald-100 rounded-t-md group-hover:bg-emerald-200 transition-all h-32 md:h-40">
                         <div class="absolute bottom-0 w-full bg-emerald-500 rounded-t-md transition-all group-hover:bg-emerald-600" style="height: 60%"></div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 font-medium">Jabar</span>
                </div>
                <div class="flex flex-col items-center w-full group">
                    <div class="relative w-full bg-emerald-100 rounded-t-md group-hover:bg-emerald-200 transition-all h-32 md:h-40">
                         <div class="absolute bottom-0 w-full bg-emerald-500 rounded-t-md transition-all group-hover:bg-emerald-600" style="height: 85%"></div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 font-medium">Jateng</span>
                </div>
                <div class="flex flex-col items-center w-full group">
                    <div class="relative w-full bg-emerald-100 rounded-t-md group-hover:bg-emerald-200 transition-all h-32 md:h-40">
                         <div class="absolute bottom-0 w-full bg-emerald-500 rounded-t-md transition-all group-hover:bg-emerald-600" style="height: 75%"></div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 font-medium">Jatim</span>
                </div>
                <div class="flex flex-col items-center w-full group">
                    <div class="relative w-full bg-emerald-100 rounded-t-md group-hover:bg-emerald-200 transition-all h-32 md:h-40">
                          <div class="absolute bottom-0 w-full bg-emerald-500 rounded-t-md transition-all group-hover:bg-emerald-600" style="height: 40%"></div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 font-medium">Banten</span>
                </div>
                <div class="flex flex-col items-center w-full group">
                    <div class="relative w-full bg-emerald-100 rounded-t-md group-hover:bg-emerald-200 transition-all h-32 md:h-40">
                         <div class="absolute bottom-0 w-full bg-emerald-500 rounded-t-md transition-all group-hover:bg-emerald-600" style="height: 50%"></div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2 font-medium">DIY</span>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4 text-center italic">*Grafik diatas adalah ilustrasi visualisasi data produksi.</p>
        </div>

        <!-- Guide Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Panduan Penggunaan</h3>
             <ul class="space-y-4">
                <li class="flex items-start">
                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs">1</div>
                    <p class="ml-3 text-sm text-gray-600"><span class="font-medium text-gray-900">Login / Masuk</span> sebagai User atau gunakan Mode Demo.</p>
                </li>
                <li class="flex items-start">
                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs">2</div>
                    <p class="ml-3 text-sm text-gray-600">Buka menu <span class="font-medium text-gray-900">Analisis SAW</span> dari sidebar.</p>
                </li>
                <li class="flex items-start">
                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs">3</div>
                    <p class="ml-3 text-sm text-gray-600">Masukkan nama analisis Anda (opsional) dan klik <span class="font-medium text-gray-900">Proses Perhitungan</span>.</p>
                </li>
                <li class="flex items-start">
                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs">4</div>
                    <p class="ml-3 text-sm text-gray-600">Sistem akan menghitung skor berdasarkan bobot kriteria dan menampilkan peringkat daerah terbaik.</p>
                </li>
            </ul>
        </div>
    </div>

    <!-- Kriteria Reference Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                Kriteria & Bobot Referensi
            </h3>
        </div>
        
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kriteria</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($kriterias as $index => $kriteria)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kriteria->nama_kriteria }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $kriteria->jenis == 'benefit' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $kriteria->jenis == 'benefit' ? 'Keuntungan' : 'Biaya' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-emerald-600">
                                {{ $kriteria->bobotDefault->bobot ?? '0' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada kriteria yang ditetapkan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-yellow-50 px-6 py-3 text-sm text-yellow-700">
            <strong>Catatan:</strong> Bobot kriteria ditetapkan oleh Admin dan tidak dapat diubah oleh User.
        </div>
    </div>
@endsection
