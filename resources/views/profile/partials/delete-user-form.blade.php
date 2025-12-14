<section>
    <p class="text-muted small mb-4">
        Setelah akun dihapus, semua data dan tugas akan hilang permanen. Harap unduh data penting sebelum melanjutkan.
    </p>

    <button class="btn btn-danger px-4 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        Hapus Akun Saya
    </button>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content border-0 shadow-lg rounded-4 p-3">
                @csrf
                @method('delete')

                <div class="modal-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #fee2e2;">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-3"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-danger">Yakin Hapus Akun?</h5>
                    <p class="text-muted small">Masukkan password Anda untuk konfirmasi penghapusan permanen.</p>

                    <div class="mt-3">
                        <input type="password" name="password" class="form-control text-center" placeholder="Password Anda" required>
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-danger small" />
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Ya, Hapus Permanen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>