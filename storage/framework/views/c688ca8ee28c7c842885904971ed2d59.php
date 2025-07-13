<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Edit Data Guru</title>
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
      <a href="<?php echo e(route('admin.dataguru.index')); ?>" class="active">Data Guru</a>
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
        <h1>Edit Data Guru</h1>
        <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo RTQ" height="100" />
      </div>

      <!-- Form Edit Data Guru -->
      <div class="form-container">
        <div class="form-content">
          <form action="<?php echo e(route('admin.dataguru.update', $guru->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
              <input type="text" name="nama_guru" id="nama_guru" placeholder="Masukan Nama Guru"
                value="<?php echo e(old('nama_guru', $guru->nama_guru)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir"
                value="<?php echo e(old('tempat_lahir', $guru->tempat_lahir)); ?>" required>
            </div>

            <div class="form-group date-wrapper">
              <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                value="<?php echo e(old('tanggal_lahir', $guru->tanggal_lahir)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat"
                value="<?php echo e(old('alamat', $guru->alamat)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="no_hp" id="no_hp" placeholder="Masukan Nomor HP"
                value="<?php echo e(old('no_hp', $guru->no_hp)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="email" id="email" placeholder="Masukan Email"
                value="<?php echo e(old('email', $guru->email)); ?>" required>
            </div>

            <div class="form-group">
              <input type="text" name="jlh_hafalan" id="jlh_hafalan" placeholder="Masukan Jumlah Hafalan"
                value="<?php echo e(old('jlh_hafalan', $guru->jlh_hafalan)); ?>" required>
            </div>

            <!-- Dropdown Jenis Kelamin -->
            <div class="form-group">
              <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="" disabled <?php echo e(old('jenis_kelamin', $guru->jenis_kelamin) ? '' : 'selected'); ?>>
                  Jenis Kelamin
                </option>
                <option value="P" <?php echo e(old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : ''); ?>>Perempuan
                </option>
                <option value="L" <?php echo e(old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : ''); ?>>Laki-laki
                </option>
              </select>
            </div>

            <!-- Dropdown Pendidikan Terakhir -->
            <div class="form-group">
              <select name="pend_akhir" id="pend_akhir" required>
                <option value="" disabled <?php echo e(old('pend_akhir', $guru->pend_akhir) ? '' : 'selected'); ?>>
                  Pendidikan Terakhir
                </option>
                <option value="SD" <?php echo e(old('pend_akhir', $guru->pend_akhir) == 'SD' ? 'selected' : ''); ?>>SD</option>
                <option value="SMP" <?php echo e(old('pend_akhir', $guru->pend_akhir) == 'SMP/Sederajat' ? 'selected' : ''); ?>>SMP/Sederajat</option>
                <option value="SMA" <?php echo e(old('pend_akhir', $guru->pend_akhir) == 'SMA/Sederajat' ? 'selected' : ''); ?>>SMA/Sederajat</option>
                <option value="S1" <?php echo e(old('pend_akhir', $guru->pend_akhir) == 'S1' ? 'selected' : ''); ?>>S1</option>
                <option value="S2" <?php echo e(old('pend_akhir', $guru->pend_akhir) == 'S2' ? 'selected' : ''); ?>>S2</option>
                <option value="S3" <?php echo e(old('pend_akhir', $guru->pend_akhir) == 'S3' ? 'selected' : ''); ?>>S3</option>
              </select>
            </div>

            <!-- Dropdown Golongan Darah -->
            <div class="form-group">
              <select name="gol_dar" id="gol_dar" required>
                <option value="" disabled <?php echo e(old('gol_dar', $guru->gol_dar) ? '' : 'selected'); ?>>
                  Golongan Darah
                </option>
                <option value="A" <?php echo e(old('gol_dar', $guru->gol_dar) == 'A' ? 'selected' : ''); ?>>A</option>
                <option value="AB" <?php echo e(old('gol_dar', $guru->gol_dar) == 'AB' ? 'selected' : ''); ?>>AB</option>
                <option value="B" <?php echo e(old('gol_dar', $guru->gol_dar) == 'B' ? 'selected' : ''); ?>>B</option>
                <option value="O" <?php echo e(old('gol_dar', $guru->gol_dar) == 'O' ? 'selected' : ''); ?>>O</option>
              </select>
            </div>

            <!-- Dropdown Masa Kerja (MK) -->
            <div class="form-group small-label">
              <select name="mk" id="mk" required>
                <option value="" disabled <?php echo e(old('mk', $guru->mk) ? '' : 'selected'); ?>>Masukan MK</option>
                <option value="Si" <?php echo e(old('mk', $guru->mk) == 'Si' ? 'selected' : ''); ?>>Si</option>
                <option value="Se" <?php echo e(old('mk', $guru->mk) == 'Se' ? 'selected' : ''); ?>>Se</option>
                <option value="Ti" <?php echo e(old('mk', $guru->mk) == 'Ti' ? 'selected' : ''); ?>>Ti</option>
                <option value="Te" <?php echo e(old('mk', $guru->mk) == 'Te' ? 'selected' : ''); ?>>Te</option>
                <option value="In" <?php echo e(old('mk', $guru->mk) == 'In' ? 'selected' : ''); ?>>In</option>
                <option value="Fi" <?php echo e(old('mk', $guru->mk) == 'Fi' ? 'selected' : ''); ?>>Fi</option>
                <option value="Fe" <?php echo e(old('mk', $guru->mk) == 'Fe' ? 'selected' : ''); ?>>Fe</option>
                <option value="Ii" <?php echo e(old('mk', $guru->mk) == 'Ii' ? 'selected' : ''); ?>>Ii</option>
                <option value="Ie" <?php echo e(old('mk', $guru->mk) == 'Ie' ? 'selected' : ''); ?>>Ie</option>
              </select>
            </div>

            <!-- Dropdown Status Menikah -->
            <div class="form-group">
              <select name="status_menikah" id="status_menikah" required>
                <option value="" disabled <?php echo e(old('status_menikah', $guru->status_menikah) ? '' : 'selected'); ?>>
                  Status Menikah
                </option>
                <option value="Menikah" <?php echo e(old('status_menikah', $guru->status_menikah) == 'Menikah' ? 'selected' : ''); ?>>
                  Menikah
                </option>
                <option value="Belum Menikah" <?php echo e(old('status_menikah', $guru->status_menikah) == 'Belum Menikah' ? 'selected' : ''); ?>>Belum Menikah
                </option>
              </select>
            </div>

            <!-- Dropdown Bagian -->
            <div class="form-group">
              <select name="bagian" id="bagian" required>
                <option value="" disabled <?php echo e(old('bagian', $guru->bagian ?? '') == '' ? 'selected' : ''); ?>>Masukan Bagian
                </option>
                <option value="Admin" <?php echo e(old('bagian', $guru->bagian ?? '') == 'Admin' ? 'selected' : ''); ?>>Admin</option>
                <option value="Yayasan" <?php echo e(old('bagian', $guru->bagian ?? '') == 'Yayasan' ? 'selected' : ''); ?>>Yayasan
                </option>
                <option value="Guru Kelas" <?php echo e(old('bagian', $guru->bagian ?? '') == 'Guru Kelas' ? 'selected' : ''); ?>>Guru
                  Kelas</option>
              </select>
            </div>

            <!-- Dropdown Cabang -->
            <div class="form-group">
              <select name="cabang" id="cabang" required>
                <option value="" disabled>Masukan Cabang</option>
                <option value="Sukajadi" <?php echo e(old('cabang', $guru->cabang) == 'Sukajadi' ? 'selected' : ''); ?>>Sukajadi
                </option>
                <option value="Rumbai" <?php echo e(old('cabang', $guru->cabang) == 'Rumbai' ? 'selected' : ''); ?>>Rumbai
                </option>
                <option value="Gobah 1" <?php echo e(old('cabang', $guru->cabang) == 'Gobah 1' ? 'selected' : ''); ?>>Gobah 1</option>
                <option value="Gobah 2" <?php echo e(old('cabang', $guru->cabang) == 'Gobah 2' ? 'selected' : ''); ?>>Gobah 2</option>
                <option value="Rawa Bening" <?php echo e(old('cabang', $guru->cabang) == 'Rawa Bening' ? 'selected' : ''); ?>>Rawa
                  Bening
                </option>
              </select>
            </div>

            <div class="button-group">
              <a href="<?php echo e(route('admin.dataguru.index')); ?>" class="cancel-btn">Cancel</a>
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

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/admin/dataguru/edit.blade.php ENDPATH**/ ?>