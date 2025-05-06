<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Dashboard Admin</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" type="image/x-icon">
  <style>
    * { box-sizing: border-box; }
    body {
      font-family: sans-serif;
      margin: 0;
      background-color: #f0f0f0;
    }
    .container {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 220px;
      background-color: #ffffff;
      padding: 20px;
      border-right: 1px solid #ddd;
    }
    .sidebar a {
      display: block;
      padding: 10px;
      margin-bottom: 10px;
      text-decoration: none;
      color: black;
      border-radius: 8px;
    }
    .sidebar a.active,
    .sidebar a:hover {
      background-color: #a4e4b3;
    }
    .main {
      flex: 1;
      padding: 20px;
    }
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .dropdown {
      position: relative;
      display: inline-block;
      margin-top: 20px;
    }
    .dropdown-btn {
      background-color: #a4e4b3;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
      z-index: 1;
      margin-top: 5px;
    }
    .dropdown-content div {
      padding: 10px;
      cursor: pointer;
    }
    .dropdown-content div:hover {
      background-color: #f0f0f0;
    }
    .cards {
      display: flex;
      gap: 20px;
      margin-top: 20px;
      margin-bottom: 30px;
    }
    .card {
      background-color: #b2f2bb;
      padding: 20px;
      border-radius: 12px;
      flex: 1;
      text-align: center;
    }
    .chart-container {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
    }
    .chart-placeholder {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .chart-box {
      width: 48%;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div style="text-align:center; margin-bottom:20px;">
        <div style="font-size:40px;">👤</div>
        <strong>Admin</strong>
      </div>
      <a href="{{ route('admin.dashboard') }}"  class="active">Dashboard</a>
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
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
      </div>

      <div class="chart-container">
        <!-- Dropdown Periode -->
        <div class="dropdown">
          <button class="dropdown-btn" onclick="toggleDropdown()">Periode <span id="selected-year">2024-2025</span>
            <span class="menu-arrow">
            <img src="{{ asset('img/image/arrowdown.png') }}" alt="arrowdown" height="15"/>
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

    // Optional: Close dropdown if clicked outside
    window.onclick = function(e) {
      if (!e.target.matches('.dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
          dropdowns[i].style.display = "none";
        }
      }
    }
  </script>
</body>
</html>