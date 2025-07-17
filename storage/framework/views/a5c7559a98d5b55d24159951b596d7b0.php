<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Kehadiran</title>
  <link rel="shortcut icon" href="<?php echo e(asset('img/image/logortq.png')); ?>" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
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

    .sidebar-hidden {
      left: -100%;
    }

    .sidebar-visible {
      left: 0;
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
          <strong>Guru</strong>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="<?php echo e(asset('img/image/logout.png')); ?>" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>
      <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
      <a href="<?php echo e(route('guru.kehadiranG.index')); ?>" class="active">Kehadiran</a>
      <a href="<?php echo e(route('guru.hafalansantri.index')); ?>">Hafalan Santri</a>
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
          <h1 class="text-xl font-bold">Kehadiran</h1>
        </div>
        <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo" class="h-20 bg-white p-2 rounded" />
      </div>

      <div class="chart-container p-4">
        <!-- Dropdown Periode -->
        <div class="mb-4">
          <form method="GET" action="<?php echo e(route('guru.kehadiranG.index')); ?>">
            <label for="periode_id" class="mr-2 font-medium">Pilih Periode:</label>
            <select name="periode_id" id="periode_id" onchange="this.form.submit()"
              class="border border-gray-300 rounded px-2 py-1 text-sm w-44">
              <option value="">-- Semua Periode --</option>
              <?php $__currentLoopData = $periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($periode->id); ?>" <?php echo e($selectedPeriode == $periode->id ? 'selected' : ''); ?>>
                  <?php echo e($periode->tahun_ajaran); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </form>
        </div>

        <!-- Label -->
        <div class="text-xl font-semibold mb-4">Daftar Kelas Anda</div>

        <!-- Kartu Kelas -->
        <div class="flex flex-wrap gap-4">
          <?php $__empty_1 = true; $__currentLoopData = $kelasUnik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div
              class="bg-[#A4E4B3] p-4 rounded-2xl shadow-md w-full sm:w-[200px] flex flex-col items-center text-center">
              <div class="text-lg font-bold mb-2"><?php echo e($item); ?></div>
              <div class="flex gap-2">
                <a href="<?php echo e(route('guru.kehadiranG.input', ['namaKelas' => strtolower($item)])); ?>"
                  title="Input Kehadiran" class="bg-[#C4EAC4] p-2 rounded-md shadow hover:bg-green-200">
                  <img src="<?php echo e(asset('img/image/plus.png')); ?>" alt="Input" class="w-5 h-5" />
                </a>
                <a href="<?php echo e(route('guru.detailKehadiran.detail', ['kelas' => strtolower($item)])); ?>"
                  title="Lihat Detail" class="bg-[#C4EAC4] p-2 rounded-md shadow hover:bg-green-200">
                  <img src="<?php echo e(asset('img/image/detail.png')); ?>" alt="Detail" class="w-5 h-5" />
                </a>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">Tidak ada jadwal mengajar untuk Anda.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

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
  </script>
</body>


</html><?php /**PATH C:\laragon\www\Sistem\sistemrtq\resources\views/guru/kehadiranG/index.blade.php ENDPATH**/ ?>