@extends('layouts.admin')

@section('title', 'Edit Data Alternatif')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Data Alternatif</h1>

    <form action="{{ route('admin.daerah.update', $daerah->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
            <select id="provinsi" name="provinsi" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="">Pilih Provinsi</option>
                <option value="DKI Jakarta" {{ $daerah->provinsi == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                <option value="Jawa Barat" {{ $daerah->provinsi == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                <option value="Jawa Tengah" {{ $daerah->provinsi == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                <option value="DI Yogyakarta" {{ $daerah->provinsi == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                <option value="Jawa Timur" {{ $daerah->provinsi == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                <option value="Banten" {{ $daerah->provinsi == 'Banten' ? 'selected' : '' }}>Banten</option>
            </select>
        </div>

        <div>
            <label for="nama_daerah" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten / Kota</label>
            <select id="nama_daerah" name="nama_daerah" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="{{ $daerah->nama_daerah }}">{{ $daerah->nama_daerah }}</option>
            </select>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <a href="{{ route('admin.daerah.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                Update Data
            </button>
        </div>
    </form>
</div>

<script>
const cities = {
    'DKI Jakarta': ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur', 'Kepulauan Seribu'],
    'Jawa Barat': ['Bandung', 'Bekasi', 'Bogor', 'Cirebon', 'Depok', 'Sukabumi', 'Tasikmalaya', 'Banjar', 'Cimahi', 'Karawang', 'Indramayu', 'Subang', 'Purwakarta', 'Cianjur', 'Garut', 'Sumedang', 'Majalengka', 'Kuningan'],
    'Jawa Tengah': ['Semarang', 'Surakarta', 'Magelang', 'Salatiga', 'Pekalongan', 'Tegal', 'Cilacap', 'Purwokerto', 'Kudus', 'Klaten', 'Boyolali', 'Kendal', 'Demak', 'Pati', 'Rembang', 'Blora', 'Grobogan'],
    'DI Yogyakarta': ['Yogyakarta', 'Sleman', 'Bantul', 'Kulon Progo', 'Gunung Kidul'],
    'Jawa Timur': ['Surabaya', 'Malang', 'Kediri', 'Blitar', 'Madiun', 'Mojokerto', 'Pasuruan', 'Probolinggo', 'Batu', 'Sidoarjo', 'Gresik', 'Jombang', 'Nganjuk', 'Tulungagung', 'Lumajang', 'Jember', 'Banyuwangi', 'Situbondo', 'Bondowoso'],
    'Banten': ['Tangerang', 'Tangerang Selatan', 'Serang', 'Cilegon', 'Pandeglang', 'Lebak']
};

const currentCity = '{{ $daerah->nama_daerah }}';

document.getElementById('provinsi').addEventListener('change', function() {
    const provinsi = this.value;
    const citySelect = document.getElementById('nama_daerah');
    
    citySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
    
    if (provinsi && cities[provinsi]) {
        cities[provinsi].forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            if (city === currentCity) option.selected = true;
            citySelect.appendChild(option);
        });
    }
});

// Trigger on load
document.getElementById('provinsi').dispatchEvent(new Event('change'));
</script>
@endsection
