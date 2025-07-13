<!-- resources/views/admin/datasantri/index.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RTQ Al-Yusra | Data Santri</title>
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
      <a href="{{ route('admin.jadwalmengajar.index') }}">Jadwal Mengajar</a>
      <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
      <a href="{{ route('admin.datasantri.index') }}" class="active">Data Santri</a>
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
        <h1>Data Santri</h1>
        <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" />
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

      <!-- Tabel Santri -->
      <div class="chart-container">
        <form method="GET" action="{{ route('admin.datasantri.index') }}" class="table-controls" style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; align-items: center;">
          <div>
              Show
              <select name="perPage" onchange="this.form.submit()">
                  @foreach([10, 25, 50, 100] as $size)
                      <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>
                          {{ $size }}
                      </option>
                  @endforeach
              </select>
          </div>
          <div class="flex-column-end">
              <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." />
              <a href="{{ route('admin.datasantri.create') }}">
                  <button type="button" class="add-btn">Add</button>
              </a>
          </div>
      </form>

        <div style="overflow-x:auto;">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Asal</th>
                <th>Kelas</th>
                <th>Periode</th>
                <th>Cabang</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($santris as $santri)
          <tr>
          <td>{{ $loop->iteration + ($santris->currentPage() - 1) * $santris->perPage() }}</td>
          <td>{{ $santri->nama_santri }}</td>
          <td>{{ $santri->tempat_lahir }}</td>
          <td>{{ \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d/m/Y') }}</td>
          <td>{{ $santri->asal }}</td>
          <td>{{ $santri->kelas }}</td>
          <td>{{ $santri->periode->tahun_ajaran ?? '-' }}</td>
          <td>{{ $santri->cabang }}</td>
          <td class="action-buttons">
            <a href="{{ route('admin.datasantri.edit', $santri->id) }}">
            <button><img src="{{ asset('img/image/edit.png') }}" alt="edit" height="20" /></button>
            </a>
            <a href="{{ route('admin.datasantri.show', $santri->id) }}">
            <button class="detail"><img src="{{ asset('img/image/detail.png') }}" alt="detail"
              height="20" /></button>
            </a>
            <form action="{{ route('admin.datasantri.destroy', $santri->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="delete"><img src="{{ asset('img/image/delete.png') }}" alt="delete"
              height="20" /></button>
            </form>
          </td>
          </tr>
        @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if ($santris->total() > 0)
          <div class="pagination">
            Showing {{ $santris->firstItem() }} to {{ $santris->lastItem() }} of {{ $santris->total() }} entries
          </div>
        @endif

        @if ($santris->hasPages())
          <div class="box-pagination-left">
            {{-- Tombol Previous --}}
            @if ($santris->onFirstPage())
              <span class="page-box-small disabled">«</span>
            @else
              <a href="{{ $santris->previousPageUrl() }}" class="page-box-small">«</a>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($santris->getUrlRange(1, $santris->lastPage()) as $page => $url)
              @if ($page == $santris->currentPage())
                <span class="page-box-small active">{{ $page }}</span>
              @else
                <a href="{{ $url }}" class="page-box-small">{{ $page }}</a>
              @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($santris->hasMorePages())
              <a href="{{ $santris->nextPageUrl() }}" class="page-box-small">»</a>
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