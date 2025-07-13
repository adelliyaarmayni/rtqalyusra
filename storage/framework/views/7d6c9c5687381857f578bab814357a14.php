<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Edit Jadwal Mengajar</title>
  <link rel="shortcut icon" href="<?php echo e(asset('img/image/logortq.png')); ?>" type="image/x-icon">
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
      <a href="<?php echo e(route('admin.jadwalmengajar.index')); ?>" class="active">Jadwal Mengajar</a>
      <a href="<?php echo e(route('admin.dataguru.index')); ?>">Data Guru</a>
      <a href="<?php echo e(route('admin.datasantri.index')); ?>">Data Santri</a>
      <a href="<?php echo e(route('admin.kelolapengguna.index')); ?>">Kelola Pengguna</a>
      <a href="<?php echo e(route('admin.periode.index')); ?>">Periode</a>
      <a href="<?php echo e(route('admin.kategoripenilaian.index')); ?>">Kategori Penilaian</a>
      <a href="<?php echo e(route('admin.kehadiranA.index')); ?>">Kehadiran</a>
      <a href="<?php echo e(route('admin.hafalanadmin.index')); ?>">Hafalan Santri</a>
      <a href="<?php echo e(route('admin.kinerjaguru.index')); ?>">Kinerja Guru</a>
    </div>

  <!-- Main Content -->
  <div class="main">
    <div class="topbar">
      <h1>Edit Jadwal Mengajar</h1>
      <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo RTQ" height="100" />
    </div>

    <!-- Form Edit Jadwal -->
    <form action="<?php echo e(route('admin.jadwalmengajar.update', $jadwal->id)); ?>" method="POST" class="form-container">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="form-group">
        <select name="guru_id" id="guru_id" required>
          <option value="" disabled>Pilih Nama Guru</option>
          <?php $__currentLoopData = $gurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($guru->id); ?>" <?php echo e($jadwal->guru_id == $guru->id ? 'selected' : ''); ?>>
              <?php echo e($guru->nama_guru); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="form-group">
        <select name="kelas" id="kelas" required>
          <option value="" disabled>Pilih Kelas</option>
          <option value="Halaqah A" <?php echo e($jadwal->kelas == 'Halaqah A' ? 'selected' : ''); ?>>Halaqah A</option>
          <option value="Halaqah B" <?php echo e($jadwal->kelas == 'Halaqah B' ? 'selected' : ''); ?>>Halaqah B</option>
          <option value="Halaqah C" <?php echo e($jadwal->kelas == 'Halaqah C' ? 'selected' : ''); ?>>Halaqah C</option>
          <option value="Halaqah D" <?php echo e($jadwal->kelas == 'Halaqah D' ? 'selected' : ''); ?>>Halaqah D</option>
          <option value="Halaqah E" <?php echo e($jadwal->kelas == 'Halaqah E' ? 'selected' : ''); ?>>Halaqah E</option>
        </select>
      </div>

      <div class="form-group small-label">
        <select name="cabang" id="cabang" required>
          <option value="" disabled>Masukan Cabang</option>
          <option value="Sukajadi" <?php echo e($jadwal->cabang == 'Sukajadi' ? 'selected' : ''); ?>>Sukajadi</option>
          <option value="Rumbai" <?php echo e($jadwal->cabang == 'Rumbai' ? 'selected' : ''); ?>>Rumbai</option>
          <option value="Gobah 1" <?php echo e($jadwal->cabang == 'Gobah 1' ? 'selected' : ''); ?>>Gobah 1</option>
          <option value="Gobah 2" <?php echo e($jadwal->cabang == 'Gobah 2' ? 'selected' : ''); ?>>Gobah 2</option>
          <option value="Rawa Bening" <?php echo e($jadwal->cabang == 'Rawa Bening' ? 'selected' : ''); ?>>Rawa Bening</option>
        </select>
      </div>

      <div class="form-group">
        <select name="kegiatan" id="kegiatan" required>
          <option value="" disabled>Masukan Kegiatan</option>
          <option value="Tahajud" <?php echo e($jadwal->kegiatan == 'Tahajud' ? 'selected' : ''); ?>>Tahajud</option>
          <option value="Subuh" <?php echo e($jadwal->kegiatan == 'Subuh' ? 'selected' : ''); ?>>Subuh</option>
          <option value="Dhuha" <?php echo e($jadwal->kegiatan == 'Dhuha' ? 'selected' : ''); ?>>Dhuha</option>
          <option value="Dzuhur" <?php echo e($jadwal->kegiatan == 'Dzuhur' ? 'selected' : ''); ?>>Dzuhur</option>
          <option value="Ashar" <?php echo e($jadwal->kegiatan == 'Ashar' ? 'selected' : ''); ?>>Ashar</option>
          <option value="Magrib" <?php echo e($jadwal->kegiatan == 'Magrib' ? 'selected' : ''); ?>>Magrib</option>
          <option value="Isya" <?php echo e($jadwal->kegiatan == 'Isya' ? 'selected' : ''); ?>>Isya</option>
          <option value="Hafalan" <?php echo e($jadwal->kegiatan == 'Hafalan' ? 'selected' : ''); ?>>Hafalan</option>
          <option value="Murajaah" <?php echo e($jadwal->kegiatan == 'Murajaah' ? 'selected' : ''); ?>>Muraja'ah</option>
        </select>
      </div>

      <div class="form-group small-width">
        <label for="periode_id">Periode</label>
        <select name="periode_id" id="periode_id" required>
          <option value="" disabled <?php echo e(is_null($jadwal->periode_id) ? 'selected' : ''); ?>>Pilih Periode</option>
          <?php $__currentLoopData = $periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($periode->id); ?>" <?php echo e($jadwal->periode_id == $periode->id ? 'selected' : ''); ?>>
              <?php echo e($periode->tahun_ajaran); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="form-group small-width">
        <label>Jam</label>
        <div class="jm-time-container">
          <div class="jm-time-group">
            <input type="time" name="jam_masuk" value="<?php echo e(\Carbon\Carbon::parse($jadwal->jam_masuk)->format('H:i')); ?>" required>
          </div>
          <div class="jm-time-separator">-</div>
          <div class="jm-time-group">
            <input type="time" name="jam_keluar" value="<?php echo e(\Carbon\Carbon::parse($jadwal->jam_keluar)->format('H:i')); ?>" required>
          </div>
        </div>
      </div>

      <div class="button-group">
        <a href="<?php echo e(route('admin.jadwalmengajar.index')); ?>" class="cancel-btn">Cancel</a>
        <button type="submit" class="add-btn">Update</button>
      </div>
    </form>

  </div>
</div>

</body>
</html>
<?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/admin/jadwalmengajar/edit.blade.php ENDPATH**/ ?>