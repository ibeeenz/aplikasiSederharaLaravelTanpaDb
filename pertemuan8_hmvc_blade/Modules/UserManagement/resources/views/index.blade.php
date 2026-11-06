@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="mb-1">Kelola User</h4>
            <p class="text-muted mb-0">Daftar seluruh akun pengguna yang terdaftar pada sistem.</p>
        </div>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah User
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3">
                <div class="col-md-6 col-lg-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" name="search" value="{{ $search }}"
                            placeholder="Cari nama atau email...">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <select class="form-select" name="role" onchange="this.form.submit()">
                        <option value="">Semua Role</option>
                        @foreach ($roles as $r)
                            <option value="{{ $r->value }}" {{ $selectedRole === $r ? 'selected' : '' }}>
                                {{ $r->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-lg-2 d-flex gap-2">
                    <button type="submit" class="btn btn-secondary w-100">Filter</button>
                    @if ($search !== '' || $selectedRole)
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terdaftar</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="ps-3 fw-semibold">
                                    {{ $user->name }}
                                    @if ($user->is(auth()->user()))
                                        <span class="badge text-bg-light border ms-1">Anda</span>
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->isAdmin() ? 'text-bg-primary' : 'text-bg-secondary' }}">
                                        {{ $user->role->label() }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $user->created_at->format('d M Y H:i') }}</td>
                                <td class="text-end pe-3">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-secondary"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @unless ($user->is(auth()->user()))
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                                data-confirm="Hapus user '{{ $user->name }}'?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <p class="mt-2 mb-0">Tidak ada user ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection