@extends('layouts.app')

@section('title', 'Detail Perhitungan')

@section('content')
<div class="mb-6">
    <a href="javascript:history.back()" class="text-sm font-medium text-green-600 hover:text-green-500 mb-4 inline-block">
        &larr; Kembali
    </a>
    <h1 class="text-2xl font-bold text-gray-900">Detail Perhitungan: {{ $detailDaerah['nama_daerah'] }}</h1>
    <p class="mt-1 text-sm text-gray-500">Provinsi: {{ $detailDaerah['provinsi'] }}</p>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- Tabel Detail -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Rincian Per Kriteria</h3>
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Kriteria</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nilai Asli</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Normalisasi</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bobot</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Skor (Norm × Bobot)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($kriterias as $kriteria)
                            @php
                                $detail = $detailDaerah['detail'][$kriteria->id];
                            @endphp
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $kriteria->nama_kriteria }}
                                    <span class="text-xs text-gray-400 block">({{ ucfirst($kriteria->jenis) }})</span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $detail['nilai_asli'] }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ number_format($detail['normalisasi'], 4) }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $detail['bobot'] }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm font-bold text-gray-900">{{ number_format($detail['skor'], 4) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Ringkasan</h3>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Total Skor</dt>
                        <dd class="mt-1 text-3xl font-bold text-green-600">
                            {{ number_format($detailDaerah['skor_total'], 4) }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Peringkat Global</dt>
                        <dd class="mt-1 text-3xl font-bold text-gray-900">
                            #{{ $detailDaerah['rank'] }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
