<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Edit Data Guru</title>
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
        <h1>Edit Data Guru</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" />
      </div>

      <!-- Form Edit Data Guru -->
      <div class="form-container">
        <div class="form-content">
          <form action="{{ route('admin.dataguru.update', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
              <input type="text" name="nama_guru" id="nama_guru" placeholder="Masukan Nama Guru"
                value="{{ old('nama_guru', $guru->nama_guru) }}" required>
            </div>

            <div class="form-group">
              <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir"
                value="{{ old('tempat_lahir', $guru->tempat_lahir) }}" required>
            </div>

            <div class="form-group date-wrapper">
              <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" required>
            </div>

            <div class="form-group">
              <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat"
                value="{{ old('alamat', $guru->alamat) }}" required>
            </div>

            <div class="form-group">
              <input type="text" name="no_hp" id="no_hp" placeholder="Masukan Nomor HP"
                value="{{ old('no_hp', $guru->no_hp) }}" required>
            </div>

            <div class="form-group">
              <input type="text" name="email" id="email" placeholder="Masukan Email"
                value="{{ old('email', $guru->email) }}" required>
            </div>

            <div class="form-group">
              <input type="text" name="jlh_hafalan" id="jlh_hafalan" placeholder="Masukan Jumlah Hafalan"
                value="{{ old('jlh_hafalan', $guru->jlh_hafalan) }}" required>
            </div>

            <!-- Dropdown Jenis Kelamin -->
            <div class="form-group">
              <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="" disabled {{ old('jenis_kelamin', $guru->jenis_kelamin) ? '' : 'selected' }}>
                  Jenis Kelamin
                </option>
                <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                </option>
                <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki
                </option>
              </select>
            </div>

            <!-- Dropdown Pendidikan Terakhir -->
            <div class="form-group">
              <select name="pend_akhir" id="pend_akhir" required>
                <option value="" disabled {{ old('pend_akhir', $guru->pend_akhir) ? '' : 'selected' }}>
                  Pendidikan Terakhir
                </option>
                <option value="SD" {{ old('pend_akhir', $guru->pend_akhir) == 'SD' ? 'selected' : '' }}>SD</option>
                <option value="SMP" {{ old('pend_akhir', $guru->pend_akhir) == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                <option value="SMA" {{ old('pend_akhir', $guru->pend_akhir) == 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat</option>
                <option value="S1" {{ old('pend_akhir', $guru->pend_akhir) == 'S1' ? 'selected' : '' }}>S1</option>
                <option value="S2" {{ old('pend_akhir', $guru->pend_akhir) == 'S2' ? 'selected' : '' }}>S2</option>
                <option value="S3" {{ old('pend_akhir', $guru->pend_akhir) == 'S3' ? 'selected' : '' }}>S3</option>
              </select>
            </div>

            <!-- Dropdown Golongan Darah -->
            <div class="form-group">
              <select name="gol_dar" id="gol_dar" required>
                <option value="" disabled {{ old('gol_dar', $guru->gol_dar) ? '' : 'selected' }}>
                  Golongan Darah
                </option>
                <option value="A" {{ old('gol_dar', $guru->gol_dar) == 'A' ? 'selected' : '' }}>A</option>
                <option value="AB" {{ old('gol_dar', $guru->gol_dar) == 'AB' ? 'selected' : '' }}>AB</option>
                <option value="B" {{ old('gol_dar', $guru->gol_dar) == 'B' ? 'selected' : '' }}>B</option>
                <option value="O" {{ old('gol_dar', $guru->gol_dar) == 'O' ? 'selected' : '' }}>O</option>
              </select>
            </div>

            <!-- Dropdown Masa Kerja (MK) -->
            <div class="form-group small-label">
              <select name="mk" id="mk" required>
                <option value="" disabled {{ old('mk', $guru->mk) ? '' : 'selected' }}>Masukan MK</option>
                <option value="Si" {{ old('mk', $guru->mk) == 'Si' ? 'selected' : '' }}>Si</option>
                <option value="Se" {{ old('mk', $guru->mk) == 'Se' ? 'selected' : '' }}>Se</option>
                <option value="Ti" {{ old('mk', $guru->mk) == 'Ti' ? 'selected' : '' }}>Ti</option>
                <option value="Te" {{ old('mk', $guru->mk) == 'Te' ? 'selected' : '' }}>Te</option>
                <option value="In" {{ old('mk', $guru->mk) == 'In' ? 'selected' : '' }}>In</option>
                <option value="Fi" {{ old('mk', $guru->mk) == 'Fi' ? 'selected' : '' }}>Fi</option>
                <option value="Fe" {{ old('mk', $guru->mk) == 'Fe' ? 'selected' : '' }}>Fe</option>
                <option value="Ii" {{ old('mk', $guru->mk) == 'Ii' ? 'selected' : '' }}>Ii</option>
                <option value="Ie" {{ old('mk', $guru->mk) == 'Ie' ? 'selected' : '' }}>Ie</option>
              </select>
            </div>

            <!-- Dropdown Status Menikah -->
            <div class="form-group">
              <select name="status_menikah" id="status_menikah" required>
                <option value="" disabled {{ old('status_menikah', $guru->status_menikah) ? '' : 'selected' }}>
                  Status Menikah
                </option>
                <option value="Menikah" {{ old('status_menikah', $guru->status_menikah) == 'Menikah' ? 'selected' : '' }}>
                  Menikah
                </option>
                <option value="Belum Menikah" {{ old('status_menikah', $guru->status_menikah) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah
                </option>
              </select>
            </div>

            <!-- Dropdown Bagian -->
            <div class="form-group">
              <select name="bagian" id="bagian" required>
                <option value="" disabled {{ old('bagian', $guru->bagian ?? '') == '' ? 'selected' : '' }}>Masukan Bagian
                </option>
                <option value="Admin" {{ old('bagian', $guru->bagian ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Yayasan" {{ old('bagian', $guru->bagian ?? '') == 'Yayasan' ? 'selected' : '' }}>Yayasan
                </option>
                <option value="Guru Kelas" {{ old('bagian', $guru->bagian ?? '') == 'Guru Kelas' ? 'selected' : '' }}>Guru
                  Kelas</option>
              </select>
            </div>

            <!-- Dropdown Cabang -->
            <div class="form-group">
              <select name="cabang" id="cabang" required>
                <option value="" disabled>Masukan Cabang</option>
                <option value="Sukajadi" {{ old('cabang', $guru->cabang) == 'Sukajadi' ? 'selected' : '' }}>Sukajadi
                </option>
                <option value="Rumbai" {{ old('cabang', $guru->cabang) == 'Rumbai' ? 'selected' : '' }}>Rumbai
                </option>
                <option value="Gobah 1" {{ old('cabang', $guru->cabang) == 'Gobah 1' ? 'selected' : '' }}>Gobah 1</option>
                <option value="Gobah 2" {{ old('cabang', $guru->cabang) == 'Gobah 2' ? 'selected' : '' }}>Gobah 2</option>
                <option value="Rawa Bening" {{ old('cabang', $guru->cabang) == 'Rawa Bening' ? 'selected' : '' }}>Rawa
                  Bening
                </option>
              </select>
            </div>

            <div class="button-group">
              <a href="{{ route('admin.dataguru.index') }}" class="cancel-btn">Cancel</a>
              <button class="add-btn" type="submit">Update</button>
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