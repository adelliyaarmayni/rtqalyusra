<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Dashboard Guru</title>
  <link rel="shortcut icon" href="./img/image/logortq.png" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            style="width: 40px; height: 40px; border-radius: 50%;">
          <strong>Guru</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="{{ asset('img/image/logout.png') }}" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>
      <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
      <a href="{{ route('guru.kehadiranG.index') }}">Kehadiran</a>
      <a href="{{ route('guru.hafalansantri.index') }}">Hafalan Santri</a>
    </div>

    <!-- Main Content -->
    <div class="main flex-1">
      <div class="gy-topbar bg-white flex justify-between items-center p-4 shadow">
        <div class="flex items-center gap-4">
          <button class="hamburger" id="toggleSidebarBtn">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h1 class="text-xl font-bold">Dashboard</h1>
        </div>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo" class="h-20 bg-white p-2 rounded" />
      </div>

      <div class="chart-container p-4">
        <!-- Dropdown Periode -->
        <form method="GET" id="periodeForm" action="{{ route('dashboard') }}">
          <div class="dropdown relative inline-block mb-6">
            <button type="button"
              class="dropdown-btn bg-[#A4E4B3] text-black border border-gray-300 rounded px-3 py-1.5 flex items-center gap-2 font-semibold text-sm"
              onclick="toggleDropdown()">Periode:
              <span id="selected-year">{{ $selectedPeriodeNama ?? 'Pilih Periode' }}</span>
              <span class="menu-arrow">
                <img src="{{ asset('img/image/arrowdown.png') }}" alt="arrowdown" class="h-3" />
              </span>
            </button>

            <div
              class="dropdown-content absolute hidden bg-white mt-1 border border-gray-200 rounded shadow-lg z-10 w-full"
              id="dropdown-menu">
              @foreach($periodes as $p)
          <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-sm"
          onclick="selectYear('{{ $p->id }}', '{{ $p->tahun_ajaran }}')">{{ $p->tahun_ajaran }}</div>
        @endforeach
            </div>
          </div>
          <input type="hidden" name="periode_id" id="periodeInput" value="{{ $selectedPeriode }}">
        </form>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="bg-[#A4E4B3] p-6 rounded-xl shadow flex flex-col items-center justify-center text-center">
            <h2 class="text-xl font-bold text-black">Jumlah Kelas Yang Di Ajar</h2>
            <p class="text-lg mt-2 text-black">{{ $jumlahKelas }} Kelas</p>
          </div>
          <div class="bg-[#A4E4B3] p-6 rounded-xl shadow flex flex-col items-center justify-center text-center">
            <h2 class="text-xl font-bold text-black">Jumlah Keterlambatan</h2>
            <p class="text-lg mt-2 text-black">{{ $jumlahTelat }} Kegiatan</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Logic -->
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
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    function selectYear(id, tahun) {
      document.getElementById('selected-year').textContent = tahun;
      document.getElementById('periodeInput').value = id;
      document.getElementById('periodeForm').submit();
    }

    window.onclick = function (e) {
      if (!e.target.closest('.dropdown')) {
        document.getElementById("dropdown-menu").style.display = "none";
      }
    }
  </script>
</body>

</html>