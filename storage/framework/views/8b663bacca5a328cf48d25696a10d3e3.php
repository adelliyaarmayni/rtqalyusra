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
        .gy-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100%;
            background-color: white;
            z-index: 50;
            padding: 1rem;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .main {
            margin-left: 240px;
            flex: 1;
        }

        .hamburger {
            display: none;
        }

        @media (max-width: 768px) {
            .gy-sidebar {
                transform: translateX(-100%);
            }

            .gy-sidebar.active {
                transform: translateX(0);
            }

            .hamburger {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem;
                background-color: white;
                border-radius: 0.25rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                z-index: 60;
            }

            .main {
                margin-left: 0;
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-bold">Detail Kehadiran</h1>
                </div>
                <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo" class="h-20 bg-white p-2 rounded" />
            </div>

            <?php if(session('success')): ?>
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <div class="ka-form-container p-4">
                <div class="dkk-form-row">
                    <label>Pilih Tanggal</label>
                    <div class="dkk-form-item">
                        <input type="date" id="tanggalFilter" name="tanggalFilter" value="<?php echo e(date('Y-m-d')); ?>">
                    </div>
                </div>
                <input type="hidden" id="periodeId" value="<?php echo e($selectedPeriode); ?>">
                <div class="dkk-form-row">
                    <label>Pilih Kegiatan</label>
                    <div class="dkk-form-item">
                        <select id="kegiatanFilter" name="kegiatanFilter">
                            <option value="">-- Pilih Kegiatan --</option>
                            <?php $__currentLoopData = $listKegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kegiatan); ?>"><?php echo e($kegiatan); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="dkk-form-row">
                    <label>Dokumentasi</label>
                    <div class="dkk-form-item" id="dokumentasiContainer">
                        <p id="noDokumentasiMessage" style="display: none;">Tidak ada dokumentasi untuk tanggal ini.</p>
                    </div>
                </div>

                <div id="kehadiranTableContainer">
                    <div class="loading-indicator" id="loadingIndicator">Memuat data...</div>
                    <div class="alert alert-info" id="noDataMessage" style="display: none;">Tidak ada data kehadiran
                        untuk tanggal ini.</div>
                    <table id="kehadiranTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Santri</th>
                                <th>Status Kehadiran</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div id="paginationContainer" class="box-pagination-left"></div>
                </div>

                <div class="gki-button-group mt-4">
                    <a href="<?php echo e(route('guru.kehadiranG.index')); ?>">
                        <button class="gki-input-btn">Kembali</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebarBtn');

        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                toggleBtn.style.display = 'none';
            } else {
                toggleBtn.style.display = 'inline-flex';
            }
        });

        document.addEventListener('click', function (e) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('active');
                toggleBtn.style.display = 'inline-flex';
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            const tanggalFilterInput = document.getElementById('tanggalFilter');
            const kegiatanFilterInput = document.getElementById('kegiatanFilter');
            const kehadiranTableBody = document.querySelector('#kehadiranTable tbody');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const noDataMessage = document.getElementById('noDataMessage');
            const dokumentasiContainer = document.getElementById('dokumentasiContainer');
            const noDokumentasiMessage = document.getElementById('noDokumentasiMessage');

            const kelas = "<?php echo e($kelas); ?>";

            // Fungsi untuk memuat data kehadiran
            function loadKehadiranData(tanggal, kegiatan = '') {
                kehadiranTableBody.innerHTML = '';
                noDataMessage.style.display = 'none';
                loadingIndicator.style.display = 'block';

                const periodeId = document.getElementById('periodeId')?.value ?? '';

                const params = new URLSearchParams({
                    kegiatan: kegiatan,
                    periode_id: periodeId
                });
                const url = `/guru/detailKehadiran/${kelas}/${tanggal}?${params}`;

                console.log('loadKehadiranData - tanggal:', tanggal, 'kegiatan:', kegiatan, 'periode_id:', periodeId);

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        loadingIndicator.style.display = 'none';
                        if (data.length > 0) {
                            paginateData(data, 10);
                        } else {
                            noDataMessage.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        loadingIndicator.style.display = 'none';
                        console.error('Ada masalah dengan operasi fetch:', error);
                        kehadiranTableBody.innerHTML = `<tr><td colspan="5" style="color: red; text-align: center;">Gagal memuat data kehadiran.</td></tr>`;
                    });
            }

            function paginateData(data, itemsPerPage = 10) {
                const paginationContainer = document.getElementById('paginationContainer');
                const kehadiranTableBody = document.querySelector('#kehadiranTable tbody');

                let currentPage = 1;
                const totalPages = Math.ceil(data.length / itemsPerPage);

                function renderPage(page) {
                    kehadiranTableBody.innerHTML = '';
                    const start = (page - 1) * itemsPerPage;
                    const end = start + itemsPerPage;
                    const paginatedItems = data.slice(start, end);

                    paginatedItems.forEach((kehadiran, index) => {
                        const buktiHtml = kehadiran.bukti
                            ? `<a href="/storage/${kehadiran.bukti}" target="_blank">Lihat Bukti</a>`
                            : '-';

                        const row = `
                            <tr>
                                <td>${start + index + 1}</td>
                                <td>${kehadiran.santri ? kehadiran.santri.nama_santri : '-'}</td>
                                <td>${kehadiran.status_kehadiran ?? '-'}</td>
                                <td>${buktiHtml}</td>
                            </tr>
                        `;
                        kehadiranTableBody.insertAdjacentHTML('beforeend', row);
                    });

                    renderPaginationControls();
                }

                function renderPaginationControls() {
                    paginationContainer.innerHTML = '';

                    // Tombol Sebelumnya
                    const prevBtn = document.createElement('a');
                    prevBtn.textContent = '«';
                    prevBtn.href = '#';
                    prevBtn.className = 'page-box-small' + (currentPage === 1 ? ' disabled' : '');
                    prevBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        if (currentPage > 1) {
                            currentPage--;
                            renderPage(currentPage);
                        }
                    });
                    paginationContainer.appendChild(prevBtn);

                    // Nomor halaman
                    for (let i = 1; i <= totalPages; i++) {
                        const btn = document.createElement('a');
                        btn.textContent = i;
                        btn.href = '#';
                        btn.classList.add('page-box-small');
                        if (i === currentPage) btn.classList.add('active');

                        btn.addEventListener('click', function (e) {
                            e.preventDefault();
                            currentPage = i;
                            renderPage(currentPage);
                        });

                        paginationContainer.appendChild(btn);
                    }

                    // Tombol Berikutnya
                    const nextBtn = document.createElement('a');
                    nextBtn.textContent = '»';
                    nextBtn.href = '#';
                    nextBtn.className = 'page-box-small' + (currentPage === totalPages ? ' disabled' : '');
                    nextBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        if (currentPage < totalPages) {
                            currentPage++;
                            renderPage(currentPage);
                        }
                    });
                    paginationContainer.appendChild(nextBtn);
                }

                renderPage(currentPage);
            }

            // Fungsi untuk memuat dokumentasi
            async function loadDokumentasi(selectedDate, kegiatan = '') {
                dokumentasiContainer.innerHTML = '';
                noDokumentasiMessage.style.display = 'none';

                if (!selectedDate) {
                    noDokumentasiMessage.textContent = 'Silakan pilih tanggal.';
                    noDokumentasiMessage.style.display = 'block';
                    return;
                }

                const periodeId = document.getElementById('periodeId')?.value ?? '';

                const url = `/guru/detailKehadiran/dokumentasi/${selectedDate}?kegiatan=${encodeURIComponent(kegiatan)}&periode_id=${periodeId}`;

                try {
                    const response = await fetch(url);
                    const data = await response.json();

                    if (data.success && data.dokumentasi.length > 0) {
                        const fileUrl = data.dokumentasi[0]; // Ambil dokumentasi pertama
                        const linkWrapper = document.createElement('div');
                        linkWrapper.style.marginBottom = '10px';

                        const link = document.createElement('a');
                        link.href = fileUrl;
                        link.target = '_blank';
                        link.textContent = 'Lihat Dokumentasi';
                        link.style.color = '#007bff';
                        link.style.textDecoration = 'none';

                        linkWrapper.appendChild(link);
                        dokumentasiContainer.appendChild(linkWrapper);
                    } else {
                        noDokumentasiMessage.textContent = 'Tidak ada dokumentasi untuk tanggal ini.';
                        noDokumentasiMessage.style.display = 'block';
                    }
                } catch (error) {
                    console.error('Gagal memuat dokumentasi:', error);
                    dokumentasiContainer.innerHTML = '<p style="color: red;">Gagal memuat dokumentasi.</p>';
                }
            }

            // Trigger pertama kali saat halaman dibuka
            loadKehadiranData(tanggalFilterInput.value, kegiatanFilterInput.value);
            loadDokumentasi(tanggalFilterInput.value, kegiatanFilterInput.value);

            // Saat filter tanggal berubah
            tanggalFilterInput.addEventListener('change', function () {
                loadKehadiranData(this.value, kegiatanFilterInput.value);
                loadDokumentasi(this.value, kegiatanFilterInput.value);
            });

            // Saat filter kegiatan berubah
            kegiatanFilterInput.addEventListener('change', function () {
                loadKehadiranData(tanggalFilterInput.value, this.value);
                loadDokumentasi(tanggalFilterInput.value, this.value);
            });

            //menghilangkan alert setelah 2 detik
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
        });
    </script>

</body>

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/guru/detailKehadiran/detail.blade.php ENDPATH**/ ?>