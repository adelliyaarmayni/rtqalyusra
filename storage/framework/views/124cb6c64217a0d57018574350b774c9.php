<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTQ Al-Yusra | Kehadiran & Dokumentasi Admin</title>
    <link rel="shortcut icon" href="<?php echo e(asset('img/image/logortq.png')); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

</head>

<body>

    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <img src="<?php echo e(asset('img/image/akun.png')); ?>" alt="Foto Admin"
                        style="width: 40px; height: 40px; border-radius: 40%;">
                    <strong>Admin</strong>
                </div>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <img src="<?php echo e(asset('img/image/logout.png')); ?>" alt="Logout" style="width: 18px; height: 18px;">
                    </button>
                </form>
            </div>

            <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
            <a href="<?php echo e(route('admin.jadwalmengajar.index')); ?>">Jadwal Mengajar</a>
            <a href="<?php echo e(route('admin.dataguru.index')); ?>">Data Guru</a>
            <a href="<?php echo e(route('admin.datasantri.index')); ?>">Data Santri</a>
            <a href="<?php echo e(route('admin.kelolapengguna.index')); ?>">Kelola Pengguna</a>
            <a href="<?php echo e(route('admin.periode.index')); ?>">Periode</a>
            <a href="<?php echo e(route('admin.kategoripenilaian.index')); ?>">Kategori Penilaian</a>
            <a href="<?php echo e(route('admin.kehadiranA.index')); ?>" class="active">Kehadiran</a>
            <a href="<?php echo e(route('admin.hafalanadmin.index')); ?>">Hafalan Santri</a>
            <a href="<?php echo e(route('admin.kinerjaguru.index')); ?>">Kinerja Guru</a>
        </div>


        <div class="main">
            <div class="topbar">
                <h1>Data Kehadiran & Dokumentasi</h1>
                <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo RTQ" height="100" />
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

            
            <form method="GET" action="<?php echo e(route('admin.kehadiranA.detail')); ?>">
                <div class="ka-form-container">
                    <div class="ka-form-group">
                        <div class="ka-form-row">
                            <div class="ka-form-item">
                                <select name="periode_id" id="periode_id">
                                    <option value="">Pilih Periode</option>
                                    <?php $__currentLoopData = $periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($periode->id); ?>"><?php echo e($periode->tahun_ajaran); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="ka-form-item">
                                <select name="cabang" id="cabang">
                                    <option value="">Semua Cabang</option>
                                    <?php $__currentLoopData = $cabangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cabang); ?>"><?php echo e($cabang); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="ka-form-row">
                            <div class="ka-form-item">
                                <select name="nama_guru" id="nama_guru">
                                    <option value="">Semua Guru</option>
                                    <?php $__currentLoopData = $namaGurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>"><?php echo e($nama); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="ka-form-item">
                                <select name="kelas" id="kelas">
                                    <option value="">Semua Kelas</option>
                                    <?php $__currentLoopData = $kelass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kelas); ?>"><?php echo e($kelas); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="ka-form-row">
                            <div class="ka-form-item">
                                <input type="date" name="tanggal" id="tanggal" value="<?php echo e(old('tanggal')); ?>">
                            </div>
                            <div class="ka-form-item">
                                <select name="kegiatan" id="kegiatan">
                                    <option value="">Semua Kegiatan</option>
                                    <?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kegiatan); ?>"><?php echo e($kegiatan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="ka-button-row">
                            <div class="ka-add-button">
                                <button type="submit" class="ka-add-btn">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
</body>

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/admin/kehadiranA/index.blade.php ENDPATH**/ ?>