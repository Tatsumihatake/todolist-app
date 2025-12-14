<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <a href="{{ route('tasks.index') }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: #8b5cf6;">
                        <i class="bi bi-arrow-left-circle-fill fs-4 me-2"></i> Kembali ke Dashboard
                    </a>
                    <span class="text-muted small">Pengaturan Akun</span>
                </div>

                <div class="custom-card mb-4 p-4 p-md-5 bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm mb-3" 
                                style="width: 120px; height: 120px; background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%); color: white; font-size: 2.5rem; font-weight: bold;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted small">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="col-md-8 ps-md-5 border-start-md">
                            <h4 class="fw-bold mb-4" style="color: #4a044e;">Edit Profil</h4>
                            <form method="post" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control form-control-lg bg-light border-0" value="{{ old('name', $user->name) }}" required style="border-radius: 10px;">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg bg-light border-0" value="{{ old('email', $user->email) }}" required style="border-radius: 10px;">
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-bold border-0 shadow-sm" style="background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);">Simpan Profil</button>
                                    @if (session('status') === 'profile-updated')
                                        <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill"></i> Tersimpan!</span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-7">
                        <div class="custom-card p-4 h-100 bg-white position-relative">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle p-2 me-3" style="background: #f3e8ff; color: #8b5cf6;">
                                    <i class="bi bi-shield-lock-fill fs-4"></i>
                                </div>
                                <h5 class="fw-bold mb-0">Ganti Password</h5>
                            </div>
                            
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')
                                
                                <div class="mb-3 position-relative">
                                    <input type="password" name="current_password" id="currentPass" class="form-control bg-light border-0" placeholder="Password Saat Ini" required>
                                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;" onclick="togglePass('currentPass', this)"></i>
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-danger small mt-1" />
                                </div>

                                <div class="mb-3 position-relative">
                                    <input type="password" name="password" id="newPass" class="form-control bg-light border-0" placeholder="Password Baru (Min. 8 Karakter)" required>
                                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;" onclick="togglePass('newPass', this)"></i>
                                </div>

                                <div class="mb-3 position-relative">
                                    <input type="password" name="password_confirmation" id="confirmPass" class="form-control bg-light border-0" placeholder="Ulangi Password Baru" required onkeyup="checkMatchProfile()">
                                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;" onclick="togglePass('confirmPass', this)"></i>
                                </div>
                                
                                <div id="profileMatchMsg" class="small fw-bold mb-3" style="display: none;"></div>

                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold w-100">Update Password</button>
                                
                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success mt-2 small p-2"><i class="bi bi-check-circle"></i> Password berhasil diubah!</div>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="custom-card p-4 h-100 border-danger border-opacity-25" style="background: #fff5f5;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle p-2 me-3" style="background: #fee2e2; color: #dc2626;">
                                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                                </div>
                                <h5 class="fw-bold mb-0 text-danger">Zona Bahaya</h5>
                            </div>
                            <p class="text-muted small mb-4">Ingin menghapus akun secara permanen? Data tidak bisa dikembalikan.</p>
                            
                            <button class="btn btn-danger w-100 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Hapus Akun Saya</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePass(id, icon) {
            let input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }

        function checkMatchProfile() {
            let pass = document.getElementById('newPass').value;
            let confirm = document.getElementById('confirmPass').value;
            let msg = document.getElementById('profileMatchMsg');

            if(confirm.length > 0){
                msg.style.display = 'block';
                if(pass === confirm){
                    msg.style.color = 'green';
                    msg.innerHTML = '✅ Password Cocok';
                } else {
                    msg.style.color = 'red';
                    msg.innerHTML = '❌ Belum Cocok';
                }
            } else {
                msg.style.display = 'none';
            }
        }
    </script>
    
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content border-0 shadow-lg rounded-4 p-4">
                @csrf
                @method('delete')
                <div class="text-center">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: #fee2e2;">
                        <i class="bi bi-trash3-fill text-danger fs-3"></i>
                    </div>
                    <h5 class="fw-bold text-danger mb-2">Yakin Hapus Akun?</h5>
                    <p class="text-muted small mb-4">Masukkan password Anda untuk konfirmasi.</p>
                    
                    <input type="password" name="password" class="form-control bg-light border-0 text-center mb-3" placeholder="Password Anda" required>
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="text-danger small" />
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Ya, Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>