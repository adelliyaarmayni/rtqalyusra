<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Data Guru</title>
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
      margin-bottom: 20px;
    }
    .dropdown-btn {
      background-color: #a4e4b3;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
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
    .chart-container {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      margin-top: 20px;
    }
    .table-controls {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
    }
    .table-controls select,
    .table-controls input {
      padding: 5px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .table-controls button {
      background-color: #a4e4b3;
      color: black;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
    }
    .table-controls button:hover {
      background-color: #a4e4b3;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #e2e8f0;
    }
    .action-buttons button {
      background-color: #a4e4b3;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      margin-right: 5px;
      cursor: pointer;
    }
    .action-buttons button.delete {
      background-color: #e63946;
    }
    .action-buttons img {
      height: 20px;
    }
    .pagination {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
      font-size: 14px;
      color: gray;
    }
    .pagination-buttons button {
      padding: 5px 10px;
      margin-right: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      cursor: pointer;
      background-color: white;
    }
    .pagination-buttons button.active {
      background-color: #a4e4b3;
      border: none;
      color: white;
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
      <a href="{{ route('admin.dashboard') }}" >Dashboard</a>
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
        <h1>Data Guru</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
      </div>

      <!-- Tabel Jadwal Mengajar -->
      <div class="chart-container">

        <!-- Kontrol Tabel -->
        <div class="table-controls">
          <div>
            Show 
            <select>
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
            </select> 
            entries
          </div>
          <div style="display: flex; flex-direction: column; align-items: flex-end;">
            <input type="text" placeholder="Search..." />
            <a href="{{ route('admin.dataguru.tambah') }}">
              <button>Add</button>
            </a>
          </div>
        </div>

        <!-- Tabel -->
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Bagian</th>
                <th>Cabang</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Fulanah</td>
                <td>Pekanbaru</td>
                <td>17/05/1999</td>
                <td>Kesantrian</td>
                <td>Sukajadi</td>
                <td class="action-buttons">
                <button><img src="{{ asset('img/image/edit.png') }}" alt="edit" height="100"/></button>
                <button class="delete"><img src="{{ asset('img/image/delete.png') }}" alt="delete" height="100"/></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
          <div>Showing 1 to 10 of 200 entries</div>
          <div class="pagination-buttons">
            <button>«</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>»</button>
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
      if (!e.target.closest('.dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
          dropdowns[i].style.display = "none";
        }
      }
    }
  </script>

</body>
</html>