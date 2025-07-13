<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Detail Data Santri</title>
  <link rel="shortcut icon" href="<?php echo e(asset('img/image/logortq.png')); ?>" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>

<body class="body">

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
      <a href="<?php echo e(route('admin.datasantri.index')); ?>" class="active">Data Santri</a>
      <a href="<?php echo e(route('admin.kelolapengguna.index')); ?>">Kelola Pengguna</a>
      <a href="<?php echo e(route('admin.periode.index')); ?>">Periode</a>
      <a href="<?php echo e(route('admin.kategoripenilaian.index')); ?>">Kategori Penilaian</a>
      <a href="<?php echo e(route('admin.kehadiranA.index')); ?>">Kehadiran</a>
      <a href="<?php echo e(route('admin.hafalanadmin.index')); ?>">Hafalan Santri</a>
      <a href="<?php echo e(route('admin.kinerjaguru.index')); ?>">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="dt-card">
      <h2 class="dt-title">Detail Data Santri</h2>
    <div class="dt-content">
        <div class="dt-row">
          <div class="dt-label">Nama Santri</div>
          <div class="dt-value"><?php echo e($santri->nama_santri); ?></div>
          <div class="dt-label">Tempat Lahir</div>
          <div class="dt-value"><?php echo e($santri->tempat_lahir); ?></div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Tanggal Lahir</div>
          <div class="dt-value"><?php echo e($santri->tanggal_lahir); ?></div>
          <div class="dt-label">Asal</div>
          <div class="dt-value"><?php echo e($santri->asal); ?></div>
        </div>
        <div class="dt-row">
          <div class="dt-label">NIS</div>
          <div class="dt-value"><?php echo e($santri->nis); ?></div>
          <div class="dt-label">Email</div>
          <div class="dt-value"><?php echo e($santri->email); ?></div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Asal Sekolah</div>
          <div class="dt-value"><?php echo e($santri->asal_sekolah); ?></div>
          <div class="dt-label">Nama Orang Tua</div>
          <div class="dt-value"><?php echo e($santri->nama_ortu); ?></div>
        </div>
        <div class="dt-row">
          <div class="dt-label">No HP Orangtua</div>
          <div class="dt-value"><?php echo e($santri->NoHP_ortu); ?></div>
          <div class="dt-label">Pekerjaan Orang Tua</div>
          <div class="dt-value"><?php echo e($santri->pekerjaan_ortu); ?></div>
        </div>
        <div class="dt-row">
          <div class="dt-label">MK</div>
          <div class="dt-value"><?php echo e($santri->MK); ?></div>
          <div class="dt-label">Golongan Darah</div>
          <div class="dt-value"><?php echo e($santri->GolDar); ?></div>
        </div>
        <div class="dt-row">
          <div class="dt-label">Jenis Kelamin</div>
          <div class="dt-value"><?php echo e($santri->jenis_kelamin); ?></div>
          <div class="dt-label">Kategori Masuk</div>
          <div class="dt-value"><?php echo e($santri->kat_masuk); ?></div>
        </div>

        <div class="dt-row">
          <div class="dt-label">Kelas</div>
          <div class="dt-value"><?php echo e($santri->kelas); ?></div>
          <div class="dt-label">Jenis Kelas</div>
          <div class="dt-value"><?php echo e($santri->jenis_kelas); ?></div>
        </div>

        <div class="dt-row">
          <div class="dt-label">Cabang</div>
          <div class="dt-value"><?php echo e($santri->cabang); ?></div>
        </div>

        <div class="button-group">
          <a href="<?php echo e(route('admin.datasantri.index')); ?>" class="cancel-btn">Kembali</a>
        </div>
    </div>
    </div>
</div>

</body>

</html>
<?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/admin/datasantri/detail.blade.php ENDPATH**/ ?>