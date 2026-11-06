@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="mb-4">
                <a href="{{ route('admin.users.index') }}" class="small text-decoration-none text-muted">
                    <i class="bi bi-arrow-left"></i> Kembali ke Kelola User
                </a>
                <h4 class="mt-2 mb-1">Edit User: {{ $user->name }}</h4>
                <p class="text-muted small mb-0">Perbarui informasi akun pengguna.</p>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        @include('usermanagement::partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection