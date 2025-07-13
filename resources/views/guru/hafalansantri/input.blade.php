<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Hafalan Santri</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .gy-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
      height: 100vh;
      background-color: white;
      z-index: 50;
      padding: 1rem;
      transition: left 0.3s ease;
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
        left: -100%;
      }

      .gy-sidebar.active {
        left: 0;
      }

      .hamburger {
        display: inline-flex;
      }

      .main {
        margin-left: 0 !important;
      }
    }

    th,
    td {
      white-space: nowrap;
      padding: 8px;
    }

    @media (max-width: 640px) {
      table {
        font-size: 12px;
      }

      select,
      input {
        padding: 4px !important;
        font-size: 12px !important;
      }
    }
  </style>
</head>

<body>
  <div class="flex">
    <!-- Sidebar -->
    <div class="gy-sidebar" id="sidebar">
      <div class="sidebar-header flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
          <img src="{{ asset('img/image/akun.png') }}" alt="Foto Admin" class="w-10 h-10 rounded-full">
          <strong>Guru</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="{{ asset('img/image/logout.png') }}" alt="Logout" class="w-4 h-4">
          </button>
        </form>
      </div>
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('guru.kehadiranG.index') }}">Kehadiran</a>
      <a href="{{ route('guru.hafalansantri.index') }}" class="active">Hafalan Santri</a>
    </div>

    <!-- Main Content -->
    <div class="main flex-1">
      <div class="gy-topbar bg-white flex justify-between items-center p-4 shadow">
        <div class="flex items-center gap-4">
          <button class="hamburger" id="toggleSidebarBtn">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h1 class="text-lg md:text-xl font-bold">Input Hafalan Santri</h1>
        </div>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo" class="h-14 md:h-20 bg-white p-2 rounded" />
      </div>

      <form action="{{ route('guru.hafalansantri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Hidden Inputs -->
        <input type="hidden" name="kelas" value="{{ $namaKelas ?? 'N/A' }}">
        <input type="hidden" name="guru_id" value="{{ $guru->id ?? '' }}">
        <input type="hidden" name="periode_id" value="{{ $jadwal->first()?->periode?->id ?? '' }}">
        <input type="hidden" name="jadwal_mengajar_id" value="{{ $jadwal->first()?->id ?? '' }}">
        <input type="hidden" name="cabang" value="{{ $jadwal->first()->cabang ?? '' }}">

        <!-- Kontainer Form -->
        <div class="chart-container p-4 space-y-4">
          <div class="inline-block bg-[#A4E4B3] text-black px-3 py-1.5 rounded font-semibold">
                        {{ $namaKelas ?? 'N/A' }}
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        <div class="bg-gray-100 px-3 py-1.5 rounded text-xs sm:text-sm">{{ $guru->nama_guru ?? '-' }}</div>
                        <div class="bg-gray-100 px-3 py-1.5 rounded text-xs sm:text-sm">
                            {{ $jadwal->first()?->periode?->tahun_ajaran ?? '-' }}
                        </div>
                        <div class="bg-gray-100 px-3 py-1.5 rounded text-xs sm:text-sm">{{ $jadwal->first()->cabang ?? '-' }}</div>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-300 px-3 py-1.5 rounded text-xs sm:text-sm" required>
                    </div>

                    <!-- Grid Responsive -->
                    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($santri as $index => $s)
                            <div class="border rounded p-3 bg-white shadow-sm">
                                <p class="font-semibold text-sm mb-2">{{ $index + 1 }}. {{ $s->nama_santri }}</p>
                                <input type="hidden" name="hafalan[{{ $s->id }}][santri_id]" value="{{ $s->id }}">

                                <div class="mb-2">
                                    <label class="text-xs">Surah</label>
                                    <select name="hafalan[{{ $s->id }}][surah]" required
                                        class="border rounded px-2 py-1 w-full text-xs">
                                        <option value="">Pilih Surah</option>
                                        @foreach ($listSurah['data'] as $surah)
                                            <option value="{{ $surah['name']['transliteration']['id'] }}">
                                                {{ $surah['name']['transliteration']['id'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label class="text-xs">Juz</label>
                                    <select name="hafalan[{{ $s->id }}][juz]" required
                                        class="border rounded px-2 py-1 w-full text-xs">
                                        <option value="">Pilih Juz</option>
                                        @foreach ($listJuz['data'] as $juz)
                                            <option value="{{ $juz['juz'] }}">Juz {{ $juz['juz'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-xs">Ayat</label>
                                    <div class="flex gap-1">
                                        <input type="text" name="hafalan[{{ $s->id }}][ayat_awal]" placeholder="Awal"
                                            class="w-full border rounded px-2 py-1 text-xs" required>
                                        <span class="self-center">-</span>
                                        <input type="text" name="hafalan[{{ $s->id }}][ayat_akhir]" placeholder="Akhir"
                                            class="w-full border rounded px-2 py-1 text-xs" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="w-full text-right mt-3">
                        <button type="submit"
                            class="bg-[#A4E4B3] hover:bg-green-600 text-black font-semibold text-xs sm:text-sm py-2 px-5 rounded shadow">
                            Simpan
                        </button>
                    </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebarBtn');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      toggleBtn.style.display = sidebar.classList.contains('active') ? 'none' : 'inline-flex';
    });

    document.addEventListener('click', function (e) {
      if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
        sidebar.classList.remove('active');
        toggleBtn.style.display = 'inline-flex';
      }
    });
  </script>
</body>

</html>