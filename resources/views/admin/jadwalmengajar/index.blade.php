<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RTQ Al-Yusra | Jadwal Mengajar</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Profil & Logout -->
      <div class="sidebar-header">
        <!-- Profil -->
        <div style="display: flex; align-items: center; gap: 8px;">
          <img src="{{ asset('img/image/akun.png') }}" alt="Foto Admin"
            style="width: 40px; height: 40px; border-radius: 40%;">
          <strong>Admin</strong>
        </div>

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="{{ asset('img/image/logout.png') }}" alt="Logout" style="width: 18px; height: 18px;">
          </button>
        </form>
      </div>

      <!-- Menu -->
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('admin.jadwalmengajar.index') }}" class="active">Jadwal Mengajar</a>
      <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
      <a href="{{ route('admin.datasantri.index') }}">Data Santri</a>
      <a href="{{ route('admin.kelolapengguna.index') }}">Kelola Pengguna</a>
      <a href="{{ route('admin.periode.index') }}">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="topbar">
        <h1>Jadwal Mengajar</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
      </div>

      @if (session('success'))
      <div class="alert-success">
      {{ session('success') }}
      </div>
    @endif

      @if (session('error'))
      <div class="alert-error">
      {{ session('error') }}
      </div>
    @endif

      <div class="chart-container">
      {{-- Filter Form --}}
      <form method="GET" action="{{ route('admin.jadwalmengajar.index') }}" id="filterForm" class="table-controls" style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; align-items: center;">
        <div>
          Show
          <select name="per_page" id="per_page">
            @foreach([10, 25, 50, 100] as $limit)
              <option value="{{ $limit }}" {{ request('per_page', 10) == $limit ? 'selected' : '' }}>
                {{ $limit }}
              </option>
            @endforeach
          </select>
        </div>
        <div style="display: flex; flex-direction: column; align-items: flex-end;">
          <input type="text" name="search" id="search" placeholder="Search..." value="{{ request('search') }}" />
          <a href="{{ route('admin.jadwalmengajar.create') }}">
            <button type="button" class="add-btn">Add</button>
          </a>
        </div>
      </form>

        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Guru</th
                ><th>Kelas</th>
                <th>Cabang</th>
                <th>Periode</th>
                <th>Kegiatan</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($jadwals as $j)
                <tr>
                  <td>{{ ($jadwals->currentPage() - 1) * $jadwals->perPage() + $loop->iteration }}</td>
                  <td>{{ $j->guru->nama_guru }}</td>
                  <td>{{ $j->kelas }}</td>
                  <td>{{ $j->cabang }}</td>
                  <td>{{ $j->periode->tahun_ajaran }}</td>
                  <td>{{ $j->kegiatan }}</td>
                  <td>{{ $j->jam_masuk }}</td>
                  <td>{{ $j->jam_keluar }}</td>
                  <td class="action-buttons">
                    <a href="{{ route('admin.jadwalmengajar.edit', $j->id) }}">
                      <button><img src="{{ asset('img/image/edit.png') }}" height="20"/></button>
                    </a>
                    <form action="{{ route('admin.jadwalmengajar.destroy', $j->id) }}" method="POST" style="display:inline-block;">
                      @csrf @method('DELETE')
                      <button onclick="return confirm('Yakin hapus?')" class="delete">
                        <img src="{{ asset('img/image/delete.png') }}" height="20"/>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="9" style="text-align:center;">Tidak ada data</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if ($jadwals->total() > 0)
          <div class="pagination">
            Showing {{ $jadwals->firstItem() }} to {{ $jadwals->lastItem() }} of {{ $jadwals->total() }} entries
          </div>
        @endif

        @if ($jadwals->hasPages())
          <div class="box-pagination-left">
            {{-- Tombol Previous --}}
            @if ($jadwals->onFirstPage())
              <span class="page-box-small disabled">«</span>
            @else
              <a href="{{ $jadwals->previousPageUrl() }}" class="page-box-small">«</a>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($jadwals->getUrlRange(1, $jadwals->lastPage()) as $page => $url)
              @if ($page == $jadwals->currentPage())
                <span class="page-box-small active">{{ $page }}</span>
              @else
                <a href="{{ $url }}" class="page-box-small">{{ $page }}</a>
              @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($jadwals->hasMorePages())
              <a href="{{ $jadwals->nextPageUrl() }}" class="page-box-small">»</a>
            @else
              <span class="page-box-small disabled">»</span>
            @endif
          </div>
        @endif
      </div>
    </div>
  </div>

  <script>
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

  document.addEventListener('DOMContentLoaded', function () {
    const filterForm = document.getElementById('filterForm');

    // Submit saat dropdown show per_page berubah
    document.getElementById('per_page').addEventListener('change', function () {
      filterForm.submit();
    });

    // Submit saat user mengetik search (delay 500ms)
    let debounceTimer;
    document.getElementById('search').addEventListener('input', function () {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        filterForm.submit();
      }, 500);
    });
  });
</script>
</body>
</html>
