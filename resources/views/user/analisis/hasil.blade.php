@extends('layouts.app')

@section('title', 'Hasil Analisis')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Hasil Analisis SPK</h1>
    <p class="mt-1 text-sm text-gray-500">Label Analisis: <span class="font-semibold text-gray-900">{{ $namaDaerahInput }}</span></p>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Top 5 -->
    <div class="bg-white shadow sm:rounded-lg lg:col-span-2">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Top 5 Daerah Sentral Produksi Padi</h3>
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-green-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-bold text-green-900 sm:pl-6">Peringkat</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-green-900">Nama Daerah</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-green-900">Provinsi</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-green-900">Skor Akhir</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($top5 as $item)
                        <tr class="{{ $loop->first ? 'bg-yellow-50' : '' }}">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                #{{ $item['rank'] }}
                                @if($loop->first) 🏆 @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 font-semibold">{{ $item['nama_daerah'] }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $item['provinsi'] }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 font-bold">{{ number_format($item['skor_total'], 4) }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('user.analisis.detail', $item['daerah_id']) }}" class="text-green-600 hover:text-green-900">Lihat Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Ranking Global -->
    <div class="bg-white shadow sm:rounded-lg lg:col-span-2">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Perankingan Global (Semua Daerah)</h3>
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Rank</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Daerah</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Skor</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($hasil as $item)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">{{ $item['rank'] }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $item['nama_daerah'] }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ number_format($item['skor_total'], 4) }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="{{ route('user.analisis.detail', $item['daerah_id']) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    <a href="{{ route('user.analisis.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
        &larr; Kembali ke Form Analisis
    </a>
</div>
@endsection
