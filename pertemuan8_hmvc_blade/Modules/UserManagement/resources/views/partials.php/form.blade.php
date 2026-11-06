<div class="mb-3">
    <label for="name" class="form-label">Nama Lengkap</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required autofocus>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
        @foreach ($roles as $r)
            <option value="{{ $r->value }}" {{ old('role', $user->role->value ?? '') === $r->value ? 'selected' : '' }}>
                {{ $r->label() }}
            </option>
        @endforeach
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '' }}</label>
    <div class="input-group has-validation">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
        <button type="button" class="btn btn-outline-secondary" data-toggle-password="password" aria-label="Tampilkan password">
            <i class="bi bi-eye"></i>
        </button>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-4">
    <label for="password_confirmation" class="form-label">Ulangi Password</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-light">Batal</a>
</div>