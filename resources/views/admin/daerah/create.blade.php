@extends('layouts.admin')

@section('title', 'Tambah Data Alternatif')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Data Alternatif Baru</h1>

    <form action="{{ route('admin.daerah.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
            <select id="provinsi" name="provinsi" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="">Pilih Provinsi</option>
                <option value="DKI Jakarta">DKI Jakarta</option>
                <option value="Jawa Barat">Jawa Barat</option>
                <option value="Jawa Tengah">Jawa Tengah</option>
                <option value="DI Yogyakarta">DI Yogyakarta</option>
                <option value="Jawa Timur">Jawa Timur</option>
                <option value="Banten">Banten</option>
            </select>
        </div>

        <div>
            <label for="nama_daerah" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten / Kota</label>
            <select id="nama_daerah" name="nama_daerah" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="">Pilih provinsi terlebih dahulu</option>
            </select>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <a href="{{ route('admin.daerah.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-lg text-white font-medium bg-emerald-600 hover:bg-emerald-700 transition duration-150 ease-in-out">
                Simpan Data
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

document.getElementById('provinsi').addEventListener('change', function() {
    const provinsi = this.value;
    const citySelect = document.getElementById('nama_daerah');
    
    citySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
    
    if (provinsi && cities[provinsi]) {
        cities[provinsi].forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });
    }
});
</script>
@endsection
