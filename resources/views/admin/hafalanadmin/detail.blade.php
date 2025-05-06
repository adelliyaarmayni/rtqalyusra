<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTQ Al-Yusra | Hafalan Santri</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" type="image/x-icon">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: sans-serif;
    }
    body {
      background-color: #f0f0f0;
    }
    .container {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 220px;
      background: #fff;
      padding: 20px;
      border-right: 1px solid #ddd;
    }
    .sidebar-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .avatar {
      font-size: 40px;
      margin-bottom: 5px;
    }
    .sidebar a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #000;
      margin-bottom: 10px;
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
      margin-bottom: 20px;
    }
    .topbar img {
      height: 60px;
    }
    .form-container {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      display: flex;
      flex-direction: column;
      gap: 20px;
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
      width: 80%;
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
    th, td {
    text-align: center;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .form-row {
      display: flex;
      gap: 20px;
      align-items: center;
      flex-wrap: wrap;
    }
    .form-item {
      display: flex;
      flex-direction: column;
      flex: 1;
      min-width: 200px; 
    }
    select, input[type="date"] {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      background: white;
      width: auto; 
      min-width: 100px; 
    }
    .button-row {
      display: flex;
      justify-content: flex-end;
    }
    h1 {
      font-size: 24px;
      margin-bottom: 10px;
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
      <a href="{{ route('admin.periode.index') }}">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}" class="active">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Detail Hafalan Santri</h1>
      <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
    </div>

    <div class="form-container">
      <div class="form-group">

        <!-- Periode -->
        <div class="form-row">
          <div class="form-item">
            <select id="periode">
              <option value="periode">Pilih Periode</option>
              <option value="2024-2025">2024-2025</option>
              <option value="2025-2026">2025-2026</option>
            </select>
          </div>
        </div>

        <!-- Guru dan Kelas -->
        <div class="form-row">
          <div class="form-item">
            <select id="guru">
              <option value="guru">Pilih Nama Guru</option>
              <option value="Fulanah">Fulanah, S.Ag</option>
              <option value="Other">Guru Lain</option>
            </select>
          </div>
          <div class="form-item">
            <select id="kelas">
              <option value="kelas">Pilih Kelas</option>
              <option value="Kelas A">Kelas A</option>
              <option value="Kelas B">Kelas B</option>
            </select>
          </div>
        </div>

        <!-- Tanggal dan Kegiatan -->
        <div class="form-row">
          <div class="form-item">
            <input type="date" id="tanggal">
          </div>
        </div>

        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Surah</th>
                <th>Juz</th>
                <th>Ayat</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Della Adelliya Armayni</td>
                <td>Al-Baqarah</td>
                <td>1</td>
                <td>187</td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>2</td>
                <td>Della Adelliya Armayni</td>
                <td>Al-Baqarah</td>
                <td>1</td>
                <td>187</td>
              </tr>
            </tbody><tbody>
              <tr>
                <td>3</td>
                <td>Della Adelliya Armayni</td>
                <td>Al-Baqarah</td>
                <td>1</td>
                <td>187</td>
              </tr>
            </tbody><tbody>
              <tr>
                <td>4</td>
                <td>Della Adelliya Armayni</td>
                <td>Al-Baqarah</td>
                <td>1</td>
                <td>187</td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

</body>
</html>