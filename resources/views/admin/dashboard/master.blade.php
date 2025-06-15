<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Dashboard Admin</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
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
      <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
      <a href="{{ route('admin.jadwalmengajar.index') }}">Jadwal Mengajar</a>
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
        <h1>Dashboard</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" />
      </div>

      <div class="chart-container">
        <!-- Dropdown Periode -->
        <div class="dropdown">
          <button class="dropdown-btn" onclick="toggleDropdown()">Periode
            <span id="selected-year">2024-2025</span>
            <span class="menu-arrow">
              <img src="{{ asset('img/image/arrowdown.png') }}" alt="arrowdown" height="15" />
            </span>
            <div class="dropdown-content" id="dropdown-menu">
              <div onclick="selectYear('2023-2024')">2023-2024</div>
              <div onclick="selectYear('2024-2025')">2024-2025</div>
              <div onclick="selectYear('2025-2026')">2025-2026</div>
            </div>
          </button>
        </div>

        <!-- Cards -->
        <div class="cards">
          <div class="card">
            <h2>Jumlah Guru</h2>
            <p>10 Guru</p>
          </div>
          <div class="card">
            <h2>Jumlah Santri</h2>
            <p>100 Santri</p>
          </div>
        </div>

        <!-- Grafik -->
        <h3>Data Kehadiran & Hafalan Santri</h3>
        <div class="chart-placeholder">
          <div class="chart-box">
            <h4>Data Kehadiran</h4>
            <div style="height:150px; background-color:#e0e0e0;"></div>
          </div>
          <div class="chart-box">
            <h4>Data Hafalan Santri</h4>
            <div style="height:150px; background-color:#e0e0e0;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Dropdown Logic -->
  <script>
    function toggleDropdown() {
      const menu = document.getElementById('dropdown-menu');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    function selectYear(year) {
      document.getElementById('selected-year').textContent = year;
      document.getElementById('dropdown-menu').style.display = 'none';
    }

    window.onclick = function (e) {
      if (!e.target.closest('.custom-dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("custom-dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
          dropdowns[i].style.display = "none";
        }
      }
    }
  </script>
</body>

</html>