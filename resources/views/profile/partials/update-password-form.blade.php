<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label fw-bold small text-uppercase text-muted">Password Saat Ini</label>
            <input type="password" name="current_password" class="form-control bg-light border-0" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-uppercase text-muted">Password Baru</label>
            <input type="password" name="password" class="form-control bg-light border-0" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger small" />
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-uppercase text-muted">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control bg-light border-0" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger small" />
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold" style="background: var(--gradient-main); border:none;">Update Password</button>
            @if (session('status') === 'password-updated')
                <p class="text-success small fw-bold mb-0"><i class="bi bi-check-circle"></i> Password Berubah!</p>
            @endif
        </div>
    </form>
</section>