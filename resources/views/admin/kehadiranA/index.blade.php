<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTQ Al-Yusra | Kehadiran & Dokumentasi Admin</title>
    <link rel="shortcut icon" href="{{ asset('img/image/logortq.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <img src="{{ asset('img/image/akun.png') }}" alt="Foto Admin"
                        style="width: 40px; height: 40px; border-radius: 40%;">
                    <strong>Admin</strong>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <img src="{{ asset('img/image/logout.png') }}" alt="Logout" style="width: 18px; height: 18px;">
                    </button>
                </form>
            </div>

            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.jadwalmengajar.index') }}">Jadwal Mengajar</a>
            <a href="{{ route('admin.dataguru.index') }}">Data Guru</a>
            <a href="{{ route('admin.datasantri.index') }}">Data Santri</a>
            <a href="{{ route('admin.kelolapengguna.index') }}">Kelola Pengguna</a>
            <a href="{{ route('admin.periode.index') }}">Periode</a>
            <a href="{{ route('admin.kategoripenilaian.index') }}">Kategori Penilaian</a>
            <a href="{{ route('admin.kehadiranA.index') }}" class="active">Kehadiran</a>
            <a href="{{ route('admin.hafalanadmin.index') }}">Hafalan Santri</a>
            <a href="{{ route('admin.kinerjaguru.index') }}">Kinerja Guru</a>
        </div>


        <div class="main">
            <div class="topbar">
                <h1>Data Kehadiran & Dokumentasi</h1>
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

            {{-- Filter Section --}}
            <form method="GET" action="{{ route('admin.kehadiranA.detail') }}">
                <div class="ka-form-container">
                    <div class="ka-form-group">
                        <div class="ka-form-row">
                            <div class="ka-form-item">
                                <select name="periode_id" id="periode_id">
                                    <option value="">Pilih Periode</option>
                                    @foreach($periodes as $periode)
                                        <option value="{{ $periode->id }}">{{ $periode->tahun_ajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="ka-form-item">
                                <select name="cabang" id="cabang">
                                    <option value="">Semua Cabang</option>
                                    @foreach($cabangs as $cabang)
                                        <option value="{{ $cabang }}">{{ $cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="ka-form-row">
                            <div class="ka-form-item">
                                <select name="nama_guru" id="nama_guru">
                                    <option value="">Semua Guru</option>
                                    @foreach($namaGurus as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="ka-form-item">
                                <select name="kelas" id="kelas">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelass as $kelas)
                                        <option value="{{ $kelas }}">{{ $kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="ka-form-row">
                            <div class="ka-form-item">
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                            </div>
                            <div class="ka-form-item">
                                <select name="kegiatan" id="kegiatan">
                                    <option value="">Semua Kegiatan</option>
                                    @foreach($kegiatans as $kegiatan)
                                        <option value="{{ $kegiatan }}">{{ $kegiatan }}</option>
                                    @endforeach
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

</html>