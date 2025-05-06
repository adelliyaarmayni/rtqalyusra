<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Tambah Pengguna</title>
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
    }
    .form-content {
      max-width: 900px;
      width: 100%;
    }
    .form-group {
      margin-bottom: 15px;
      width: 100%;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      font-size: 14px; 
      color: #555;
    }
    .form-group.small-label label {
      font-size: 13px; 
    }
    select, input[type="text"], input[type="date"] {  
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px; 
    }
    
    .date-input-wrapper {
      position: relative;
      width: 100%;
    }
    .date-input-wrapper::before {
      content: "Masukan Tanggal Lahir";
      position: absolute;
      left: 9px;
      top: 8px;
      color: #000;
      pointer-events: none;
      font-size: 14px;
    }
    input[type="date"] {
      appearance: none;
      position: relative;
      z-index: 1;
      background-color: transparent;
      color: transparent; 
    }
    input[type="date"]:valid,
    input[type="date"]:focus {
      color: #000; 
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      right: 8px;
      z-index: 2;
      opacity: 1;
    }
    select {
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
      background-repeat: no-repeat;
      background-position-x: 95%;
      background-position-y: center;
      background-size: 16px; 
    }
    .button-group {
      display: flex;
      justify-content: flex-start; 
      gap: 10px;
      margin-top: 20px;
      width: 100%;
    }
    .button-group button {
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px; 
    }
    .cancel-btn {
      background-color: #f0f0f0;
      border: 1px solid #ddd;
    }
    .add-btn {
      background-color: #a4e4b3;
      border: none;
    }
    input[type="text"]::placeholder {
      color: #000;
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
        <h1>Tambah Pengguna</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
      </div>

      <!-- Form Tambah Data Guru -->
      <div class="form-container">
        <div class="form-content">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <input type="text" name="role" id="role" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="konfirmpassword">Konfirmasi Password</label>
            <input type="text" name="password" id="password" placeholder="" required>
          </div>
          <div class="button-group">
            <a href="{{ route('admin.kelolapengguna.index') }}">
              <button class="cancel-btn">Cancel</button>
            </a>
            <a href="{{ route('admin.kelolapengguna.index') }}">
              <button class="add-btn">Add</button>
            </a>
          </div>
        </div>
      </div>
    </div>
</div>

</body>
</html>