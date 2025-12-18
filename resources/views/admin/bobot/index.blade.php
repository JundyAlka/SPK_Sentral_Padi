@extends('layouts.admin')

@section('title', 'Atur Bobot Kriteria')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Pengaturan Bobot Kriteria</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Tentukan bobot kepentingan untuk setiap kriteria. Total bobot harus berjumlah <strong>1</strong> (atau 100%).
            </p>

            <div class="mt-5">
                <form action="{{ route('admin.bobot.update') }}" method="POST">
                    @csrf
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg mb-6">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Kriteria</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jenis</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bobot Saat Ini</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bobot Baru</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($kriterias as $kriteria)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $kriteria->nama_kriteria }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $kriteria->jenis == 'benefit' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($kriteria->jenis) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $kriteria->bobotDefault->bobot ?? '0' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <input type="number" step="0.0001" min="0" max="1" name="bobot[{{ $kriteria->id }}]" 
                                            value="{{ $kriteria->bobotDefault->bobot ?? '' }}" required
                                            class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Simpan Perubahan Bobot
                        </button>
                    </div>
                </form>
            </div>
            
            @if($kriterias->isNotEmpty() && $kriterias->first()->bobotDefault)
            <div class="mt-4 text-xs text-gray-400 text-right">
                Bobot terakhir diperbarui pada {{ $kriterias->first()->bobotDefault->updated_at->format('d M Y H:i') }}
                oleh {{ $kriterias->first()->bobotDefault->updater->name ?? 'Admin' }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
