<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTQ Al-Yusra | Hafalan Santri</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" type="image/x-icon">
  <!-- style css -->
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
      <a href="{{ route('admin.jadwalmengajar.index') }}">Jadwal Mengajar</a>
      <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
      <a href="{{ route('admin.datasantri.index') }}">Data Santri</a>
      <a href="{{ route('admin.kelolapengguna.index') }}">Kelola Pengguna</a>
      <a href="{{ route('admin.periode.index') }}">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}" class="active">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
    </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Hafalan Santri</h1>
      <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
    </div>

    <!-- tambahan tambahan tambahan -->
    <form method="GET" action="{{ route('admin.hafalanadmin.detail') }}">
      <div class="ka-form-container">
        <div class="ka-form-group">

          <!-- Periode & Cabang -->
          <div class="ka-form-row">
            <div class="ka-form-item">
              <select name="periode_id" id="periode">
                <option value="">Pilih Periode</option>
                @foreach($periodes as $periode)
                  <option value="{{ $periode->id }}">{{ $periode->tahun_ajaran }}</option>
                @endforeach
              </select>
            </div>
            <div class="ka-form-item">
              <select name="cabang" id="cabang">
                <option value="">Pilih Cabang</option>
                <option value="Sukajadi">Sukajadi</option>
                <option value="Rumbai">Rumbai</option>
                <option value="Gobah 1">Gobah 1</option>
                <option value="Gobah 2">Gobah 2</option>
                <option value="Rawa Bening">Rawa Bening</option>
              </select>
            </div>
          </div>

          <!-- Guru dan Kelas -->
          <div class="ka-form-row">
            <div class="ka-form-item">
              <select name="guru_id" id="guru_id">
                <option value="">Pilih Nama Guru</option>
                @foreach($gurus as $guru)
                  <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                @endforeach
              </select>
            </div>
            <div class="ka-form-item">
              <select name="kelas" id="kelas">
                <option value="">Pilih Kelas</option>
                <option value="Halaqah A">Halaqah A</option>
                <option value="Halaqah B">Halaqah B</option>
                <option value="Halaqah C">Halaqah C</option>
                <option value="Halaqah D">Halaqah D</option>
                <option value="Halaqah E">Halaqah E</option>
              </select>
            </div>
          </div>

          <!-- Tanggal -->
          <div class="ka-form-row">
            <div class="ka-form-item">
              <input type="date" name="tanggal" id="tanggal">
            </div>
          </div>

          <!-- Button -->
          <div class="ka-button-row">
            <button type="submit" class="ka-add-btn">Lihat Detail</button>
          </div>

        </div>
      </div>
    </form>

  </div>
</div>

</body>
</html>
