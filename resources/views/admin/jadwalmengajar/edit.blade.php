<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Edit Jadwal Mengajar</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
  <!-- Sidebar -->
    <div class="sidebar">
      <!-- Profil & Logout -->
      <div class="sidebar-header">
        <!-- Profil -->
        <div style="display: flex; align-items: center; gap: 8px;">
          <img src="{{ asset('img/image/akun.png') }}" alt="Foto Admin"
            style="width: 40px; height: 40px; border-radius: 40%;">
          <strong>Admin</strong>
        </div>

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="{{ asset('img/image/logout.png') }}" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>

      <!-- Menu -->
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('admin.jadwalmengajar.index') }}" class="active">Jadwal Mengajar</a>
      <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
      <a href="{{ route('admin.datasantri.index') }}">Data Santri</a>
      <a href="{{ route('admin.kelolapengguna.index') }}">Kelola Pengguna</a>
      <a href="{{ route('admin.periode.index') }}">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
    </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Edit Jadwal Mengajar</h1>
      <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" />
    </div>

    <!-- Form Edit Jadwal -->
    <form action="{{ route('admin.jadwalmengajar.update', $jadwal->id) }}" method="POST" class="form-container">
      @csrf
      @method('PUT')

      <div class="form-group">
        <select name="guru_id" id="guru_id" required>
          <option value="" disabled>Pilih Nama Guru</option>
          @foreach ($gurus as $guru)
            <option value="{{ $guru->id }}" {{ $jadwal->guru_id == $guru->id ? 'selected' : '' }}>
              {{ $guru->nama_guru }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <select name="kelas" id="kelas" required>
          <option value="" disabled>Pilih Kelas</option>
          <option value="Halaqah A" {{ $jadwal->kelas == 'Halaqah A' ? 'selected' : '' }}>Halaqah A</option>
          <option value="Halaqah B" {{ $jadwal->kelas == 'Halaqah B' ? 'selected' : '' }}>Halaqah B</option>
          <option value="Halaqah C" {{ $jadwal->kelas == 'Halaqah C' ? 'selected' : '' }}>Halaqah C</option>
          <option value="Halaqah D" {{ $jadwal->kelas == 'Halaqah D' ? 'selected' : '' }}>Halaqah D</option>
          <option value="Halaqah E" {{ $jadwal->kelas == 'Halaqah E' ? 'selected' : '' }}>Halaqah E</option>
        </select>
      </div>

      <div class="form-group small-label">
        <select name="cabang" id="cabang" required>
          <option value="" disabled>Masukan Cabang</option>
          <option value="Sukajadi" {{ $jadwal->cabang == 'Sukajadi' ? 'selected' : '' }}>Sukajadi</option>
          <option value="Rumbai" {{ $jadwal->cabang == 'Rumbai' ? 'selected' : '' }}>Rumbai</option>
          <option value="Gobah 1" {{ $jadwal->cabang == 'Gobah 1' ? 'selected' : '' }}>Gobah 1</option>
          <option value="Gobah 2" {{ $jadwal->cabang == 'Gobah 2' ? 'selected' : '' }}>Gobah 2</option>
          <option value="Rawa Bening" {{ $jadwal->cabang == 'Rawa Bening' ? 'selected' : '' }}>Rawa Bening</option>
        </select>
      </div>

      <div class="form-group">
        <select name="kegiatan" id="kegiatan" required>
          <option value="" disabled>Masukan Kegiatan</option>
          <option value="Tahajud" {{ $jadwal->kegiatan == 'Tahajud' ? 'selected' : '' }}>Tahajud</option>
          <option value="Subuh" {{ $jadwal->kegiatan == 'Subuh' ? 'selected' : '' }}>Subuh</option>
          <option value="Dhuha" {{ $jadwal->kegiatan == 'Dhuha' ? 'selected' : '' }}>Dhuha</option>
          <option value="Dzuhur" {{ $jadwal->kegiatan == 'Dzuhur' ? 'selected' : '' }}>Dzuhur</option>
          <option value="Ashar" {{ $jadwal->kegiatan == 'Ashar' ? 'selected' : '' }}>Ashar</option>
          <option value="Magrib" {{ $jadwal->kegiatan == 'Magrib' ? 'selected' : '' }}>Magrib</option>
          <option value="Isya" {{ $jadwal->kegiatan == 'Isya' ? 'selected' : '' }}>Isya</option>
          <option value="Hafalan" {{ $jadwal->kegiatan == 'Hafalan' ? 'selected' : '' }}>Hafalan</option>
          <option value="Murajaah" {{ $jadwal->kegiatan == 'Murajaah' ? 'selected' : '' }}>Muraja'ah</option>
        </select>
      </div>

      <div class="form-group small-width">
        <label for="periode_id">Periode</label>
        <select name="periode_id" id="periode_id" required>
          <option value="" disabled {{ is_null($jadwal->periode_id) ? 'selected' : '' }}>Pilih Periode</option>
          @foreach ($periodes as $periode)
            <option value="{{ $periode->id }}" {{ $jadwal->periode_id == $periode->id ? 'selected' : '' }}>
              {{ $periode->tahun_ajaran }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group small-width">
        <label>Jam</label>
        <div class="jm-time-container">
          <div class="jm-time-group">
            <input type="time" name="jam_masuk" value="{{ \Carbon\Carbon::parse($jadwal->jam_masuk)->format('H:i') }}" required>
          </div>
          <div class="jm-time-separator">-</div>
          <div class="jm-time-group">
            <input type="time" name="jam_keluar" value="{{ \Carbon\Carbon::parse($jadwal->jam_keluar)->format('H:i') }}" required>
          </div>
        </div>
      </div>

      <div class="button-group">
        <a href="{{ route('admin.jadwalmengajar.index') }}" class="cancel-btn">Cancel</a>
        <button type="submit" class="add-btn">Update</button>
      </div>
    </form>

  </div>
</div>

</body>
</html>
