<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Dosen</title>
  @vite(['resources/js/app.js'])
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Create Dosen</h2>
      </div>
      <div class="card-body">
        @php
        $isEdit = isset($dosen);
        @endphp

        <form action="{{ $isEdit ? route('dosen.update', $dosen->id) : route('dosen.store') }}" method="POST">
          @csrf
          @if($isEdit) 
            @method('PUT')
          @endif

          <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" id="NIP" class="form-control" placeholder="Masukkan NIP"
                    value="{{ old('nip', $isEdit ? $dosen->nip : '') }}">
          </div>

          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap"
                    value="{{ old('nama', $isEdit ? $dosen->nama : '') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Jurusan</label>
            @foreach(['Bisnis Digital','Kewirausahaan','Sistem dan Teknologi Informasi'] as $jurusan)
            <div class="form-check">
                <input type="radio" name="jurusan" value="{{ $jurusan }}" class="form-check-input"
                    {{ ($isEdit && $dosen->jurusan == $jurusan) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $jurusan }}</label>
            </div>
            @endforeach
          </div>

          <div class="mb-3">
            <label for="pendidikanTerakhir" class="form-label">Pendidikan Terakhir</label>
            <input type="text" name="pendidikanTerakhir" id="pendidikanTerakhir" class="form-control" placeholder="Masukkan Pendidikan Terakhir"
                    value="{{ old('pendidikanTerakhir', $isEdit ? $dosen->pendidikanTerakhir : '') }}">
          </div>

          <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Update' : 'Create' }}
          </button>
          <a href="{{ url('/dosen') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>

</body>
</html>