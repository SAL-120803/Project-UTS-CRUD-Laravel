<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar mahasiswa dengan pencarian dan pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mahasiswas = Mahasiswa::when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('nim', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    /**
     * Tampilkan form tambah data mahasiswa.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Simpan data mahasiswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nim'   => 'required|string|max:50|unique:mahasiswas,nim',
            'email' => 'required|email|unique:mahasiswas,email',
        ]);

        Mahasiswa::create([
            'nama'  => $request->nama,
            'nim'   => $request->nim,
            'email' => $request->email,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit mahasiswa.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update data mahasiswa.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nim'   => 'required|string|max:50|unique:mahasiswas,nim,' . $mahasiswa->id,
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
        ]);

        $mahasiswa->update([
            'nama'  => $request->nama,
            'nim'   => $request->nim,
            'email' => $request->email,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Hapus data mahasiswa.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Export data mahasiswa ke PDF.
     */
    public function exportPdf()
    {
        $mahasiswas = Mahasiswa::all();

        $pdf = Pdf::loadView('mahasiswa.pdf', compact('mahasiswas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('data-mahasiswa.pdf');
    }

    /**
     * Export data mahasiswa ke Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'data-mahasiswa.xlsx');
    }
}