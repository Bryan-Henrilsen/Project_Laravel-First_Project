<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Kuliah</title>
  @vite(['resources/js/app.js'])
</head>
<body class="bg-light">

  <div class="container py-5">
    <!-- Judul dan tombol -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold text-primary">Tambah Mata Kuliah</h2>
      <a href="{{ route('matakuliah.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Create Mata Kuliah
      </a>
    </div>

    <!-- Kartu Tabel -->
    <div class="card shadow">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Jurusan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($matakuliah as $index => $matkul)
              <tr>
                <td>{{ $matkul['id'] }}</td>
                <td>{{ $matkul['kode_mk'] }}</td>
                <td>{{ $matkul['nama_mk'] }}</td>
                <td>{{ $matkul['jurusan'] }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('matakuliah.edit', $matkul->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('matakuliah.destroy', $matkul->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center text-muted">Belum ada data mata kuliah</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

</body>
</html>
