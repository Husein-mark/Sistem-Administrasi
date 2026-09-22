<x-layouts.app title="Master Jenis Administrasi — SIAKAD Online">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-block bg-blue-50 text-[#1B6CF2] border border-blue-200 text-xs font-bold uppercase px-3 py-1 rounded-lg mb-2">
                Konfigurasi Layanan
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                Master Jenis Layanan Administrasi
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Kelola parameter jenis surat, kode arsip, durasi estimasi pengerjaan, dan ketentuan dokumen.
            </p>
        </div>

        <div>
            <a href="{{ route('administration-types.create') }}" class="bg-[#1B6CF2] hover:bg-[#1455C0] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-sm transition-all inline-block">
                Tambah Jenis Layanan
            </a>
        </div>
    </div>

    <div class="siakad-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        @if($types->isEmpty())
            <div class="text-center py-12 text-xs text-slate-500">
                Belum ada jenis layanan administrasi yang terdaftar.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                            <th class="py-3 px-3">Kode</th>
                            <th class="py-3 px-3">Nama Layanan Surat</th>
                            <th class="py-3 px-3">Estimasi</th>
                            <th class="py-3 px-3">Total Pengajuan</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($types as $type)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-3 font-bold text-[#0F172A]">
                                    <span class="bg-slate-100 text-slate-700 px-2.5 py-1 rounded-lg border border-slate-200 font-mono">{{ $type->kode_layanan }}</span>
                                </td>
                                <td class="py-3 px-3">
                                    <div class="font-bold text-[#0F172A] text-sm">{{ $type->nama_layanan }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5 max-w-md">{{ $type->deskripsi }}</div>
                                </td>
                                <td class="py-3 px-3 font-semibold text-slate-700">
                                    {{ $type->estimasi_hari }} Hari Kerja
                                </td>
                                <td class="py-3 px-3">
                                    <span class="bg-blue-50 text-[#1B6CF2] border border-blue-200 font-bold text-xs px-2.5 py-0.5 rounded-full">
                                        {{ $type->submissions_count }}
                                    </span>
                                </td>
                                <td class="py-3 px-3">
                                    @if($type->is_active)
                                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 text-[10px] font-bold uppercase px-2.5 py-0.5 rounded-full">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="{{ route('administration-types.edit', $type) }}" class="bg-slate-100 hover:bg-[#1B6CF2] hover:text-white text-slate-700 font-bold px-3 py-1 rounded-lg text-[11px] transition-colors">
                                            Ubah
                                        </a>

                                        @if($type->submissions_count === 0)
                                            <form method="POST" action="{{ route('administration-types.destroy', $type) }}" onsubmit="return confirmDelete(event, 'Hapus jenis layanan ini?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-700 font-bold px-3 py-1 rounded-lg text-[11px] transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.app>
