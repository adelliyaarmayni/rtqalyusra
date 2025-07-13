<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Edit Data Santri</title>
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
    <div class="main">
      <div class="topbar">
        <h1>Edit Data Santri</h1>
        <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo RTQ" height="100" />
      </div>

      <div class="form-container">
        <div class="form-content">
          <form action="<?php echo e(route('admin.datasantri.update', $santri->id)); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
              <input type="text" name="nama_santri" placeholder="Masukan Nama Santri"
                value="<?php echo e(old('nama_santri', $santri->nama_santri)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="tempat_lahir" placeholder="Masukan Tempat Lahir"
                value="<?php echo e(old('tempat_lahir', $santri->tempat_lahir)); ?>" required>
            </div>

            <div class="form-group date-wrapper">
              <input type="date" name="tanggal_lahir" value="<?php echo e(old('tanggal_lahir', $santri->tanggal_lahir)); ?>"
                required>
            </div>

            <div class="form-group">
              <input type="text" name="asal" placeholder="Masukan Asal" value="<?php echo e(old('asal', $santri->asal)); ?>"
                required>
            </div>

            <div class="form-group">
              <input type="text" name="nis" placeholder="Masukan NIS" value="<?php echo e(old('nis', $santri->nis)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="email" placeholder="Masukan Email" value="<?php echo e(old('email', $santri->email)); ?>"
                required>
            </div>

            <div class="form-group">
              <input type="text" name="asal_sekolah" placeholder="Masukan Asal Sekolah"
                value="<?php echo e(old('asal_sekolah', $santri->asal_sekolah)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="nama_ortu" placeholder="Masukan Nama Orang Tua"
                value="<?php echo e(old('nama_ortu', $santri->nama_ortu)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="NoHP_ortu" placeholder="Masukan No HP Orang Tua"
                value="<?php echo e(old('NoHP_ortu', $santri->NoHP_ortu)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="pekerjaan_ortu" placeholder="Masukan Pekerjaan Orang Tua"
                value="<?php echo e(old('pekerjaan_ortu', $santri->pekerjaan_ortu)); ?>" required>
            </div>

            <!-- Dropdown MK -->
            <div class="form-group">
              <select name="MK" required>
                <option value="" disabled <?php echo e(old('MK', $santri->MK) ? '' : 'selected'); ?>>Masukan MK</option>
                <?php $__currentLoopData = ['Si', 'Se', 'Ti', 'Te', 'In', 'Fi', 'Fe', 'Ii', 'Ie']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($mk); ?>" <?php echo e(old('MK', $santri->MK) == $mk ? 'selected' : ''); ?>><?php echo e($mk); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <!-- Dropdown Golongan Darah -->
            <div class="form-group">
              <select name="GolDar" required>
                <option value="" disabled <?php echo e(old('GolDar', $santri->GolDar) ? '' : 'selected'); ?>>Masukan Golongan Darah
                </option>
                <?php $__currentLoopData = ['A', 'AB', 'B', 'O']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($gd); ?>" <?php echo e(old('GolDar', $santri->GolDar) == $gd ? 'selected' : ''); ?>><?php echo e($gd); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <!-- Dropdown Jenis Kelamin -->
            <div class="form-group">
              <select name="jenis_kelamin" required>
                <option value="" disabled <?php echo e(old('jenis_kelamin', $santri->jenis_kelamin) ? '' : 'selected'); ?>>Masukan
                  Jenis Kelamin</option>
                <option value="P" <?php echo e(old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : ''); ?>>Perempuan
                </option>
                <option value="L" <?php echo e(old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : ''); ?>>Laki-Laki
                </option>
              </select>
            </div>

            <!-- Dropdown Kategori Masuk -->
            <div class="form-group">
              <select name="kat_masuk" required>
                <option value="" disabled <?php echo e(old('kat_masuk', $santri->kat_masuk) ? '' : 'selected'); ?>>Masukan Kategori
                  Masuk</option>
                <option value="Umum" <?php echo e(old('kat_masuk', $santri->kat_masuk) == 'Umum' ? 'selected' : ''); ?>>Umum</option>
                <option value="Beasiswa" <?php echo e(old('kat_masuk', $santri->kat_masuk) == 'Beasiswa' ? 'selected' : ''); ?>>
                  Beasiswa</option>
              </select>
            </div>

            <!-- Dropdown Kelas -->
            <div class="form-group">
              <select name="kelas" required>
                <option value="" disabled <?php echo e(old('kelas', $santri->kelas) ? '' : 'selected'); ?>>Masukan Kelas</option>
                <option value="Halaqah A" <?php echo e(old('kelas', $santri->kelas) == 'Halaqah A' ? 'selected' : ''); ?>>Halaqah A</option>
                <option value="Halaqah B" <?php echo e(old('kelas', $santri->kelas) == 'Halaqah B' ? 'selected' : ''); ?>>Halaqah B</option>
                <option value="Halaqah C" <?php echo e(old('kelas', $santri->kelas) == 'Halaqah C' ? 'selected' : ''); ?>>Halaqah C</option>
                <option value="Halaqah D" <?php echo e(old('kelas', $santri->kelas) == 'Halaqah D' ? 'selected' : ''); ?>>Halaqah D</option>
                <option value="Halaqah E" <?php echo e(old('kelas', $santri->kelas) == 'Halaqah E' ? 'selected' : ''); ?>>Halaqah E</option>
              </select>
            </div>

            <div class="form-group">
              <select name="periode_id" required>
                <option value="" disabled <?php echo e(old('periode_id', $santri->periode_id) ? '' : 'selected'); ?>>Pilih Periode
                </option>
                <?php $__currentLoopData = $periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($periode->id); ?>" <?php echo e(old('periode_id', $santri->periode_id) == $periode->id ? 'selected' : ''); ?>>
            <?php echo e($periode->tahun_ajaran); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <!-- Dropdown Jenis Kelas -->
            <div class="form-group">
              <select name="jenis_kelas" required>
                <option value="" disabled <?php echo e(old('jenis_kelas', $santri->jenis_kelas) ? '' : 'selected'); ?>>Jenis Kelas
                </option>
                <option value="1 Tahun" <?php echo e(old('jenis_kelas', $santri->jenis_kelas) == '1 Tahun' ? 'selected' : ''); ?>>1
                  Tahun</option>
                <option value="2 Tahun" <?php echo e(old('jenis_kelas', $santri->jenis_kelas) == '2 Tahun' ? 'selected' : ''); ?>>2
                  Tahun</option>
              </select>
            </div>

            <!-- Dropdown Cabang -->
            <div class="form-group">
              <select name="cabang" required>
                <option value="" disabled <?php echo e(old('cabang', $santri->cabang) ? '' : 'selected'); ?>>Masukan Cabang</option>
                <?php $__currentLoopData = ['Sukajadi', 'Rumbai', 'Gobah 1', 'Gobah 2', 'Rawa Bening']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($cabang); ?>" <?php echo e(old('cabang', $santri->cabang) == $cabang ? 'selected' : ''); ?>>
            <?php echo e($cabang); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="button-group">
              <a href="<?php echo e(route('admin.datasantri.index')); ?>" class="cancel-btn">Cancel</a>
              <button class="add-btn" type="submit">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const input = document.getElementById('tanggal_lahir');
      const label = document.querySelector('.date-placeholder');

      function toggleLabel() {
        if (input.value) {
          label.style.opacity = '0';
          label.style.visibility = 'hidden';
        } else {
          label.style.opacity = '1';
          label.style.visibility = 'visible';
        }
      }

      input.addEventListener('input', toggleLabel);
      toggleLabel();
    });
  </script>
</body>

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/admin/datasantri/edit.blade.php ENDPATH**/ ?>