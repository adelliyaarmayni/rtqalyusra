<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Grafik Kehadiran</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hamburger {
      display: none;
    }

    @media (max-width: 768px) {
      .gy-sidebar {
        position: fixed;
        top: 0;
        left: -100%;
        width: 240px;
        height: 100vh;
        background-color: white;
        z-index: 50;
        padding: 1rem;
        transition: left 0.3s ease;
      }

      .gy-sidebar.active {
        left: 0;
      }

      .hamburger {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem;
        background-color: white;
        border-radius: 0.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        z-index: 50;
      }

      .main {
        margin-left: 0 !important;
      }
    }
  </style>
</head>

<body>
  <div class="container flex">
    <!-- Sidebar -->
    <div class="gy-sidebar" id="sidebar">
      <div class="sidebar-header flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
          <img src="{{ asset('img/image/akun.png') }}" alt="Foto Admin"
            style="width: 40px; height: 40px; border-radius: 100%;">
          <strong>Guru</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="{{ asset('img/image/logout.png') }}" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('yayasan.kehadiranY.index') }}" class="active">Kehadiran</a>
      <a href="{{ route('yayasan.hafalansantriY.index') }}">Hafalan Santri</a>
      <a href="{{ route('yayasan.kategorinilai.index') }}">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="main flex-1">
      <div class="gy-topbar bg-white flex justify-between items-center p-4 shadow flex-nowrap gap-4">
        <div class="flex items-center gap-4 flex-shrink-0">
          <button class="hamburger" id="toggleSidebarBtn">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h1 class="text-xl font-bold whitespace-nowrap">Grafik Kehadiran</h1>
        </div>

        <div class="flex-shrink-0">
          <img src="{{ asset('img/image/logortq.png') }}" alt="Logo" class="h-14 p-1 rounded bg-white" />
        </div>
      </div>

      <div class="chart-container p-4">
        <!-- Header Row: Cabang dan Dropdown -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-4">
          <!-- Nama Cabang -->
          <div class="y-cabang-btn px-4 py-2 bg-[#A4E4B3] rounded text-black font-semibold w-fit">
            {{ $cabang }}
          </div>

          <!-- Dropdown Periode -->
          <form id="periodeForm" method="GET" action="{{ route('yayasan.kehadiranY.detail', ['cabang' => $cabang]) }}"
            class="relative">
            <input type="hidden" name="periode" id="periodeInput" value="{{ $periodeFilter ?? '' }}">

            <button type="button" onclick="toggleDropdown()"
              class="flex items-center justify-between gap-2 px-4 py-2 bg-[#A4E4B3] border border-gray-300 rounded shadow text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
              Periode: <span id="selected-year">{{ $periodeFilter ?? 'Pilih Periode' }}</span>
              <img src="{{ asset('img/image/arrowdown.png') }}" alt="arrow" class="w-4 h-4">
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdown-menu"
              class="absolute left-0 mt-1 w-full bg-white border border-gray-300 rounded shadow hidden z-50">
              @foreach ($periodes as $p)
          <div onclick="selectYear('{{ $p->tahun_ajaran }}')"
          class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
          {{ $p->tahun_ajaran }}
          </div>
        @endforeach
            </div>
          </form>
        </div>

        <!-- Chart Kehadiran -->
        <div class="chart-box bg-white p-4 rounded shadow w-full max-w-md mx-auto">
          <h4 class="font-semibold text-center mb-2">Data Kehadiran</h4>
          <div class="w-full h-[300px]">
            <canvas id="chartKehadiranSantri"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- JS Dropdown Logic -->
    <script>
      const sidebar = document.getElementById('sidebar');
      const toggleBtn = document.getElementById('toggleSidebarBtn');

      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        toggleBtn.classList.toggle('hidden');
      });

      document.addEventListener('click', function (e) {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
          sidebar.classList.remove('active');
          toggleBtn.classList.remove('hidden');
        }
      });
      function toggleDropdown() {
        const menu = document.getElementById('dropdown-menu');
        menu.classList.toggle('hidden');
      }

      function selectYear(year) {
        document.getElementById('selected-year').textContent = year;
        document.getElementById('periodeInput').value = year;
        document.getElementById('periodeForm').submit();
      }

      // Tutup dropdown saat klik di luar
      window.addEventListener('click', function (e) {
        if (!e.target.closest('#periodeForm')) {
          document.getElementById("dropdown-menu").classList.add("hidden");
        }
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const chartData = @json($chartData);

      const labels = chartData.map(item => item.kelas);
      const hadirData = chartData.map(item => item.hadir);
      const alfaData = chartData.map(item => item.alfa);

      new Chart(document.getElementById('chartKehadiranSantri'), {
        type: 'bar',
        data: {
          labels: labels,
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
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Jumlah Kehadiran'
              },
              ticks: {
                stepSize: 1
              }
            }
          },
          plugins: {
            legend: {
              position: 'top'
            }
          }
        }
      });
    </script>
</body>

</html>