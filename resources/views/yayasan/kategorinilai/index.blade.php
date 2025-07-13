<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RTQ Al-Yusra | Input Kinerja Guru</title>
    <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                    <img src="{{ asset('img/image/akun.png') }}" alt="Foto Admin"
                        style="width: 40px; height: 40px; border-radius: 50%;">
                    <strong>Guru</strong>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <img src="{{ asset('img/image/logout.png') }}" alt="Logout" style="width: 18px; height: 18px;">
                    </button>
                </form>
            </div>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('yayasan.kehadiranY.index') }}">Kehadiran</a>
            <a href="{{ route('yayasan.hafalansantriY.index') }}">Hafalan Santri</a>
            <a href="{{ route('yayasan.kategorinilai.index') }}" class="active">Kinerja Guru</a>
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
                <img src="{{ asset('img/image/logortq.png') }}" alt="Logo" class="h-20 bg-white p-2 rounded" />
            </div>

            <div class="chart-container p-4">
                <div class="kny-form-group">

                    <div class="p-4">
                        <form method="GET" action="{{ route('yayasan.kategorinilai.index') }}" id="periodeForm"
                            class="mb-4">
                            <label for="periode" class="block font-semibold mb-1">Periode</label>
                            <select id="periode" name="periode_id"
                                onchange="document.getElementById('periodeForm').submit();"
                                class="w-full sm:w-60 p-2 border rounded">
                                <option value="">Pilih Periode</option>
                                @foreach ($allPeriode as $p)
                                    <option value="{{ $p->id }}" {{ $selectedPeriode == $p->id ? 'selected' : '' }}>
                                        {{ $p->tahun_ajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <form action="{{ route('yayasan.kategorinilai.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="periode_id" value="{{ $selectedPeriode }}">

                            <!-- Flash Messages -->
                            @if (session('success'))
                                <div class="bg-green-100 text-green-700 p-2 rounded">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="bg-red-100 text-red-700 p-2 rounded">{{ session('error') }}</div>
                            @endif
                            @if ($errors->any())
                                <ul class="bg-red-100 text-red-700 p-2 rounded">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <!-- Guru & Info -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-semibold">Nama Guru</label>
                                    <select id="nama-guru" name="nama_guru" class="w-full p-2 border rounded">
                                        <option value="">Pilih Nama Guru</option>
                                        @forelse ($availableGuru as $g)
                                            <option value="{{ $g->nama_guru }}" {{ old('nama_guru', $guru->nama_guru ?? '') == $g->nama_guru ? 'selected' : '' }}>{{ $g->nama_guru }}</option>
                                        @empty
                                            <option disabled>Semua kinerja guru telah diinput untuk periode ini</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-semibold">Bagian</label>
                                    <div id="bagian" class="p-2 border rounded bg-gray-50">{{ $guru->bagian ?? '-' }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-semibold">Cabang</label>
                                    <div id="cabang" class="p-2 border rounded bg-gray-50">{{ $guru->cabang ?? '-' }}
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-semibold">Jumlah Telat</label>
                                    <input type="text" name="jumlah_terlambat_display" id="jumlahTelat" readonly
                                        class="w-full p-2 border rounded"
                                        value="{{ old('jumlahTelat', $jumlahTelat ?? 0) }}">
                                    <input type="hidden" name="jumlahTelat" id="hidden_jumlah_telat"
                                        value="{{ old('jumlahTelat', $jumlahTelat ?? 0) }}">
                                </div>
                            </div>

                            {{-- Penilaian --}}
                            <div class="kny-container-penilaian">
                                <div class="kny-penilaian-inner">
                                    <div class="space-y-4">
                                        @foreach($kategoriPertanyaan as $index => $kategori)
                                            <div>
                                                <label class="block font-semibold mb-1">{{ $index + 1 }}.
                                                    {{ $kategori->kategori }}</label>
                                                <div class="flex flex-wrap gap-4">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <label class="flex items-center gap-1">
                                                            <input type="radio" name="jawaban_kategori[{{ $kategori->id }}]"
                                                                value="{{ $i }}" {{ old("jawaban_kategori.{$kategori->id}") == $i ? 'checked' : '' }} required>
                                                            {{ $i }}
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                        </form>

                        @if ($selectedPeriode && $availableGuru->isEmpty())
                            <div class="bg-blue-100 text-blue-700 p-2 rounded mt-4">
                                Semua kinerja guru telah diinput untuk periode
                                <strong>{{ $periode->tahun_ajaran ?? '-' }}</strong>.
                            </div>
                        @endif
                    </div>

                    <div class="kny-button-group">
                        <button type="submit" class="kny-input-btn">Simpan</button>
                    </div>
                </div>
            </div>
            </form>

            {{-- Info Semua Guru Sudah Dinilai --}}
            @if ($selectedPeriode && $availableGuru->isEmpty())
                <div class="alert alert-info mt-3">
                    Semua kinerja guru telah diinput untuk periode <strong>{{ $periode->tahun_ajaran ?? '-' }}</strong>.
                </div>
            @endif
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

</html>