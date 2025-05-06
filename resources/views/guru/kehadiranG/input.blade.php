<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RTQ Al-Yusra | Input Kehadiran Kegiatan</title>
  <link rel="shortcut icon" href="./img/image/logortq.png" type="image/x-icon">
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
    table {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #e2e8f0;
    }
    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    .custom-file-upload {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 6px;
      background: white;
      display: inline-block;
      cursor: pointer;
      text-align: center;
      font-size: 14px;
      width: 100%;
      transition: background-color 0.3s;
    }
    .custom-file-upload:hover {
      background-color: #f9f9f9;
    }
    .upload-label-content {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .upload-label-content svg {
      fill: #555;
    }
    .status-wrapper {
      display: flex;
      width: 150px;
      height: 40px;
      border: 1px solid #ccc;
      border-radius: 6px;
      overflow: hidden;
      cursor: pointer;
      user-select: none;
      font-weight: bold;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    .status-left, .status-right {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      border-right: 1px solid #ccc;
    }
    .status-left {
      background-color: #4CAF50;
      color: white;
    }
    .status-right {
      background-color: white;
      color: #333;
      border-right: none;
    }
    .status-wrapper.alfa .status-left {
      background-color: white;
      color: #333;
    }
    .status-wrapper.alfa .status-right {
      background-color: #f44336;
      color: white;
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
  </style>
</head>
<body>

<div class="container">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="avatar">👤</div>
      <strong>Guru</strong>
    </div>
    <a href="#">Dashboard</a>
    <a href="#" class="active">Kehadiran</a>
    <a href="#">Hafalan Santri</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Input Kehadiran</h1>
      <img src="./img/image/logortq.png" alt="Logo RTQ">
    </div>

    <div class="form-container">
      <div class="form-group">

        <!-- Informasi Kelas -->
        <div class="form-item">
          <div class="info-box green">Kelas A</div>
        </div>

        <!-- Guru dan Periode -->
        <div class="form-row">
          <div class="form-item">
            <div class="info-box">Fulanah, S.Ag</div>
          </div>
          <div class="form-item">
            <div class="info-box">Periode 2023-2024</div>
          </div>
        </div>

        <!-- Kegiatan dan Waktu -->
        <div class="form-row">
          <div class="form-item">
            <select id="kategori">
              <option value="kegiatan">Masukan Kegiatan</option>
              <option value="Subuh">Subuh</option>
            </select>
          </div>
          <div class="form-item">
            <div class="info-box">02.00-04.00</div>
          </div>
        </div>

        <!-- Tanggal dan Upload Dokumentasi -->
        <div class="form-row">
          <div class="form-item">
            <input type="date" id="tanggal">
          </div>
          <div class="form-item">
            <label for="dokumentasi" class="custom-file-upload">
              <span class="upload-label-content">
                Upload Dokumentasi Kegiatan
                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20">
                  <path d="M0 0h24v24H0V0z" fill="none"/>
                  <path d="M5 20h14v-2H5v2zm7-18l-7 7h4v6h6v-6h4l-7-7z"/>
                </svg>
              </span>
            </label>
            <input type="file" id="dokumentasi" accept="image/*" style="display: none;">
          </div>
        </div>

        <!-- Tabel Kehadiran -->
        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Status Kehadiran</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Santri 1</td>
                <td>
                  <div style="display: flex; justify-content: center;">
                    <div class="status-wrapper">
                      <div class="status-left">Hadir</div>
                      <div class="status-right"></div>
                    </div>
                  </div>
                </td>
                <td>
                  <label for="bukti1" class="custom-file-upload">
                    <span class="upload-label-content">
                      Bukti
                      <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M5 20h14v-2H5v2zm7-18l-7 7h4v6h6v-6h4l-7-7z"/>
                      </svg>
                    </span>
                  </label>
                  <input type="file" id="bukti1" accept="image/*" style="display: none;">
                </td>
              </tr>

              <tr>
                <td>2</td>
                <td>Santri 2</td>
                <td>
                  <div style="display: flex; justify-content: center;">
                    <div class="status-wrapper">
                      <div class="status-left">Hadir</div>
                      <div class="status-right"></div>
                    </div>
                  </div>
                </td>
                <td>
                  <label for="bukti2" class="custom-file-upload">
                    <span class="upload-label-content">
                      Bukti
                      <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M5 20h14v-2H5v2zm7-18l-7 7h4v6h6v-6h4l-7-7z"/>
                      </svg>
                    </span>
                  </label>
                  <input type="file" id="bukti2" accept="image/*" style="display: none;">
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="button-group">
          <button class="input-btn">Input</button>
        </div>

      </div>
    </div>

  </div>
</div>

<!-- JavaScript -->
<script>
  document.querySelectorAll('.status-wrapper').forEach(wrapper => {
    wrapper.addEventListener('click', function() {
      this.classList.toggle('alfa');
      if (this.classList.contains('alfa')) {
        this.querySelector('.status-left').textContent = '';
        this.querySelector('.status-right').textContent = 'Alfa';
      } else {
        this.querySelector('.status-left').textContent = 'Hadir';
        this.querySelector('.status-right').textContent = '';
      }
    });
  });
</script>

</body>
</html>
