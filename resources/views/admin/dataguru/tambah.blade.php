<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Tambah Data Guru</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" type="image/x-icon">
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
      <a href="{{ route('admin.dataguru.index') }}" class="active">Data Guru</a>
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
        <h1>Tambah Data Guru</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" />
      </div>

      <!-- Form Tambah Data Guru -->
      <div class="form-container">
        <div class="form-content">
          <form action="{{ route('admin.dataguru.store') }}" method="POST">
            @csrf

            <!-- Pilih User Guru -->
            <div class="g-form-group">
              <label for="user_id" style="display: block; margin-bottom: 5px;">Pilih User Guru</label>
              <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Pilih User Guru --</option>
                @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
        @endforeach
              </select>
            </div>

            <div class="form-group">
              <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir" required>
            </div>

            <div class="form-group date-wrapper">
              <label for="tanggal_lahir" class="date-placeholder">Masukan Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>

            <div class="form-group">
              <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat" required>
            </div>

            <div class="form-group">
              <input type="text" name="no_hp" id="no_hp" placeholder="Masukan No HP" required>
            </div>

            <div class="form-group">
              <input type="text" name="jlh_hafalan" id="jlh_hafalan" placeholder="Masukan Jumlah Hafalan" required>
            </div>

            <div class="form-group small-label">
              <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="" disabled selected>Masukan Jenis Kelamin</option>
                <option value="P">Perempuan</option>
                <option value="L">Laki-laki</option>
              </select>
            </div>

            <div class="form-group small-label">
              <select name="pend_akhir" id="pend_akhir" required>
                <option value="" disabled selected>Masukan Pendidikan Terakhir</option>
                <option value="SD">SD</option>
                <option value="SMP/Sederajat">SMP/Sederajat</option>
                <option value="SMA/Sederajat">SMA/Sederajat</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
              </select>
            </div>

            <div class="form-group small-label">
              <select name="gol_dar" id="gol_dar" required>
                <option value="" disabled selected>Masukan Golongan Darah</option>
                <option value="A">A</option>
                <option value="AB">AB</option>
                <option value="B">B</option>
                <option value="O">O</option>
              </select>
            </div>

            <div class="form-group small-label">
              <select name="mk" id="mk" required>
                <option value="" disabled selected>Masukan MK</option>
                <option value="Si">Si</option>
                <option value="Se">Se</option>
                <option value="Ti">Ti</option>
                <option value="Te">Te</option>
                <option value="In">In</option>
                <option value="Fi">Fi</option>
                <option value="Fe">Fe</option>
                <option value="Ii">Ii</option>
                <option value="Ie">Ie</option>
              </select>
            </div>

            <div class="form-group small-label">
              <select name="status_menikah" id="status_menikah" required>
                <option value="" disabled selected>Masukan Status Menikah</option>
                <option value="Menikah">Menikah</option>
                <option value="Belum Menikah">Belum Menikah</option>
              </select>
            </div>

            <div class="form-group small-label">
              <select name="bagian" id="bagian" required>
                <option value="" disabled selected>Masukan Bagian</option>
                <option value="Admin">Admin</option>
                <option value="Yayasan">Yayasan</option>
                <option value="Guru Kelas">Guru Kelas</option>
              </select>
            </div>

            <div class="form-group small-label">
              <select name="cabang" id="cabang" required>
                <option value="" disabled selected>Masukan Cabang</option>
                <option value="Sukajadi">Sukajadi</option>
                <option value="Rumbai">Rumbai</option>
                <option value="Gobah 1">Gobah 1</option>
                <option value="Gobah 2">Gobah 2</option>
                <option value="Rawa Bening">Rawa Bening</option>
              </select>
            </div>

            <div class="button-group">
              <a href="{{ route('admin.dataguru.index') }}">
                <button type="button" class="cancel-btn">Cancel</button>
              </a>
              <button type="submit" class="add-btn">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const input = document.getElementById('tanggal_lahir');
      const label = document.querySelector('.date-placeholder');

      function toggleLabel() {
        if (input.value) {
          label.style.opacity = '0';
          label.style.visibility = 'hidden';
        } else {
          label.style.opacity = '1';
          label.style.visibility = 'visible';
        }
      }

      input.addEventListener('input', toggleLabel);
      toggleLabel();
    });

  </script>

</body>

</html>