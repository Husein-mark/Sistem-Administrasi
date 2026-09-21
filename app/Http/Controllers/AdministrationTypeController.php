<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdministrationTypeRequest;
use App\Http\Requests\UpdateAdministrationTypeRequest;
use App\Models\AdministrationType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdministrationTypeController extends Controller
{
    public function index(): View
    {
        $types = AdministrationType::withCount('submissions')
            ->orderBy('nama_layanan', 'asc')
            ->get();

        return view('administration_types.index', compact('types'));
    }

    public function create(): View
    {
        return view('administration_types.create');
    }

    public function store(StoreAdministrationTypeRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active', true);

        AdministrationType::create($validated);

        return redirect()->route('administration-types.index')
            ->with('status', 'Jenis administrasi berhasil ditambahkan.');
    }

    public function edit(AdministrationType $administrationType): View
    {
        return view('administration_types.edit', compact('administrationType'));
    }

    public function update(UpdateAdministrationTypeRequest $request, AdministrationType $administrationType): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        $administrationType->update($validated);

        return redirect()->route('administration-types.index')
            ->with('status', 'Jenis administrasi berhasil diperbarui.');
    }

    public function destroy(AdministrationType $administrationType): RedirectResponse
    {
        if ($administrationType->submissions()->exists()) {
            return back()->with('error', 'Jenis administrasi tidak dapat dihapus karena masih digunakan pada data pengajuan.');
        }

        $administrationType->delete();

        return redirect()->route('administration-types.index')
            ->with('status', 'Jenis administrasi berhasil dihapus.');
    }
}
