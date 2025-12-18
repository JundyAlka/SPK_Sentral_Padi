@extends('layouts.guest')

@section('title', 'Daerah Publik')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Daerah Publik</h1>
    @if($daerahs->isEmpty())
        <p class="text-gray-600">Tidak ada data daerah yang tersedia untuk tamu.</p>
    @else
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Daerah</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Provinsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($daerahs as $index => $daerah)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-600 text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 text-sm text-gray-800">{{ $daerah->nama_daerah }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $daerah->provinsi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
