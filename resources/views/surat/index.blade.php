@extends('layouts.app')

@section('title', 'Semua Surat')

@section('content')
    <div class="card">
        <div class="card-header">📊 Semua Data Surat</div>
        <div style="margin-bottom:15px;">
            <a href="{{ route('surat.create') }}" class="btn btn-success">➕ Tambah Surat</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Jenis</th>
                    <th>Pengirim/Penerima</th>
                    <th>Perihal</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $key => $surat)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $surat->nomor_surat }}</td>
                        <td>
                            <span
                                style="padding:3px 10px;border-radius:10px;background:{{ $surat->jenis_surat == 'Masuk' ? '#3498db' : '#e67e22' }};color:white;font-size:12px;">
                                {{ $surat->jenis_surat }}
                            </span>
                        </td>
                        <td>{{ $surat->pengirim_penerima }}</td>
                        <td>{{ Str::limit($surat->perihal, 30) }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:30px;">Belum ada data surat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection