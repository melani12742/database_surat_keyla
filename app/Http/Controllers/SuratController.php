<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // Tampilkan semua surat (untuk admin)
    public function index()
    {
        $surats = Surat::all();
        return view('surat.index', compact('surats'));
    }

    // Tampilkan surat masuk
    public function suratMasuk()
    {
        $surats = Surat::where('jenis_surat', 'Masuk')->get();
        return view('surat.masuk', compact('surats'));
    }

    // Tampilkan surat keluar
    public function suratKeluar()
    {
        $surats = Surat::where('jenis_surat', 'Keluar')->get();
        return view('surat.keluar', compact('surats'));
    }

    // Form tambah surat
    public function create()
    {
        return view('surat.create');
    }

    // Simpan surat baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'jenis_surat' => 'required|in:Masuk,Keluar',
            'pengirim_penerima' => 'required',
            'perihal' => 'required',
            'tanggal_surat' => 'required|date'
        ]);

        $surat = Surat::create($request->all());

        // Catat aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'surat_id' => $surat->id,
            'description' => 'Menambahkan surat baru: ' . $surat->nomor_surat
        ]);

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil ditambahkan!');
    }

    // Form edit surat
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.edit', compact('surat'));
    }

    // Update surat
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'jenis_surat' => 'required|in:Masuk,Keluar',
            'pengirim_penerima' => 'required',
            'perihal' => 'required',
            'tanggal_surat' => 'required|date'
        ]);

        $surat = Surat::findOrFail($id);
        $surat->update($request->all());

        // Catat aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'surat_id' => $surat->id,
            'description' => 'Mengupdate surat: ' . $surat->nomor_surat
        ]);

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil diupdate!');
    }

    // Hapus surat
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $nomorSurat = $surat->nomor_surat;
        $surat->delete();

        // Catat aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'surat_id' => $id,
            'description' => 'Menghapus surat: ' . $nomorSurat
        ]);

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil dihapus!');
    }

    // Tampilkan log aktivitas (hanya admin)
    public function activityLog()
    {
        $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->get();
        return view('surat.activity_log', compact('logs'));
    }
}