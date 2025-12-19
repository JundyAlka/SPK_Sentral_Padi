@extends('layouts.admin')

@section('title', 'Data Penilaian')

@section('content')
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Data Penilaian</h1>
        <nav class="flex text-sm text-gray-500 mt-1">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">Penilaian</span>
        </nav>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alternatif</th>
                    @foreach($kriterias as $index => $kriteria)
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider" title="{{ $kriteria->nama_kriteria }}">
                        C{{ $index + 1 }}
                    </th>
                    @endforeach
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($daerahs as $index => $daerah)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $daerah->nama_daerah }}</td>
                    
                    @foreach($kriterias as $kriteria)
                    @php
                        $nilai = $daerah->nilaiDaerah->where('kriteria_id', $kriteria->id)->first();
                    @endphp
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                        {{ $nilai ? $nilai->nilai : '-' }}
                    </td>
                    @endforeach

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.penilaian.edit', ['penilaian' => $daerah->id]) }}" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition-colors inline-block" title="Edit Penilaian">
                           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ 3 + count($kriterias) }}" class="px-6 py-12 text-center text-gray-500">
                        Belum ada data alternatif untuk dinilai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
