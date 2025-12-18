@extends('layouts.guest')

@section('title', 'Guest Dashboard')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard Tamu</h1>
    <p class="text-gray-600 mb-6">Selamat datang! Berikut adalah log aktivitas sistem terbaru yang dapat dilihat oleh tamu.</p>
    @if(isset($logs) && $logs->isNotEmpty())
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $log->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $log->keterangan ?? $log->description ?? 'Log' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">Tidak ada log tersedia.</p>
    @endif
</div>
@endsection
