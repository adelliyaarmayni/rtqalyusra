<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RTQ Al-Yusra | Input Kinerja Guru</title>
    <link rel="shortcut icon" href="<?php echo e(asset('img/image/logortq.png')); ?>" type="image/x-icon">
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
            <a href="<?php echo e(route('yayasan.kehadiranY.index')); ?>">Kehadiran</a>
            <a href="<?php echo e(route('yayasan.hafalansantriY.index')); ?>">Hafalan Santri</a>
            <a href="<?php echo e(route('yayasan.kategorinilai.index')); ?>" class="active">Kinerja Guru</a>
        </div>

        <!-- Main Content -->
        <div class="main flex-1">
            <div class="gy-topbar bg-white flex justify-between items-center p-4 shadow">
                <div class="flex items-center gap-4">
                    <button class="hamburger" id="toggleSidebarBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-bold">Kinerja Guru</h1>
                </div>
                <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo" class="h-20 bg-white p-2 rounded" />
            </div>

            <div class="chart-container p-4">
                <div class="kny-form-group">

                    <div class="p-4">
                        <form method="GET" action="<?php echo e(route('yayasan.kategorinilai.index')); ?>" id="periodeForm"
                            class="mb-4">
                            <label for="periode" class="block font-semibold mb-1">Periode</label>
                            <select id="periode" name="periode_id"
                                onchange="document.getElementById('periodeForm').submit();"
                                class="w-full sm:w-60 p-2 border rounded">
                                <option value="">Pilih Periode</option>
                                <?php $__currentLoopData = $allPeriode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->id); ?>" <?php echo e($selectedPeriode == $p->id ? 'selected' : ''); ?>>
                                        <?php echo e($p->tahun_ajaran); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>

                        <form action="<?php echo e(route('yayasan.kategorinilai.store')); ?>" method="POST" class="space-y-6">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="periode_id" value="<?php echo e($selectedPeriode); ?>">

                            <!-- Flash Messages -->
                            <?php if(session('success')): ?>
                                <div class="bg-green-100 text-green-700 p-2 rounded"><?php echo e(session('success')); ?></div>
                            <?php endif; ?>
                            <?php if(session('error')): ?>
                                <div class="bg-red-100 text-red-700 p-2 rounded"><?php echo e(session('error')); ?></div>
                            <?php endif; ?>
                            <?php if($errors->any()): ?>
                                <ul class="bg-red-100 text-red-700 p-2 rounded">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>

                            <!-- Guru & Info -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-semibold">Nama Guru</label>
                                    <select id="nama-guru" name="nama_guru" class="w-full p-2 border rounded">
                                        <option value="">Pilih Nama Guru</option>
                                        <?php $__empty_1 = true; $__currentLoopData = $availableGuru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($g->nama_guru); ?>" <?php echo e(old('nama_guru', $guru->nama_guru ?? '') == $g->nama_guru ? 'selected' : ''); ?>><?php echo e($g->nama_guru); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <option disabled>Semua kinerja guru telah diinput untuk periode ini</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-semibold">Bagian</label>
                                    <div id="bagian" class="p-2 border rounded bg-gray-50"><?php echo e($guru->bagian ?? '-'); ?>

                                    </div>
                                </div>
                                <div>
                                    <label class="block font-semibold">Cabang</label>
                                    <div id="cabang" class="p-2 border rounded bg-gray-50"><?php echo e($guru->cabang ?? '-'); ?>

                                    </div>
                                </div>
                                <div>
                                    <label class="block font-semibold">Jumlah Telat</label>
                                    <input type="text" name="jumlah_terlambat_display" id="jumlahTelat" readonly
                                        class="w-full p-2 border rounded"
                                        value="<?php echo e(old('jumlahTelat', $jumlahTelat ?? 0)); ?>">
                                    <input type="hidden" name="jumlahTelat" id="hidden_jumlah_telat"
                                        value="<?php echo e(old('jumlahTelat', $jumlahTelat ?? 0)); ?>">
                                </div>
                            </div>

                            
                            <div class="kny-container-penilaian">
                                <div class="kny-penilaian-inner">
                                    <div class="space-y-4">
                                        <?php $__currentLoopData = $kategoriPertanyaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div>
                                                <label class="block font-semibold mb-1"><?php echo e($index + 1); ?>.
                                                    <?php echo e($kategori->kategori); ?></label>
                                                <div class="flex flex-wrap gap-4">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <label class="flex items-center gap-1">
                                                            <input type="radio" name="jawaban_kategori[<?php echo e($kategori->id); ?>]"
                                                                value="<?php echo e($i); ?>" <?php echo e(old("jawaban_kategori.{$kategori->id}") == $i ? 'checked' : ''); ?> required>
                                                            <?php echo e($i); ?>

                                                        </label>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                        </form>

                        <?php if($selectedPeriode && $availableGuru->isEmpty()): ?>
                            <div class="bg-blue-100 text-blue-700 p-2 rounded mt-4">
                                Semua kinerja guru telah diinput untuk periode
                                <strong><?php echo e($periode->tahun_ajaran ?? '-'); ?></strong>.
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="kny-button-group">
                        <button type="submit" class="kny-input-btn">Simpan</button>
                    </div>
                </div>
            </div>
            </form>

            
            <?php if($selectedPeriode && $availableGuru->isEmpty()): ?>
                <div class="alert alert-info mt-3">
                    Semua kinerja guru telah diinput untuk periode <strong><?php echo e($periode->tahun_ajaran ?? '-'); ?></strong>.
                </div>
            <?php endif; ?>
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
        document.addEventListener('DOMContentLoaded', function () {
            const guruSelect = document.getElementById('nama-guru');
            const periodeSelect = document.getElementById('periode');
            const bagianDiv = document.getElementById('bagian');
            const cabangDiv = document.getElementById('cabang');
            const jumlahTelatInput = document.getElementById('jumlahTelat');
            const hiddenJumlahTelatInput = document.getElementById('hidden_jumlah_telat');
            const namaGuru = guruSelect.options[guruSelect.selectedIndex].text;

            async function fetchGuruInfo(guruId) {
                if (!guruId) {
                    bagianDiv.innerText = '-';
                    cabangDiv.innerText = '-';
                    return;
                }
                try {
                    const response = await fetch(`/api/guru/${guruId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    const data = await response.json();
                    bagianDiv.innerText = data.bagian ?? '-';
                    cabangDiv.innerText = data.cabang ?? '-';
                } catch (error) {
                    console.error('Error fetching guru info:', error);
                    bagianDiv.innerText = '-';
                    cabangDiv.innerText = '-';
                }
            }

            async function fetchJumlahTerlambat(namaGuru, periodeId) {
                if (!namaGuru || !periodeId) {
                    jumlahTelatInput.value = '0';
                    hiddenJumlahTelatInput.value = '0';
                    return;
                }
                try {
                    const url = `/api/kinerja/calculate-terlambat?nama_guru=${encodeURIComponent(namaGuru)}&periode_id=${periodeId}`;
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    const data = await response.json();
                    jumlahTelatInput.value = data.jumlahTelat;
                    hiddenJumlahTelatInput.value = data.jumlahTelat;
                } catch (error) {
                    console.error('Error fetching jumlah terlambat:', error);
                    jumlahTelatInput.value = '0';
                    hiddenJumlahTelatInput.value = '0';
                }
            }

            function updateFormDetails() {
                const guruId = guruSelect.value;
                const periodeId = periodeSelect.value;

                fetchGuruInfo(guruId);
                fetchJumlahTerlambat(guruId, periodeId);
            }

            guruSelect.addEventListener('change', updateFormDetails);
            periodeSelect.addEventListener('change', updateFormDetails);

            // --- Initial Load Logic ---
            const initialGuruId = guruSelect.value;
            const initialPeriodeId = periodeSelect.value;

            // Trigger update jika ada nilai awal dari old input atau data yang di-pass ke view
            if (initialGuruId || initialPeriodeId) { // Mengubah kondisi agar tetap memuat jika hanya salah satu terisi
                updateFormDetails();
            } else {
                // Pastikan nilai default jika tidak ada initial selection
                bagianDiv.innerText = '-';
                cabangDiv.innerText = '-';
                jumlahTelatInput.value = '0';
                hiddenJumlahTelatInput.value = '0';
            }
        });
    </script>
</body>

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/yayasan/kategorinilai/index.blade.php ENDPATH**/ ?>