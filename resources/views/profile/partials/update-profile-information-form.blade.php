<section>
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label fw-bold small text-uppercase text-muted">Nama Lengkap</label>
            <input type="text" name="name" class="form-control form-control-lg bg-light border-0" value="{{ old('name', $user->name) }}" required>
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-uppercase text-muted">Email</label>
            <input type="email" name="email" class="form-control form-control-lg bg-light border-0" value="{{ old('email', $user->email) }}" required>
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('email')" />
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold" style="background: var(--gradient-main); border:none;">Simpan Profil</button>
            @if (session('status') === 'profile-updated')
                <p class="text-success small fw-bold mb-0"><i class="bi bi-check-circle"></i> Tersimpan!</p>
            @endif
        </div>
    </form>
</section>