@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
    <div class="topbar">
        <div class="greeting">
            <h1>📜 Log Aktivitas</h1>
            <p>Semua aktivitas yang dilakukan oleh admin</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">📜 Total Aktivitas</div>
            <div class="stat-value">{{ count($logs) }}</div>
            <div class="stat-change positive"><i class="fas fa-clock"></i> Tercatat</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>📋 Daftar Aktivitas</h3>
        </div>

        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $key => $log)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <strong>{{ $log->user->name ?? 'User Dihapus' }}</strong>
                                <br>
                                <span style="font-size:12px;color:#475569;">{{ $log->user->email ?? '' }}</span>
                            </td>
                            <td>
                                @if($log->action == 'create')
                                    <span
                                        style="background:#064e3b;color:#34d399;padding:4px 12px;border-radius:20px;font-size:12px;">
                                        <i class="fas fa-plus"></i> Tambah
                                    </span>
                                @elseif($log->action == 'update')
                                    <span
                                        style="background:#4c3a0e;color:#fbbf24;padding:4px 12px;border-radius:20px;font-size:12px;">
                                        <i class="fas fa-edit"></i> Edit
                                    </span>
                                @elseif($log->action == 'delete')
                                    <span
                                        style="background:#4c1d1d;color:#f87171;padding:4px 12px;border-radius:20px;font-size:12px;">
                                        <i class="fas fa-trash"></i> Hapus
                                    </span>
                                @else
                                    <span>{{ $log->action }}</span>
                                @endif
                            </td>
                            <td>{{ $log->description }}</td>
                            <td style="font-size:12px;color:#94a3b8;">
                                {{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i:s') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:40px;color:#475569;">
                                <i class="fas fa-history" style="font-size:40px;display:block;margin-bottom:10px;"></i>
                                Belum ada aktivitas yang tercatat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection