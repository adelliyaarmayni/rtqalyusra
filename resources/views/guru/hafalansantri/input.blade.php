<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RTQ Al-Yusra | Input Hafalan Santri</title>
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
      min-width: 150px;
    }
    .form-item-small {
      min-width: 120px;
      flex: 0 1 auto;
    }
    select, input[type="date"], input[type="text"] {
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
    table select {
      width: 120px;
      padding: 6px 8px;
    }
    table .form-item {
      min-width: unset;
    }
    /* Style untuk range ayat */
    .ayat-range {
      display: flex;
      align-items: center;
      gap: 5px;
      justify-content: center;
    }
    .ayat-range input {
      width: 50px;
      padding: 6px 8px;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .ayat-range span {
      font-size: 14px;
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
    <a href="#">Kehadiran</a>
    <a href="#" class="active">Hafalan Santri</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Input Hafalan Santri</h1>
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

        <!-- Tanggal -->
        <div class="form-row">
          <div class="form-item form-item-small">
            <input type="date" id="tanggal">
          </div>
        </div>

        <!-- Tabel Hafalan -->
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
                <td>Santri 1</td>
                <td>
                  <select>
                    <option value="">Pilih Surah</option>
                    <option value="Al-Fatihah">Al-Fatihah</option>
                    <option value="Al-Baqarah">Al-Baqarah</option>
                    <option value="Ali Imran">Ali Imran</option>
                    <option value="An-Nisa">An-Nisa</option>
                  </select>
                </td>
                <td>
                  <select>
                    <option value="">Pilih Juz</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </td>
                <td>
                  <div class="ayat-range">
                    <input type="text" placeholder="">
                    <span>-</span>
                    <input type="text" placeholder="">
                  </div>
                </td>
              </tr>

              <tr>
                <td>2</td>
                <td>Santri 2</td>
                <td>
                  <select>
                    <option value="">Pilih Surah</option>
                    <option value="Al-Fatihah">Al-Fatihah</option>
                    <option value="Al-Baqarah">Al-Baqarah</option>
                    <option value="Ali Imran">Ali Imran</option>
                    <option value="An-Nisa">An-Nisa</option>
                  </select>
                </td>
                <td>
                  <select>
                    <option value="">Pilih Juz</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </td>
                <td>
                  <div class="ayat-range">
                    <input type="text" placeholder="">
                    <span>-</span>
                    <input type="text" placeholder="">
                  </div>
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

</body>
</html>
