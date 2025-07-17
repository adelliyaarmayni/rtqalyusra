<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Kategori Penilaian</title>
  <link rel="shortcut icon" href="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo RTQ" height="100" type="image/x-icon">
  <!-- style css -->
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

<div class="container">
  <!-- Sidebar -->
    <div class="sidebar">
      <!-- Profil & Logout -->
      <div class="sidebar-header">
        <!-- Profil -->
        <div style="display: flex; align-items: center; gap: 8px;">
          <img src="<?php echo e(asset('img/image/akun.png')); ?>" alt="Foto Admin"
            style="width: 40px; height: 40px; border-radius: 40%;">
          <strong>Admin</strong>
        </div>

        <!-- Tombol Logout -->
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="<?php echo e(asset('img/image/logout.png')); ?>" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>

      <!-- Menu -->
      <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
      <a href="<?php echo e(route('admin.jadwalmengajar.index')); ?>">Jadwal Mengajar</a>
      <a href="<?php echo e(route('admin.dataguru.index')); ?>">Data Guru</a>
      <a href="<?php echo e(route('admin.datasantri.index')); ?>">Data Santri</a>
      <a href="<?php echo e(route('admin.kelolapengguna.index')); ?>">Kelola Pengguna</a>
      <a href="<?php echo e(route('admin.periode.index')); ?>">Periode</a>
      <a href="<?php echo e(route('admin.kategoripenilaian.index')); ?>" class="active">Kategori Penilaian</a>
      <a href="<?php echo e(route('admin.kehadiranA.index')); ?>">Kehadiran</a>
      <a href="<?php echo e(route('admin.hafalanadmin.index')); ?>">Hafalan Santri</a>
      <a href="<?php echo e(route('admin.kinerjaguru.index')); ?>">Kinerja Guru</a>
    </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Kategori Penilaian</h1>
      <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo RTQ" height="100"/>
    </div>

    <?php if(session('success')): ?>
      <div class="alert-success">
      <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

      <?php if(session('error')): ?>
      <div class="alert-error">
      <?php echo e(session('error')); ?>

      </div>
    <?php endif; ?>

    <div class="ka-form-container">
        <div class="kg-form-group">

        <!-- Form and Table -->
        <div class="form-container">
          <!-- Form -->
          <form action="<?php echo e(route('admin.kategoripenilaian.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <div class="form-item">
                <label for="kategorinilai">Kategori Penilaian</label>
                <input type="text" name="kategori" id="kategorinilai" placeholder="Masukkan Kategori Penilaian" required>
              </div>
              <button type="submit" class="pkp-add-btn">Add</button>
            </div>
          </form>

          <!-- Table -->
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori Penilaian</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><?php echo e($index + 1); ?></td>
                  <td><?php echo e($kategori->kategori); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                  <td colspan="2">Belum ada kategori penilaian.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  setTimeout(() => {
    const success = document.querySelector('.alert-success');
    const error = document.querySelector('.alert-error');

    if (success) {
      success.style.transition = 'opacity 0.5s ease-out';
      success.style.opacity = '0';
      setTimeout(() => success.remove(), 500); 
    }

    if (error) {
      error.style.transition = 'opacity 0.5s ease-out';
      error.style.opacity = '0';
      setTimeout(() => error.remove(), 500); 
    }
  }, 2000); 
</script>

</body>
</html>
<?php /**PATH C:\laragon\www\Sistem\sistemrtq\resources\views/admin/kategoripenilaian/index.blade.php ENDPATH**/ ?>