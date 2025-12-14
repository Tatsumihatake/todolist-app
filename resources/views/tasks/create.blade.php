<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                
                <a href="{{ route('tasks.index') }}" class="text-decoration-none mb-4 d-inline-flex align-items-center fw-bold" style="color: #8b5cf6;">
                    <i class="bi bi-arrow-left-circle-fill fs-4 me-2"></i> Kembali ke Dashboard
                </a>

                <div class="custom-card p-4 p-md-5">
                    <div class="text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" 
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #fdf2f8 0%, #f3e8ff 100%);">
                            <i class="bi bi-plus-lg fs-1" style="color: #d946ef;"></i>
                        </div>
                        <h3 class="fw-bolder">Tugas Baru</h3>
                        <p class="text-muted small">Apa targetmu hari ini?</p>
                    </div>

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase ms-1">Judul Tugas</label>
                            <input type="text" name="title" class="form-control form-control-lg bg-light border-0 py-3 px-3" placeholder="Contoh: Meeting Desain..." required style="border-radius: 12px;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase ms-1">Deskripsi</label>
                            <textarea name="description" class="form-control bg-light border-0 py-3 px-3" rows="4" placeholder="Detail tugas..." style="border-radius: 12px;"></textarea>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-custom py-3 fs-6 fw-bold rounded-4">
                                Simpan Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>