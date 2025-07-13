<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RTQ Al-Yusra | Kinerja Guru</title>
  <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100" type="image/x-icon">
  <!-- style css -->
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
      <a href="{{ route('admin.datasantri.index') }}">Data Santri</a>
      <a href="{{ route('admin.kelolapengguna.index') }}">Kelola Pengguna</a>
      <a href="{{ route('admin.periode.index') }}">Periode</a>
      <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
      <a href="{{ route('admin.kehadiranA.index') }}">Kehadiran</a>
      <a href="{{ route('admin.hafalanadmin.index') }}">Hafalan Santri</a>
      <a href="{{ route('admin.kinerjaguru.index') }}" class="active">Kinerja Guru</a>
    </div>

  <!-- Main Content -->
<div class="main">
  <div class="topbar">
    <h1>Kinerja Guru</h1>
    <img src="{{ asset('img/image/logortq.png') }}" alt="Logo RTQ" height="100"/>
  </div>

  <div class="ka-form-container">
    <div class="kg-form-group">

      <!-- Filter Periode -->
      <form method="GET" action="{{ route('admin.kinerjaguru.index') }}">
        <div class="kg-form-row">
          <div class="kg-form-item">
            <select name="periode" onchange="this.form.submit()">
              <option value="">Pilih Periode</option>
              @foreach($periodes as $p)
                <option value="{{ $p->tahun_ajaran }}" {{ $periodeFilter == $p->tahun_ajaran ? 'selected' : '' }}>
                  {{ $p->tahun_ajaran }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </form>

      <!-- Tabel Kinerja Guru -->
      <div style="overflow-x:auto;">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Guru</th>
              <th>Cabang</th>
              <th>Keterlambatan</th>
              @foreach($kategoriList as $kategori)
                <th>{{ $kategori->kategori }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @forelse($kinerjaList as $index => $item)
              <tr>
                <td>{{ ($kinerjaList->currentPage() - 1) * $kinerjaList->perPage() + $loop->iteration }}</td>
                <td>{{ $item['nama_guru'] }}</td>
                <td>{{ $item['cabang'] }}</td>
                <td>{{ $item['jumlahTelat'] }}</td>
                @foreach($item['penilaian'] as $nilai)
                  <td>{{ $nilai }}</td>
                @endforeach
              </tr>
            @empty
              <tr>
                <td colspan="{{ 4 + count($kategoriList) }}" style="text-align: center;">Belum ada data untuk periode ini.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination Section -->
      @if ($kinerjaList->total() > 0)
        <div class="pagination" style="margin-top: 1rem;">
          Showing {{ $kinerjaList->firstItem() }} to {{ $kinerjaList->lastItem() }} of {{ $kinerjaList->total() }} entries
        </div>
      @endif

      @if ($kinerjaList->hasPages())
        <div class="box-pagination-left">
          {{-- Tombol Previous --}}
          @if ($kinerjaList->onFirstPage())
            <span class="page-box-small disabled">«</span>
          @else
            <a href="{{ $kinerjaList->previousPageUrl() }}" class="page-box-small">«</a>
          @endif

          {{-- Nomor Halaman --}}
          @foreach ($kinerjaList->getUrlRange(1, $kinerjaList->lastPage()) as $page => $url)
            @if ($page == $kinerjaList->currentPage())
              <span class="page-box-small active">{{ $page }}</span>
            @else
              <a href="{{ $url }}" class="page-box-small">{{ $page }}</a>
            @endif
          @endforeach

          {{-- Tombol Next --}}
          @if ($kinerjaList->hasMorePages())
            <a href="{{ $kinerjaList->nextPageUrl() }}" class="page-box-small">»</a>
          @else
            <span class="page-box-small disabled">»</span>
          @endif
        </div>
      @endif

    </div>
  </div>
</div>
</body>
</html>