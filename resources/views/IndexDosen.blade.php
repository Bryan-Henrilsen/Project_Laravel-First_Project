<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dosen</title>
  @vite(['resources/js/app.js'])
</head>
<body class="bg-light">

  <div class="container py-5">
    <!-- Judul dan tombol -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold text-primary">Daftar Dosen</h2>
      <a href="{{ route('dosen.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Create Dosen
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
                <th>NIP</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Pendidikan Terakhir</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($dosens as $index => $dosen)
              <tr>
                <td>{{ $dosen['id'] }}</td>
                <td>{{ $dosen['nip'] }}</td>
                <td>{{ $dosen['nama'] }}</td>
                <td>{{ $dosen['jurusan'] }}</td>
                <td>{{ $dosen['pendidikanTerakhir'] }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center text-muted">Belum ada data Dosen.</td>
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
