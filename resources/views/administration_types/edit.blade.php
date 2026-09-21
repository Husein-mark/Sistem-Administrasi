<x-layouts.app title="Ubah Layanan — {{ $administrationType->nama_layanan }}">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('administration-types.index') }}" class="text-xs font-bold text-[#1B6CF2] hover:underline uppercase tracking-wider block mb-2">
                Kembali ke Daftar Layanan
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                Perbarui Jenis Layanan
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Perbarui detail dan konfigurasi layanan administrasi surat yang sudah terdaftar.
            </p>
        </div>

        <div class="siakad-card bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
            <form method="POST" action="{{ route('administration-types.update', $administrationType) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="nama_layanan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Layanan Surat <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $administrationType->nama_layanan) }}" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="kode_layanan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kode Surat / Singkatan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="kode_layanan" name="kode_layanan" value="{{ old('kode_layanan', $administrationType->kode_layanan) }}" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 uppercase focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>

                    <div>
                        <label for="estimasi_hari" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Estimasi Waktu Selesai (Hari) <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" id="estimasi_hari" name="estimasi_hari" value="{{ old('estimasi_hari', $administrationType->estimasi_hari) }}" min="1" max="60" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Deskripsi Layanan
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">{{ old('deskripsi', $administrationType->deskripsi) }}</textarea>
                </div>

                <div>
                    <label for="persyaratan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Persyaratan Dokumen yang Wajib Dibawa / Diunggah
                    </label>
                    <textarea id="persyaratan" name="persyaratan" rows="3"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1B6CF2] focus:border-[#1B6CF2]">{{ old('persyaratan', $administrationType->persyaratan) }}</textarea>
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $administrationType->is_active) ? 'checked' : '' }} class="rounded border-slate-300 text-[#1B6CF2] focus:ring-[#1B6CF2]">
                        Aktifkan layanan ini agar dapat dipilih oleh siswa
                    </label>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('administration-types.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-7 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all">
                        Perbarui Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
