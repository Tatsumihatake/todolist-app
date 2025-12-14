<x-app-layout>
    <div class="container py-4">
        
        <div class="row mb-5 align-items-center">
            <div class="col-md-7">
                <h1 class="fw-bolder mb-1" style="background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-block;">
                    Dashboard Tugas
                </h1>
                <p class="text-muted fw-medium">Kelola produktivitas harianmu dengan gaya.</p>
            </div>
            <div class="col-md-5 text-md-end">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary py-3 px-4 rounded-pill fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="border: none; color: white;">
                    <i class="bi bi-plus-lg"></i> Tambah Tugas Baru
                </a>
            </div>
        </div>

        <div class="row mb-5 g-4">
            <div class="col-md-4">
                <div class="custom-card border-0 d-flex align-items-center p-4 h-100 shadow-sm" style="background: white; border-radius: 20px;">
                    <div class="me-3 p-3 rounded-circle text-white shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #8b5cf6;">
                        <i class="bi bi-layers-fill fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Total Tugas</p>
                        <h2 class="fw-bolder mb-0 text-dark">{{ $tasks->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-card border-0 d-flex align-items-center p-4 h-100 shadow-sm" style="background: white; border-radius: 20px;">
                    <div class="me-3 p-3 rounded-circle text-white shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #ec4899;">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Dalam Proses</p>
                        <h2 class="fw-bolder mb-0 text-dark">{{ $tasks->where('status', 'pending')->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="custom-card border-0 d-flex align-items-center p-4 h-100 shadow-sm" style="background: white; border-radius: 20px;">
                    <div class="me-3 p-3 rounded-circle text-white shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #10b981;">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Selesai</p>
                        <h2 class="fw-bolder mb-0 text-dark">{{ $tasks->where('status', 'completed')->count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="custom-card p-0 overflow-hidden bg-white shadow-sm" style="border-radius: 20px;">
            @if(session('success'))
                <div class="alert alert-success m-4 border-0 rounded-3 d-flex align-items-center gap-2" role="alert" style="background-color: #d1fae5; color: #065f46;">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="py-4 ps-5 text-uppercase small fw-bold text-secondary">Judul Tugas</th>
                            <th class="py-4 text-uppercase small fw-bold text-secondary">Status</th>
                            <th class="py-4 text-uppercase small fw-bold text-secondary">Deskripsi</th>
                            <th class="py-4 pe-5 text-end text-uppercase small fw-bold text-secondary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="ps-5 py-4 fw-bold text-dark">{{ $task->title }}</td>
                            <td class="py-4">
                                @if($task->status == 'completed')
                                    <span class="badge rounded-pill px-3 py-2 text-success bg-success bg-opacity-10 border border-success border-opacity-25"><i class="bi bi-check2 me-1"></i> Selesai</span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2 text-warning bg-warning bg-opacity-10 border border-warning border-opacity-25"><i class="bi bi-clock me-1"></i> Proses</span>
                                @endif
                            </td>
                            <td class="py-4 text-muted small text-truncate" style="max-width: 250px;">{{ $task->description ?? '-' }}</td>
                            <td class="pe-5 py-4 text-end">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-light btn-sm rounded-circle text-primary shadow-sm me-1" style="width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                
                                <button type="button" class="btn btn-light btn-sm rounded-circle text-danger shadow-sm" style="width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                                <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4 p-3">
                                            <div class="modal-body text-center">
                                                <div class="mb-3">
                                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: #fee2e2;">
                                                        <i class="bi bi-trash-fill text-danger fs-1"></i>
                                                    </div>
                                                </div>
                                                <h5 class="fw-bold mb-2">Hapus Tugas Ini?</h5>
                                                <p class="text-muted mb-4">Kamu yakin ingin menghapus "<b>{{ $task->title }}</b>"?<br>Tindakan ini tidak bisa dibatalkan.</p>
                                                
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-light fw-bold rounded-pill px-4 py-2" data-bs-dismiss="modal">Batal</button>
                                                    
                                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger fw-bold rounded-pill px-4 py-2">Ya, Hapus!</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="opacity-50 mb-3" style="color: #ec4899;"><i class="bi bi-clipboard2-plus fs-1"></i></div>
                                <h6 class="fw-bold text-dark">Belum ada tugas</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>