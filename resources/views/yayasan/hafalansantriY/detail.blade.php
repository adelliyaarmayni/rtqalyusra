<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Grafik Hafalan Santri</title>
  <link rel="shortcut icon" href="./img/image/logortq.png" type="image/x-icon">
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
    .chart-container {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      margin-top: 20px;
    }
    .header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .info-box {
      padding: 8px 18px;
      border-radius: 6px;
      background-color: #a4e4b3;
      font-weight: bold;
      font-size: 14px;
      display: inline-block;
    }
    .dropdown {
      position: relative;
      display: inline-block;
    }
    .dropdown-btn {
      background-color: #a4e4b3;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
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
    .chart-placeholder {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .chart-box {
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div style="text-align:center; margin-bottom:20px;">
        <div style="font-size:40px;">👤</div>
        <strong>Yayasan</strong>
      </div>
      <a href="#">Dashboard</a>
      <a href="#">Kehadiran</a>
      <a href="#" class="active">Hafalan Santri</a>
      <a href="#">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="topbar">
        <h1>Grafik Detail Hafalan Santri</h1>
        <img src="./img/image/logortq.png" alt="Logo RTQ" height="100"/>
      </div>

      <div class="chart-container">
        <!-- Baris label dan dropdown -->
        <div class="header-row">
          <div class="info-box">Sukajadi</div>
          <div class="dropdown">
            <button class="dropdown-btn" onclick="toggleDropdown()">Periode <span id="selected-year">2024-2025</span>
              <span class="menu-arrow">
                <img src="./img/image/arrowdown.png" alt="arrow" height="15"/>
              </span>
            </button>
            <div class="dropdown-content" id="dropdown-menu">
              <div onclick="selectYear('2023-2024')">2023-2024</div>
              <div onclick="selectYear('2024-2025')">2024-2025</div>
              <div onclick="selectYear('2025-2026')">2025-2026</div>
            </div>
          </div>
        </div>

        <!-- Grafik -->
        <div class="chart-placeholder">
          <div class="chart-box">
            <h4>Data Kehadiran</h4>
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

    window.onclick = function(e) {
      if (!e.target.closest('.dropdown')) {
        document.getElementById('dropdown-menu').style.display = 'none';
      }
    }
  </script>
</body>
</html>
