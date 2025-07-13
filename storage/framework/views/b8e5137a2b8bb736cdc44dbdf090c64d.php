<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RTQ Al-Yusra | Hafalan Santri</title>
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
                    <img src="<?php echo e(asset('img/image/akun.png')); ?>" alt="Foto Admin" class="w-10 h-10 rounded-full">
                    <strong>Guru</strong>
                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <img src="<?php echo e(asset('img/image/logout.png')); ?>" alt="Logout" class="w-4 h-4">
                    </button>
                </form>
            </div>
            <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
            <a href="<?php echo e(route('guru.kehadiranG.index')); ?>">Kehadiran</a>
            <a href="<?php echo e(route('guru.hafalansantri.index')); ?>" class="active">Hafalan Santri</a>
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
                    <h1 class="text-xl font-bold">Detail Hafalan Santri</h1>
                </div>
                <img src="<?php echo e(asset('img/image/logortq.png')); ?>" alt="Logo" class="h-20 bg-white p-2 rounded" />
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
                <div class="dk-form-row">
                    <label>Pilih Tanggal</label>
                    <div class="dk-form-item">
                        <input type="date" id="tanggalFilter" name="tanggalFilter" value="<?php echo e(date('Y-m-d')); ?>">
                    </div>
                </div>
                <div id="kehadiranTableContainer">
                    <div class="loading-indicator" id="loadingIndicator">Memuat data...</div>
                    <div class="alert alert-info" id="noDataMessage" style="display: none;">Tidak ada data hafalan
                        untuk tanggal ini.</div>
                    <table id="hafalanTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Santri</th>
                                <th>Surah</th>
                                <th>Juz</th>
                                <th>Ayat Awal</th>
                                <th>Ayat Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="box-pagination-left" id="paginationContainer"></div>
                </div>

                <div class="gki-button-group">
                    <a href="<?php echo e(route('guru.hafalansantri.index')); ?>">
                        <button class="gki-input-btn">Kembali</button>
                    </a>
                </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            const tanggalFilterInput = document.getElementById('tanggalFilter');
            const hafalanTableBody = document.querySelector('#hafalanTable tbody');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const noDataMessage = document.getElementById('noDataMessage');

            let currentPage = 1;
            function loadHafalanData(tanggal, page = 1) {
                hafalanTableBody.innerHTML = '';
                loadingIndicator.style.display = 'block';
                noDataMessage.style.display = 'none';

                const kelas = "<?php echo e($kelas); ?>";
                const url = `/guru/hafalansantri/detail/${kelas}/${tanggal}?periode_id=<?php echo e($selectedPeriode); ?>&page=${page}`;

                fetch(url)
                    .then(response => response.json())
                    .then(response => {
                        loadingIndicator.style.display = 'none';

                        const data = response.data || [];
                        const pagination = response.pagination || {};

                        if (data.length > 0) {
                            data.forEach((item, index) => {
                                const row = `
                                    <tr>
                                        <td>${(pagination.current_page - 1) * pagination.per_page + index + 1}</td>
                                        <td>${item.santri?.nama_santri ?? '-'}</td>
                                        <td>${item.surah ?? '-'}</td>
                                        <td>${item.juz ?? '-'}</td>
                                        <td>${item.ayat_awal ?? '-'}</td>
                                        <td>${item.ayat_akhir ?? '-'}</td>
                                    </tr>
                                `;
                                hafalanTableBody.insertAdjacentHTML('beforeend', row);
                            });
                            renderPagination(pagination);
                        } else {
                            noDataMessage.style.display = 'block';
                        }
                    })
                    .catch(() => {
                        loadingIndicator.style.display = 'none';
                        hafalanTableBody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:red;">Gagal memuat data.</td></tr>`;
                    });
            }

            function renderPagination(pagination) {
                const container = document.querySelector('#paginationContainer');
                container.innerHTML = '';
                const totalPages = Math.ceil(pagination.total / pagination.per_page);
                currentPage = pagination.current_page;

                // Tombol <<
                const prevBtn = document.createElement('a');
                prevBtn.textContent = '«';
                prevBtn.href = '#';
                prevBtn.className = 'page-box-small' + (currentPage === 1 ? ' disabled' : '');
                prevBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        loadHafalanData(tanggalFilterInput.value, currentPage);
                    }
                });
                container.appendChild(prevBtn);

                // Tombol Angka
                for (let i = 1; i <= totalPages; i++) {
                    const pageBtn = document.createElement('a');
                    pageBtn.classList.add('page-box-small');
                    if (i === currentPage) pageBtn.classList.add('active');
                    pageBtn.innerText = i;
                    pageBtn.href = '#';
                    pageBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        currentPage = i;
                        loadHafalanData(tanggalFilterInput.value, i);
                    });
                    container.appendChild(pageBtn);
                }

                // Tombol >>
                const nextBtn = document.createElement('a');
                nextBtn.textContent = '»';
                nextBtn.href = '#';
                nextBtn.className = 'page-box-small' + (currentPage === totalPages ? ' disabled' : '');
                nextBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (currentPage < totalPages) {
                        currentPage++;
                        loadHafalanData(tanggalFilterInput.value, currentPage);
                    }
                });
                container.appendChild(nextBtn);
            }


            if (tanggalFilterInput) {
                tanggalFilterInput.addEventListener('change', function () {
                    loadHafalanData(this.value);
                });

                // Load awal
                loadHafalanData(tanggalFilterInput.value);
            }
        });
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

</html><?php /**PATH D:\Adel\Semester 8\TA Adel\Sistem\sistemrtq\resources\views/guru/hafalansantri/detail.blade.php ENDPATH**/ ?>