<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Edit Jadwal Mengajar</title>
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
      max-width: 900px;
      margin-top: 10px;
      flex: 1;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      font-size: 14px;
    }
    .form-group.small-width {
      max-width: 400px;
    }
    select, input[type="text"], input[type="time"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
    }
    select {
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
      background-repeat: no-repeat;
      background-position-x: 95%;
      background-position-y: center;
      background-size: 16px;
    }
    .time-container {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .time-group {
      flex: 1;
    }
    .time-separator {
      font-size: 14px;
      padding: 0 3px;
    }
    .button-group {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-top: 20px;
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
    <a href="#">Dashboard</a>
    <a href="#" class="active">Jadwal Mengajar</a>
    <a href="#">Data Guru</a>
    <a href="#">Data Santri</a>
    <a href="#">Kelola Pengguna</a>
    <a href="#">Periode</a>
    <a href="#">Kategori Penilaian</a>
    <a href="#">Kehadiran</a>
    <a href="#">Hafalan Santri</a>
    <a href="#">Kinerja Guru</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Edit Jadwal Mengajar</h1>
      <img src="./img/image/logortq.png" alt="Logo RTQ" height="80"/>
    </div>

    <!-- Form Tambah Jadwal -->
    <div class="form-container">
      <div class="form-group">
        <select name="namaguru" id="namaguru" required>
          <option value="" disabled selected>Pilih Nama Guru</option>
          <option value="fulanah">Fulanah</option>
          <option value="fulan">Fulan</option>
        </select>
      </div>

      <div class="form-group">
        <select name="kelasguru" id="kelasguru" required>
          <option value="" disabled selected>Pilih Kelas</option>
          <option value="kelasA">Kelas A</option>
          <option value="kelasB">Kelas B</option>
        </select>
      </div>

      <div class="form-group">
        <select name="kegiatan" id="kegiatan" required>
          <option value="" disabled selected>Masukan Kegiatan</option>
          <option value="hafalan">Hafalan</option>
          <option value="murajaah">Muraja'ah</option>
        </select>
      </div>

      <div class="form-group small-width">
        <label for="periode">Periode</label>
        <select name="periode" id="periode" required>
          <option value="" disabled selected>Pilih Periode</option>
          <option value="2023-2024">2023-2024</option>
          <option value="2024-2025">2024-2025</option>
        </select>
      </div>

      <div class="form-group small-width">
        <label>Jam</label>
        <div class="time-container">
          <div class="time-group">
            <input type="time" name="jam_masuk" id="jam_masuk" value="00:00" required>
          </div>
          <div class="time-separator">-</div>
          <div class="time-group">
            <input type="time" name="jam_keluar" id="jam_keluar" value="00:00" required>
          </div>
        </div>
      </div>

      <div class="button-group">
        <button class="cancel-btn">Cancel</button>
        <button class="add-btn">Update</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>
