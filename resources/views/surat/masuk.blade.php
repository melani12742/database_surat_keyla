@extends('layouts.app')

@section('title', 'Surat Masuk')

@section('content')
    <div class="card">
        <div class="card-header">📥 Daftar Surat Masuk <span
                style="font-size:14px;font-weight:normal;margin-left:10px;">Total: {{ count($surats) }}</span></div>

        @if(Auth::user()->isAdmin())
            <div style="margin-bottom:15px;">
                <a href="{{ route('surat.create') }}" class="btn btn-success">➕ Tambah Surat Masuk</a>
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Pengirim</th>
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
                        <td>{{ $surat->nomor_surat }}</td>
                        <td>{{ $surat->pengirim_penerima }}</td>
                        <td>{{ Str::limit($surat->perihal, 30) }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
                        @if(Auth::user()->isAdmin())
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-warning">✏️ Edit</a>
                                    <form action="{{ route('surat.destroy', $surat->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Auth::user()->isAdmin() ? 6 : 5 }}" style="text-align:center;padding:30px;">Belum ada
                            surat masuk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection