<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Kelola Pengguna</title>
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
      margin-bottom: 20px;
    }
    .chart-container {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #e2e8f0;
    }
    .status-toggle {
      display: flex;
      border-radius: 5px;
      overflow: hidden;
      width: 150px;
      margin: 0 auto;
    }
    .status-toggle button {
      flex: 1;
      padding: 5px 10px;
      border: none;
      cursor: pointer;
      font-size: 12px;
      transition: all 0.3s;
    }
    .status-toggle button.active {
      background-color: #4CAF50;
      color: white;
    }
    .status-toggle button.inactive {
      background-color: #f44336;
      color: white;
    }
    .add-btn {
      background-color: #a4e4b3;
      color: black;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
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
      <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
      <a href="{{ route('admin.datasantri.index') }}">Data Santri</a>
      <a href="{{ route('admin.kelolapengguna.index') }}" class="active">Kelola Pengguna</a>
      <a href="{{ route('admin.periode.index') }}">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="topbar">
        <h1>Daftar Pengguna</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
      </div>

      <div class="chart-container">
        <a href="{{ route('admin.kelolapengguna.tambah') }}">
          <button class="add-btn">Add</button>
        </a>
        <div style="overflow-x:auto; margin-top: 20px;">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Fulanah</td>
                <td>fulanah@gmail.com</td>
                <td>Guru</td>
                <td>
                  <div class="status-toggle">
                    <button class="active">Aktif</button>
                    <button class="inactive">Nonaktif</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Toggle status aktif/nonaktif
    document.querySelectorAll('.status-toggle button').forEach(button => {
      button.addEventListener('click', function() {
        const parent = this.parentElement;
        parent.querySelectorAll('button').forEach(btn => {
          btn.classList.remove('active', 'inactive');
          btn.style.opacity = '0.6';
        });
        this.classList.add(this.textContent === 'Aktif' ? 'active' : 'inactive');
        this.style.opacity = '1';
      });
    });
  </script>

</body>
</html>