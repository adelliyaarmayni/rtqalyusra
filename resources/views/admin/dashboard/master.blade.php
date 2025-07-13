<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Dashboard Admin</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <div style="display: flex; align-items: center; gap: 8px;">
          <img src="{{ asset('img/image/akun.png') }}" alt="Foto Admin" style="width: 40px; height: 40px; border-radius: 40%;">
          <strong>Admin</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="{{ asset('img/image/logout.png') }}" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>

      <!-- Menu -->
      <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
      <a href="{{ route('admin.jadwalmengajar.index') }}">Jadwal Mengajar</a>
      <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
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
        <h1>Dashboard</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" />
      </div>

      <div class="chart-container">
        <!-- Dropdown Periode -->
        <form method="GET" id="periodeForm" action="{{ route('dashboard') }}">
          <div class="dropdown">
            <button type="button" class="dropdown-btn" onclick="toggleDropdown()">Periode: 
              <span id="selected-year">{{ $periodeFilter ?? 'Pilih Periode' }}</span>
              <span class="menu-arrow">
                <img src="{{ asset('img/image/arrowdown.png') }}" alt="arrowdown" height="15" />
              </span>
            </button>
            <div class="dropdown-content" id="dropdown-menu">
              @foreach($periodes as $p)
                <div onclick="selectYear('{{ $p->tahun_ajaran }}')">{{ $p->tahun_ajaran }}</div>
              @endforeach
            </div>
          </div>
          <input type="hidden" name="periode" id="periodeInput" value="{{ $periodeFilter }}">
        </form>

        <!-- Cards -->
        <div class="cards">
          <div class="card">
            <h2>Jumlah Guru</h2>
            <p>{{ $guruCount }} Guru</p>
          </div>
          <div class="card">
            <h2>Jumlah Santri</h2>
            <p>{{ $santriCount }} Santri</p>
          </div>
        </div>

        <!-- Charts -->
        <div class="chart-placeholder">
          <div class="chart-box">
            <h4>Data Kehadiran</h4>
            <canvas id="kehadiranChart" height="200"></canvas>
          </div>
          <div class="chart-box">
            <h4>Data Hafalan Santri</h4>
            <canvas id="hafalanChart" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Script Dropdown -->
  <script>
    function toggleDropdown() {
      const menu = document.getElementById('dropdown-menu');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    function selectYear(year) {
      document.getElementById('selected-year').textContent = year;
      document.getElementById('periodeInput').value = year;
      document.getElementById('periodeForm').submit();
    }

    window.onclick = function (e) {
      if (!e.target.closest('.dropdown-btn')) {
        document.getElementById("dropdown-menu").style.display = "none";
      }
    };
  </script>

  <!-- Script Chart -->
  <script>
    const kehadiranData = @json($kehadiranData);
    const hafalanByJuz = @json($hafalanByJuz);

    // Kehadiran chart (per cabang: hadir & alfa)
    const labelsKehadiran = kehadiranData.map(item => item.cabang);
    const hadirData = kehadiranData.map(item => item.hadir);
    const alfaData = kehadiranData.map(item => item.alfa);

    new Chart(document.getElementById('kehadiranChart'), {
      type: 'bar',
      data: {
        labels: labelsKehadiran,
        datasets: [
          {
            label: 'Hadir',
            data: hadirData,
            backgroundColor: '#4CAF50'
          },
          {
            label: 'Alfa',
            data: alfaData,
            backgroundColor: '#F44336'
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Jumlah Kehadiran'
            },
            ticks: {
              callback: function (value) {
                return Number.isInteger(value) ? value : null;
              },
              stepSize: 1
            }
          }
        }
      }
    });

    // Hafalan chart
    const labelsHafalan = hafalanByJuz.map(item => `Juz ${item.juz}`);
    const dataHafalan = hafalanByJuz.map(item => item.total);

    new Chart(document.getElementById('hafalanChart'), {
      type: 'bar',
      data: {
        labels: labelsHafalan,
        datasets: [{
          label: 'Jumlah Santri',
          data: dataHafalan,
          backgroundColor: '#2196F3'
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Jumlah Santri'
            },
            ticks: {
              callback: function (value) {
                return Number.isInteger(value) ? value : null;
              },
              stepSize: 1
            }
          }
        }
      }
    });
  </script>
</body>

</html>