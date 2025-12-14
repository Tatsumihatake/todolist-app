<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                
                <a href="{{ route('tasks.index') }}" class="text-decoration-none text-muted mb-4 d-inline-flex align-items-center fw-bold">
                    <i class="bi bi-arrow-left-circle-fill fs-4 me-2" style="color: #8b5cf6;"></i> Batal Edit
                </a>

                <div class="custom-card">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                            style="width: 70px; height: 70px; background: linear-gradient(135deg, #f59e0b20 0%, #d9770620 100%); color: #d97706;">
                            <i class="bi bi-pencil-fill fs-3"></i>
                        </div>
                        <h3 class="fw-bold">Edit Tugas</h3>
                        <p class="text-muted small">Update progres tugasmu.</p>
                    </div>

                    <form id="updateForm" action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Judul Tugas</label>
                            <input type="text" name="title" class="form-control form-control-lg bg-light border-0" value="{{ $task->title }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Status</label>
                            <select name="status" class="form-select form-select-lg bg-light border-0">
                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>⏳ Masih Proses</option>
                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>✅ Sudah Selesai</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Deskripsi</label>
                            <textarea name="description" class="form-control bg-light border-0" rows="4">{{ $task->description }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="button" class="btn btn-primary py-3 fs-6 fw-bold rounded-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal" style="border: none;">
                                Update Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-3">
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" 
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #fdf4ff 0%, #f3e8ff 100%);">
                            <i class="bi bi-save2-fill fs-1" style="color: #d946ef;"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Simpan Perubahan?</h5>
                    <p class="text-muted mb-4">Pastikan data yang kamu ubah sudah benar ya!</p>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light fw-bold rounded-pill px-4 py-2" data-bs-dismiss="modal">Cek Lagi</button>
                        
                        <button type="button" class="btn btn-primary fw-bold rounded-pill px-4 py-2" onclick="document.getElementById('updateForm').submit()" style="border: none;">Ya, Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>