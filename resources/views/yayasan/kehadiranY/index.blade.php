<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Kehadiran </title>
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
    .button-group {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-top: 20px;
      width: 150%;
    }
    .cabang-btn {
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      background-color: #a4e4b3;
      color: black;
      border: none;
      transition: background-color 0.3s ease;
      width: auto;
      min-width: 150px;
    }
    .cabang-btn:hover {
      background-color: #a4e4b3;
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
    .form-group.header-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .label {
      font-weight: bold;
      font-size: 16px;
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
      <a href="#" class="active">Kehadiran</a>
      <a href="#">Hafalan Santri</a>
      <a href="#">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="topbar">
        <h1>Kehadiran</h1>
        <img src="./img/image/logortq.png" alt="Logo RTQ" height="100"/>
      </div>

      <div class="chart-container">
        <!-- Baris label dan dropdown -->
        <div class="form-group header-row">
          <div class="label">Cabang RTQ Al-Yusra</div>
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

        <!-- Tombol cabang -->
        <div class="form-group">
          <div class="button-group">
            <button class="cabang-btn">Sukajadi</button>
            <button class="cabang-btn">Gobah</button>
          </div>
          <div class="button-group">
            <button class="cabang-btn">Kubang</button>
            <button class="cabang-btn">Rumbai</button>
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
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
          dropdowns[i].style.display = "none";
        }
      }
    }
  </script>
</body>
</html>
