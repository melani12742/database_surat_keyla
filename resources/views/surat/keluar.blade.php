@extends('layouts.app')

@section('title', 'Surat Keluar')

@section('content')
    <div class="topbar">
        <div class="greeting">
            <h1>📤 Surat Keluar</h1>
            <p>Daftar semua surat yang keluar dari SMK 8</p>
        </div>
        <div class="topbar-actions">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('surat.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Surat Keluar
                </a>
            @endif
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">📤 Total Surat Keluar</div>
            <div class="stat-value">{{ count($surats) }}</div>
            <div class="stat-change negative"><i class="fas fa-paper-plane"></i> Surat keluar</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>📋 Daftar Surat Keluar</h3>
        </div>

        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Penerima</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                        @if(Auth::user()->isAdmin())
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $key => $surat)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>{{ $surat->nomor_surat }}</strong></td>
                            <td>{{ $surat->pengirim_penerima }}</td>
                            <td>{{ Str::limit($surat->perihal, 30) }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
                            @if(Auth::user()->isAdmin())
                                <td>
                                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                        <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('surat.destroy', $surat->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 6 : 5 }}"
                                style="text-align:center;padding:40px;color:#475569;">
                                <i class="fas fa-inbox" style="font-size:40px;display:block;margin-bottom:10px;"></i>
                                Belum ada surat keluar
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection