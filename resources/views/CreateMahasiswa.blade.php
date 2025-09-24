<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Mahasiswa</title>
  @vite(['resources/js/app.js'])
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Create Mahasiswa</h2>
      </div>
      <div class="card-body">
        @php
        $isEdit = isset($mahasiswa);
        @endphp

        <form action="{{ $isEdit ? route('mahasiswa.update', $mahasiswa->id) : route('mahasiswa.store') }}" method="POST">
          @csrf
          @if($isEdit) 
            @method('PUT')
          @endif

          <div class="mb-3">
            <label for="NIM" class="form-label">NIM</label>
            <input type="text" name="NIM" id="NIM" class="form-control" placeholder="Masukkan NIM"
                    value="{{ old('NIM', $isEdit ? $mahasiswa->NIM : '') }}">
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap"
                    value="{{ old('name', $isEdit ? $mahasiswa->name : '') }}">
          </div>

          <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir"
                    value="{{ old('tempat_lahir', $isEdit ? $mahasiswa->tempat_lahir : '') }}">
          </div>

          <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                    value="{{ old('tanggal_lahir', $isEdit ? $mahasiswa->tanggal_lahir : '') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Jurusan</label>
            @foreach(['Bisnis Digital','Kewirausahaan','Sistem dan Teknologi Informasi'] as $jurusan)
            <div class="form-check">
                <input type="radio" name="jurusan" value="{{ $jurusan }}" class="form-check-input"
                    {{ ($isEdit && $mahasiswa->jurusan == $jurusan) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $jurusan }}</label>
            </div>
            @endforeach
          </div>

          <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="number" name="angkatan" id="angkatan" class="form-control" placeholder="Masukkan angkatan"
                    value="{{ old('angkatan', $isEdit ? $mahasiswa->angkatan : '') }}">
          </div>

          <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Update' : 'Create' }}
          </button>
          <a href="{{ url('/mahasiswa') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>

</body>
</html>