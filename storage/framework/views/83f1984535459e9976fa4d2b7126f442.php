<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Dashboard Yayasan</title>
  <link rel="shortcut icon" href="./img/image/logortq.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
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
          <img src="<?php echo e(asset('img/image/akun.png')); ?>" alt="Foto Admin"
            style="width: 40px; height: 40px; border-radius: 50%;">
          <strong>Yayasan</strong>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="<?php echo e(asset('img/image/logout.png')); ?>" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>
      <a href="<?php echo e(route('dashboard')); ?>" class="active">Dashboard</a>
      <a href="<?php echo e(route('yayasan.kehadiranY.index')); ?>">Kehadiran</a>
      <a href="<?php echo e(route('yayasan.hafalansantriY.index')); ?>">Hafalan Santri</a>
      <a href="<?php echo e(route('yayasan.kategorinilai.index')); ?>">Kinerja Guru</a>
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
        <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo" class="h-20 bg-white p-2 rounded" />
      </div>

      <div class="chart-container">
        <!-- Dropdown Periode -->
        <form method="GET" id="periodeForm" action="<?php echo e(route('dashboard')); ?>" class="relative w-fit">
          <!-- Tombol Dropdown -->
          <button type="button" onclick="toggleDropdown()"
            class="flex items-center justify-between gap-2 px-4 py-2 bg-[#A4E4B3] border border-gray-300 rounded shadow text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
            Periode: <span id="selected-year"><?php echo e($periodeFilter ?? 'Pilih Periode'); ?></span>
            <img src="<?php echo e(asset('img/image/arrowdown.png')); ?>" alt="arrowdown" class="w-4 h-4">
          </button>

          <!-- Dropdown Menu -->
          <div id="dropdown-menu"
            class="absolute left-0 mt-1 w-full bg-white border border-gray-300 rounded shadow hidden z-50">
            <?php $__currentLoopData = $periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div onclick="selectYear('<?php echo e($p->tahun_ajaran); ?>')"
          class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
          <?php echo e($p->tahun_ajaran); ?>

        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <!-- Hidden Input -->
          <input type="hidden" name="periode" id="periodeInput" value="<?php echo e($periodeFilter); ?>">
        </form>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
          <div class="bg-white p-4 rounded shadow">
            <h4 class="font-semibold text-center mb-2">Data Kehadiran</h4>
            <canvas id="kehadiranChart" height="250"></canvas>
          </div>

          <div class="bg-white p-4 rounded shadow">
            <h4 class="font-semibold text-center mb-2">Data Hafalan Santri</h4>
            <canvas id="hafalanChart" height="250"></canvas>
          </div>

          <div class="bg-white p-4 rounded shadow">
            <h4 class="font-semibold text-center mb-2">Jumlah Keterlambatan per Guru</h4>
            <canvas id="terlambatChart" height="250"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Script Dropdown -->
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

  <!-- Script Chart -->
  <script>
    const kehadiranData = <?php echo json_encode($kehadiranData, 15, 512) ?>;
    const hafalanByJuz = <?php echo json_encode($hafalanByJuz, 15, 512) ?>;

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

    // terlambat
    const terlambatData = <?php echo json_encode($chartTerlambatGuru, 15, 512) ?>;
    const labelsTerlambat = terlambatData.map(item => item.nama_guru);
    const jumlahTerlambat = terlambatData.map(item => item.jumlah);

    new Chart(document.getElementById('terlambatChart'), {
      type: 'bar',
      data: {
        labels: labelsTerlambat,
        datasets: [{
          label: 'Jumlah Terlambat',
          data: jumlahTerlambat,
          backgroundColor: '#FF9800'
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Jumlah Terlambat'
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

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/yayasan/dashboard/master.blade.php ENDPATH**/ ?>