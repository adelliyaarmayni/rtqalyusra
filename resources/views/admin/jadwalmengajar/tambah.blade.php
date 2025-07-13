<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Tambah Jadwal Mengajar</title>
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
        <h1>Tambah Jadwal Mengajar</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" />
      </div>

      <!-- Form Tambah Jadwal -->
      <div class="form-container">
        <form action="{{ route('admin.jadwalmengajar.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <select name="guru_id" id="namaguru" required>
              <option value="" disabled selected>Pilih Nama Guru</option>
              @foreach($gurus as $guru)
          <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
        @endforeach
            </select>
          </div>

          <div class="form-group">
            <select name="kelas" id="kelasguru" required>
              <option value="" disabled selected>Pilih Kelas</option>
              <option value="Halaqah A">Halaqah A</option>
              <option value="Halaqah B">Halaqah B</option>
              <option value="Halaqah C">Halaqah C</option>
              <option value="Halaqah D">Halaqah D</option>
              <option value="Halaqah E">Halaqah E</option>
            </select>
          </div>

          <div class="form-group small-label">
            <select name="cabang" id="cabang" required>
              <option value="" disabled selected>Pilih Cabang</option>
              <option value="Sukajadi">Sukajadi</option>
              <option value="Rumbai">Rumbai</option>
              <option value="Gobah 1">Gobah 1</option>
              <option value="Gobah 2">Gobah 2</option>
              <option value="Rawa Bening">Rawa Bening</option>
            </select>
          </div>

          <div class="form-group">
            <select name="kegiatan" id="kegiatan" required>
              <option value="" disabled selected>Pilih Kegiatan</option>
              <option value="Tahajud">Tahajud</option>
              <option value="Subuh">Subuh</option>
              <option value="Dhuha">Dhuha</option>
              <option value="Dzuhur">Dzuhur</option>
              <option value="Ashar">Ashar</option>
              <option value="Magrib">Magrib</option>
              <option value="Isya">Isya</option>
              <option value="Hafalan">Hafalan</option>
              <option value="Murajaah">Muraja'ah</option>
            </select>
          </div>

          <div class="form-group small-width">
            <label for="periode_id">Periode</label>
            <select name="periode_id" id="periode" required>
              <option value="" disabled selected>Pilih Periode</option>
              @foreach($periodes as $p)
          <option value="{{ $p->id }}">{{ $p->tahun_ajaran }}</option>
        @endforeach
            </select>
          </div>

          <div class="form-group small-width">
            <label>Jam</label>
            <div class="jm-time-container">
              <div class="jm-time-group">
                <input type="time" name="jam_masuk" id="jam_masuk" value="07:00" required>
              </div>
              <div class="jm-time-separator">-</div>
              <div class="jm-time-group">
                <input type="time" name="jam_keluar" id="jam_keluar" value="08:00" required>
              </div>
            </div>
          </div>

          <div class="button-group">
            <a href="{{ route('admin.jadwalmengajar.index') }}">
              <button type="button" class="cancel-btn">Cancel</button>
            </a>
            <button type="submit" class="add-btn">Add</button>
          </div>

        </form>
      </div>

    </div>
  </div>

</body>

</html>