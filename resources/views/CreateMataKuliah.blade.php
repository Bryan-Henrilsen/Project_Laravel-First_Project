<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Mata Kuliah</title>
  @vite(['resources/js/app.js'])
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Create Mata Kuliah</h2>
      </div>
      <div class="card-body">
        @php
        $isEdit = isset($matakuliah);
        @endphp

        <form action="{{ $isEdit ? route('matakuliah.update', $matakuliah->id) : route('matakuliah.store') }}" method="POST">
          @csrf
          @if($isEdit) 
            @method('PUT')
          @endif

          <div class="mb-3">
            <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" id="kode_mk" class="form-control" placeholder="Masukkan Kode Mata Kuliah"
                    value="{{ old('kode_mk', $isEdit ? $matakuliah->kode_mk : '') }}">
          </div>

          <div class="mb-3">
            <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" id="nama_mk" class="form-control" placeholder="Masukkan Nama Mata Kuliah"
                    value="{{ old('nama_mk', $isEdit ? $matakuliah->nama_mk : '') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Jurusan</label>
            @foreach(['Bisnis Digital','Kewirausahaan','Sistem dan Teknologi Informasi'] as $jurusan)
            <div class="form-check">
                <input type="radio" name="jurusan" value="{{ $jurusan }}" class="form-check-input"
                    {{ ($isEdit && $matakuliah->jurusan == $jurusan) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $jurusan }}</label>
            </div>
            @endforeach
          </div>

          <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Update' : 'Create' }}
          </button>
          <a href="{{ url('/matakuliah') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>

</body>
</html>