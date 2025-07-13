<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Detail Data Guru</title>
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
    <div class="dt-card">
      <h2 class="dt-title">Detail Data Guru</h2>
      <div class="dt-content">
        <div class="dt-row">
          <div class="dt-label">Nama Guru</div>
          <div class="dt-value">{{ $guru->nama_guru }}</div>
          <div class="dt-label">Tempat Lahir</div>
          <div class="dt-value">{{ $guru->tempat_lahir }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Tanggal Lahir</div>
          <div class="dt-value">{{ \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d/m/Y') }}</div>
          <div class="dt-label">Alamat</div>
          <div class="dt-value">{{ $guru->alamat }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">No HP</div>
          <div class="dt-value">{{ $guru->no_hp }}</div>
          <div class="dt-label">Email</div>
          <div class="dt-value">{{ $guru->email }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Jumlah Hafalan</div>
          <div class="dt-value">{{ $guru->jlh_hafalan }}</div>
          <div class="dt-label">Jenis Kelamin</div>
          <div class="dt-value">{{ $guru->jenis_kelamin }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Pendidikan Terakhir</div>
          <div class="dt-value">{{ $guru->pend_akhir }}</div>
          <div class="dt-label">Golongan Darah</div>
          <div class="dt-value">{{ $guru->gol_dar }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">MK</div>
          <div class="dt-value">{{ $guru->mk }}</div>
          <div class="dt-label">Status Menikah</div>
          <div class="dt-value">{{ $guru->status_menikah }}</div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Bagian</div>
          <div class="dt-value">{{ $guru->bagian }}</div>
          <div class="dt-label">Cabang</div>
          <div class="dt-value">{{ $guru->cabang }}</div>
        </div>

        <div class="button-group">
          <a href="{{ route('admin.dataguru.index') }}" class="cancel-btn">Kembali</a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>