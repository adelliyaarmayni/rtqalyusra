<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Periode</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" type="image/x-icon">
  <style>
    * {
      box-sizing: border-box;
    }
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
      flex-shrink: 0;
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
      display: flex;
      flex-direction: column;
    }
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    .form-container {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      width: 100%;
      margin-top: 10px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .form-header {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .form-header::before {
      content: "";
      display: inline-block;
      width: 4px;
      height: 20px;
      background-color: #a4e4b3;
    }
    .form-group {
      display: flex;
      gap: 20px;
      align-items: flex-end;
      margin-bottom: 20px;
    }
    .form-item {
      display: flex;
      flex-direction: column;
      width: 200px; 
    }
    .form-item label {
      margin-bottom: 5px;
      font-size: 14px;
      color: black;
    }
    select, input[type="text"] {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      appearance: none;
      background-color: white;
      width: 100%;
    }
    select {
      background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
      background-repeat: no-repeat;
      background-position-x: 95%;
      background-position-y: center;
      background-size: 16px;
    }
    .add-btn {
      padding: 8px 20px;
      background-color: #a4e4b3;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      height: 38px;
    }
    table {
      width: 30%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #f9f9f9;
      font-weight: bold;
    }
    tr:hover {
      background-color: #f5f5f5;
    }
    .sidebar-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar-header .avatar {
      font-size: 40px;
    }
  </style>
</head>
<body>

<div class="container">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="avatar">👤</div>
      <strong>Admin</strong>
    </div>
    <a href="{{ route('admin.dashboard') }}" >Dashboard</a>
      <a href="{{ route('admin.jadwalmengajar.index') }}">Jadwal Mengajar</a>
      <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
      <a href="{{ route('admin.datasantri.index') }}">Data Santri</a>
      <a href="{{ route('admin.kelolapengguna.index') }}">Kelola Pengguna</a>
      <a href="{{ route('admin.periode.index') }}" class="active">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Periode</h1>
      <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
    </div>

    <!-- Form and Table -->
    <div class="form-container">
      <!-- Form -->
      <div class="form-group">
        <div class="form-item">
          <label for="tahun-ajaran">Tahun Ajaran Baru</label>
          <select name="tahun-ajaran" id="tahun-ajaran">
            <option value="">Pilih Tahun Ajaran</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
          </select>
        </div>
        <div class="form-item">
          <label for="periode">Periode</label>
          <select name="periode" id="periode">
            <option value="">Pilih Periode</option>
            <option value="Ganjil">Ganjil</option>
            <option value="Genap">Genap</option>
          </select>
        </div>
        <a href="{{ route('admin.periode.index') }}">
        <button class="add-btn">Add</button>
        </a>
      </div>

      <!-- Table -->
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Periode</th>
            <th>Tahun Ajaran</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Ganjil</td>
            <td>2024</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Genap</td>
            <td>2025</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
