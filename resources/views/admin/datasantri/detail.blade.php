<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Detail Data Santri</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="body">

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
      <a href="{{ route('admin.datasantri.index') }}" class="active">Data Santri</a>
      <a href="{{ route('admin.kelolapengguna.index') }}">Kelola Pengguna</a>
      <a href="{{ route('admin.periode.index') }}">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="dt-card">
      <h2 class="dt-title">Detail Data Santri</h2>
    <div class="dt-content">
        <div class="dt-row">
          <div class="dt-label">Nama Santri</div>
          <div class="dt-value">{{ $santri->nama_santri }}</div>
          <div class="dt-label">Tempat Lahir</div>
          <div class="dt-value">{{ $santri->tempat_lahir }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Tanggal Lahir</div>
          <div class="dt-value">{{ $santri->tanggal_lahir }}</div>
          <div class="dt-label">Asal</div>
          <div class="dt-value">{{ $santri->asal }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">NIS</div>
          <div class="dt-value">{{ $santri->nis }}</div>
          <div class="dt-label">Email</div>
          <div class="dt-value">{{ $santri->email }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Asal Sekolah</div>
          <div class="dt-value">{{ $santri->asal_sekolah }}</div>
          <div class="dt-label">Nama Orang Tua</div>
          <div class="dt-value">{{ $santri->nama_ortu }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">No HP Orangtua</div>
          <div class="dt-value">{{ $santri->NoHP_ortu }}</div>
          <div class="dt-label">Pekerjaan Orang Tua</div>
          <div class="dt-value">{{ $santri->pekerjaan_ortu }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">MK</div>
          <div class="dt-value">{{ $santri->MK }}</div>
          <div class="dt-label">Golongan Darah</div>
          <div class="dt-value">{{ $santri->GolDar }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Jenis Kelamin</div>
          <div class="dt-value">{{ $santri->jenis_kelamin }}</div>
          <div class="dt-label">Kategori Masuk</div>
          <div class="dt-value">{{ $santri->kat_masuk }}</div>
        </div>

        <div class="dt-row">
          <div class="dt-label">Kelas</div>
          <div class="dt-value">{{ $santri->kelas }}</div>
          <div class="dt-label">Jenis Kelas</div>
          <div class="dt-value">{{ $santri->jenis_kelas }}</div>
        </div>

        <div class="dt-row">
          <div class="dt-label">Cabang</div>
          <div class="dt-value">{{ $santri->cabang }}</div>
        </div>

        <div class="button-group">
          <a href="{{ route('admin.datasantri.index') }}" class="cancel-btn">Kembali</a>
        </div>
    </div>
    </div>
</div>

</body>

</html>
