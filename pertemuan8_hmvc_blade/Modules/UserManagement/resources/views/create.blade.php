@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="mb-4">
                <a href="{{ route('admin.users.index') }}" class="small text-decoration-none text-muted">
                    <i class="bi bi-arrow-left"></i> Kembali ke Kelola User
                </a>
                <h4 class="mt-2 mb-1">Tambah User Baru</h4>
                <p class="text-muted small mb-0">Isi form di bawah untuk mendaftarkan user baru.</p>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        @include('usermanagement::partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection