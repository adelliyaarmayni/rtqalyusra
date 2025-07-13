<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTQ Al-Yusra | Hafalan Santri</title>
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
      <a href="<?php echo e(route('admin.kategoripenilaian.index')); ?>">Kategori Penilaian</a>
      <a href="<?php echo e(route('admin.kehadiranA.index')); ?>">Kehadiran</a>
      <a href="<?php echo e(route('admin.hafalanadmin.index')); ?>" class="active">Hafalan Santri</a>
      <a href="<?php echo e(route('admin.kinerjaguru.index')); ?>">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="topbar">
        <h1>Detail Hafalan Santri</h1>
        <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo RTQ" height="100" />
      </div>

      <div class="ka-form-container">
        <div class="kd-form-group">
          <div class="gki-form-row">

          
            <div class="gki-form-item">
              <div class="gki-info-box">Periode <?php echo e($periode->tahun_ajaran ?? '-'); ?></div>
            </div>
            <div class="gki-form-item">
              <div class="gki-info-box"><?php echo e(ucfirst($cabang)); ?></div>
            </div>
          </div>

          <div class="gki-form-row">
            <div class="gki-form-item">
              <div class="gki-info-box"><?php echo e($guru->nama_guru ?? '-'); ?></div>
            </div>
            <div class="gki-form-item">
              <div class="gki-info-box"><?php echo e($kelas); ?></div>
            </div>
          </div>

          <div class="gki-form-row">
            <div class="gki-form-item">
              <div class="gki-info-box"><?php echo e(\Carbon\Carbon::parse($tanggal)->format('d/m/Y')); ?></div>
            </div>
          </div>

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
              
                <?php $__currentLoopData = $hafalan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loop->iteration + ($hafalan->currentPage() - 1) * $hafalan->perPage()); ?></td>
                  <td><?php echo e($item->santri->nama_santri ?? '-'); ?></td>
                  <td><?php echo e($item->surah); ?></td>
                  <td><?php echo e($item->juz); ?></td>
                  <td><?php echo e($item->ayat_awal); ?> - <?php echo e($item->ayat_akhir); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>

            <?php if($hafalan->total() > 0): ?>
              <div class="pagination">
                Showing <?php echo e($hafalan->firstItem()); ?> to <?php echo e($hafalan->lastItem()); ?> of <?php echo e($hafalan->total()); ?> entries
              </div>
            <?php endif; ?>

            <?php if($hafalan->hasPages()): ?>
              <div class="box-pagination-left">
                
                <?php if($hafalan->onFirstPage()): ?>
                  <span class="page-box-small disabled">«</span>
                <?php else: ?>
                  <a href="<?php echo e($hafalan->previousPageUrl()); ?>" class="page-box-small">«</a>
                <?php endif; ?>

                
                <?php $__currentLoopData = $hafalan->getUrlRange(1, $hafalan->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($page == $hafalan->currentPage()): ?>
                    <span class="page-box-small active"><?php echo e($page); ?></span>
                  <?php else: ?>
                    <a href="<?php echo e($url); ?>" class="page-box-small"><?php echo e($page); ?></a>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php if($hafalan->hasMorePages()): ?>
                  <a href="<?php echo e($hafalan->nextPageUrl()); ?>" class="page-box-small">»</a>
                <?php else: ?>
                  <span class="page-box-small disabled">»</span>
                <?php endif; ?>
              </div>
            <?php endif; ?>

          </div>
          <div class="gki-button-group">
            <a href="<?php echo e(route('admin.hafalanadmin.index')); ?>">
              <button class="gki-input-btn">Kembali</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/admin/hafalanadmin/detail.blade.php ENDPATH**/ ?>