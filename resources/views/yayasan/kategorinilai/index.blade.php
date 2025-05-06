<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>RTQ Al-Yusra | Input Kinerja Guru</title>
  <link rel="shortcut icon" href="./img/image/logortq.png" type="image/x-icon" />
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
      width: 100%;
    }
    .info-box {
      padding: 10px;
      border-radius: 6px;
      background-color: #f0f0f0;
      font-size: 14px;
    }
    .info-box.green {
      background-color: #a4e4b3;
      font-weight: bold;
    }
    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    .button-group {
      display: flex;
      justify-content: flex-end;
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
    .input-btn {
      background-color: #a4e4b3;
      border: none;
    }
    .input-btn:hover {
      background-color: #8cd4a0;
    }
    .penilaian {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .penilaian label {
      font-weight: bold;
    }
    .penilaian div {
      display: flex;
      gap: 15px;
    }
    .container-penilaian {
      background-color: #e0e0e0;
      padding: 20px;
      border-radius: 12px;
      margin-top: 10px;
    }
    .penilaian-inner {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="container">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="avatar">👤</div>
      <strong>Yayasan</strong>
    </div>
    <a href="#">Dashboard</a>
    <a href="#">Kehadiran</a>
    <a href="#">Hafalan Santri</a>
    <a href="#" class="active">Kinerja Guru</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Kinerja Guru</h1>
      <img src="./img/image/logortq.png" alt="Logo RTQ" />
    </div>

    <div class="form-container">
      <div class="form-group">
        <!-- Guru dan Periode -->
        <div class="form-row">
          <div class="form-item">
            <label for="nama-guru">Nama Guru</label>
            <select id="nama-guru">
              <option value="">Pilih Nama Guru</option>
              <option value="fulanah">Fulanah</option>
            </select>
          </div>
          <div class="form-item">
            <label for="bagian">Bagian</label>
            <div class="info-box">Kesantrian</div>
          </div>
        </div>

        <!-- Cabang dan Periode -->
        <div class="form-row">
          <div class="form-item">
            <label for="cabang">Cabang</label>
            <div class="info-box">Sukajadi</div>
          </div>
          <div class="form-item">
            <label for="periode">Periode</label>
            <select id="periode">
              <option value="">Pilih Periode</option>
              <option value="2024-2025">2024-2025</option>
            </select>
          </div>
        </div>

        <!-- Penilaian Kinerja -->
        <div class="container-penilaian">
          <div class="penilaian-inner">
            <div class="penilaian">
              <label>1. Ketepatan Waktu Mengajar</label>
              <div>
                <label><input type="radio" name="waktu" value="1"> 1</label>
                <label><input type="radio" name="waktu" value="2"> 2</label>
                <label><input type="radio" name="waktu" value="3"> 3</label>
                <label><input type="radio" name="waktu" value="4"> 4</label>
                <label><input type="radio" name="waktu" value="5"> 5</label>
              </div>

              <label>2. Sikap Mengajar</label>
              <div>
                <label><input type="radio" name="sikap" value="1"> 1</label>
                <label><input type="radio" name="sikap" value="2"> 2</label>
                <label><input type="radio" name="sikap" value="3"> 3</label>
                <label><input type="radio" name="sikap" value="4"> 4</label>
                <label><input type="radio" name="sikap" value="5"> 5</label>
              </div>

              <label>3. Akhlak</label>
              <div>
                <label><input type="radio" name="akhlak" value="1"> 1</label>
                <label><input type="radio" name="akhlak" value="2"> 2</label>
                <label><input type="radio" name="akhlak" value="3"> 3</label>
                <label><input type="radio" name="akhlak" value="4"> 4</label>
                <label><input type="radio" name="akhlak" value="5"> 5</label>
              </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="button-group">
              <button class="input-btn">Simpan</button>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

</body>
</html>
