@extends('layouts.app')

@section('title', 'Edit Surat')

@section('content')
    <div class="topbar">
        <div class="greeting">
            <h1>✏️ Edit Data Surat</h1>
            <p>Perbarui data surat yang sudah ada</p>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('surat.update', $surat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nomor_surat">Nomor Surat</label>
                <input type="text" name="nomor_surat" id="nomor_surat" placeholder="Contoh: 001/SMK8/VII/2026"
                    value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                @error('nomor_surat')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jenis_surat">Jenis Surat</label>
                <select name="jenis_surat" id="jenis_surat" required>
                    <option value="Masuk" {{ $surat->jenis_surat == 'Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                    <option value="Keluar" {{ $surat->jenis_surat == 'Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                </select>
                @error('jenis_surat')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="pengirim_penerima">Pengirim / Penerima Tujuan</label>
                <input type="text" name="pengirim_penerima" id="pengirim_penerima" placeholder="Nama Instansi / Perorangan"
                    value="{{ old('pengirim_penerima', $surat->pengirim_penerima) }}" required>
                @error('pengirim_penerima')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="perihal">Perihal</label>
                <textarea name="perihal" id="perihal" placeholder="Isi ringkas perihal surat..."
                    required>{{ old('perihal', $surat->perihal) }}</textarea>
                @error('perihal')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_surat">Tanggal Surat</label>
                <input type="date" name="tanggal_surat" id="tanggal_surat"
                    value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required>
                @error('tanggal_surat')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Perbarui Data
                </button>
                <a href="{{ route('surat.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal dan Kembali
                </a>
            </div>
        </form>
    </div>
@endsection