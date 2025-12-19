@extends('layouts.admin')

@section('title', 'Data Perhitungan')

@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Data Perhitungan</h1>
        <nav class="flex text-sm text-gray-500 mt-1">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Perhitungan</span>
        </nav>
    </div>
</div>

<div class="space-y-8">
    <!-- Matriks Keputusan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">1. Matriks Keputusan (X)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alternatif</th>
                        @foreach($kriterias as $k)
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ $k->kode_kriteria ?? $k->nama_kriteria }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($hasil as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $row['nama_daerah'] }}
                        </td>
                        @foreach($kriterias as $k)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ $row['detail'][$k->id]['nilai_asli'] }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Matriks Normalisasi -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
             <h3 class="text-lg font-semibold text-gray-900">2. Matriks Normalisasi (R)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alternatif</th>
                        @foreach($kriterias as $k)
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                             {{ $k->kode_kriteria ?? $k->nama_kriteria }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($hasil as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $row['nama_daerah'] }}
                        </td>
                        @foreach($kriterias as $k)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ number_format($row['detail'][$k->id]['normalisasi'], 3) }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Hasil Pembobotan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
             <h3 class="text-lg font-semibold text-gray-900">3. Nilai Terbobot (V)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alternatif</th>
                        @foreach($kriterias as $k)
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                             {{ $k->kode_kriteria ?? $k->nama_kriteria }}
                        </th>
                        @endforeach
                        <th class="px-6 py-3 text-center text-xs font-bold text-emerald-600 uppercase tracking-wider">Total Skor</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($hasil as $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $row['nama_daerah'] }}
                        </td>
                        @foreach($kriterias as $k)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ number_format($row['detail'][$k->id]['skor'], 4) }}
                        </td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-emerald-700 text-center">
                            {{ number_format($row['skor_total'], 4) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
