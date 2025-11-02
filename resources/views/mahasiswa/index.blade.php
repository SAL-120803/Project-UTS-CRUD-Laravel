<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">📋 Daftar Mahasiswa</h1>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">
                + Tambah Mahasiswa
            </a>
        </div>

        <!-- 🔍 Search bar -->
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2"
                   placeholder="Cari nama, NIM, atau email..."
                   value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <!-- 📤 Tombol Export & Import -->
        <div class="mb-4 d-flex align-items-center gap-2">
            <a href="{{ route('mahasiswa.exportPdf') }}" class="btn btn-danger">
                📄 Export PDF
            </a>
            <a href="{{ route('mahasiswa.exportExcel') }}" class="btn btn-success">
                📊 Export Excel
            </a>
        </div>

        <!-- ✅ Tabel Data Mahasiswa -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $m)
                            <tr>
                                <td>{{ $m->nama }}</td>
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->email }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn btn-warning btn-sm">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data mahasiswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- 🔄 Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $mahasiswas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>