@extends('layouts.admin')

@section('title', 'Edit Penilaian')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Penilaian: {{ $daerah->nama_daerah }}</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Masukkan nilai untuk setiap kriteria pada daerah ini.</p>
            
            <div class="mt-5">
                <form action="{{ route('admin.penilaian.update', ['penilaian' => $daerah->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        @foreach($kriterias as $index => $kriteria)
                        <div>
                            <label for="kriteria_{{ $kriteria->id }}" class="block text-sm font-medium text-gray-700">
                                C{{ $index + 1 }} - {{ $kriteria->nama_kriteria }} 
                                <span class="text-gray-400 text-xs">({{ ucfirst($kriteria->jenis) }})</span>
                            </label>
                            <div class="mt-1">
                                <input type="number" step="0.01" name="nilai[{{ $kriteria->id }}]" id="kriteria_{{ $kriteria->id }}" 
                                    value="{{ $nilaiDaerah[$kriteria->id] ?? '' }}" required
                                    class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Masukkan nilai...">
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex items-center justify-end">
                        <a href="{{ route('admin.penilaian.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-500 mr-4">Batal</a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
