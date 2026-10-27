
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV {{ $cv->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        body {
            background: #eef2f7;
            font-family: Arial, sans-serif;
            padding: 35px 15px;
        }

        .cv-card {
            max-width: 850px;
            margin: auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px #0002;
        }

        .cv-header {
            background: #123b68;
            color: white;
            padding: 32px;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .foto, .no-foto {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .foto {
            object-fit: cover;
            border: 4px solid white;
        }

        .no-foto {
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 13px;
        }

        .cv-header h1 {
            font-size: 30px;
            margin-bottom: 8px;
            overflow-wrap: anywhere;
        }

        .cv-header p {
            margin: 0;
            color: #dbeafe;
        }

        .cv-content {
            padding: 30px 35px;
        }

        .bagian {
            margin-bottom: 25px;
        }

        .bagian h3 {
            color: #123b68;
            font-size: 19px;
            font-weight: bold;
            border-bottom: 2px solid #123b68;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .biodata {
            display: grid;
            grid-template-columns: 170px 1fr;
            gap: 12px;
        }

        .label {
            font-weight: bold;
            color: #374151;
        }

        .nilai {
            overflow-wrap: anywhere;
        }

        .video-cv {
            display: block;
            width: 100%;
            max-width: 600px;
            max-height: 400px;
            background: #000;
            border-radius: 10px;
        }

        .aksi {
            max-width: 850px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 576px) {
            .cv-header {
                flex-direction: column;
                text-align: center;
            }

            .cv-content {
                padding: 25px 18px;
            }

            .biodata {
                grid-template-columns: 1fr;
                gap: 4px;
            }

            .nilai {
                margin-bottom: 10px;
            }
        }

        @media print {
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .cv-card {
                max-width: 100%;
                margin: 0;
                border-radius: 0;
                box-shadow: none;
                overflow: visible;
            }

            .cv-header {
                background: #123b68 !important;
                color: white !important;
            }

            .aksi, .bagian-video {
                display: none !important;
            }

            .bagian {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="cv-card">
    <div class="cv-header">
        @if ($cv->foto)
            <img src="{{ asset('storage/' . $cv->foto) }}"
                 alt="Foto {{ $cv->nama }}"
                 class="foto">
        @else
            <div class="no-foto">Belum ada foto</div>
        @endif

        <div>
            <h1>{{ $cv->nama }}</h1>
            <p>Curriculum Vitae</p>

            @if ($cv->email)
                <p>{{ $cv->email }}</p>
            @endif
        </div>
    </div>

    <div class="cv-content">
        <div class="bagian">
            <h3>Biodata Pribadi</h3>
            <div class="biodata">
                <div class="label">Nama Lengkap</div>
                <div class="nilai">{{ $cv->nama }}</div>

                <div class="label">Tempat Lahir</div>
                <div class="nilai">{{ $cv->tempat_lahir ?: '-' }}</div>

                <div class="label">Tanggal Lahir</div>
                <div class="nilai">
                    {{ $cv->tanggal_lahir ? \Illuminate\Support\Carbon::parse($cv->tanggal_lahir)->format('d-m-Y') : '-' }}
                </div>

                <div class="label">Jenis Kelamin</div>
                <div class="nilai">{{ $cv->jenis_kelamin ?: '-' }}</div>

                <div class="label">Alamat</div>
                <div class="nilai">{{ $cv->alamat ?: '-' }}</div>
            </div>
        </div>

        <div class="bagian">
            <h3>Pendidikan</h3>
            <p style="white-space: pre-line;">{{ $cv->pendidikan ?: 'Belum diisi' }}</p>
        </div>

        <div class="bagian">
            <h3>Keahlian</h3>
            <p style="white-space: pre-line;">{{ $cv->keahlian ?: 'Belum diisi' }}</p>
        </div>

        <div class="bagian">
            <h3>Kontak</h3>
            <div class="biodata">
                <div class="label">Email</div>
                <div class="nilai">{{ $cv->email ?: '-' }}</div>

                <div class="label">Nomor HP</div>
                <div class="nilai">{{ $cv->no_hp ?: '-' }}</div>
            </div>
        </div>

        <div class="bagian bagian-video">
            <h3>Video Perkenalan</h3>

            @if ($cv->video)
                <video class="video-cv" controls preload="metadata">
                    <source src="{{ asset('storage/' . $cv->video) }}"
                            type="video/mp4">
                    Browser kamu tidak mendukung pemutaran video.
                </video>
            @else
                <p class="text-muted">Belum ada video perkenalan.</p>
                <a href="{{ route('cv.edit', $cv->id) }}"
                   class="btn btn-sm btn-outline-primary">
                    Tambahkan Video
                </a>
            @endif
        </div>
    </div>
</div>

<div class="aksi">
    <a href="{{ route('cv.index') }}" class="btn btn-secondary">
        Kembali ke Data CV
    </a>

    <a href="{{ route('cv.edit', $cv->id) }}" class="btn btn-warning">
        Edit CV
    </a>

    <button type="button" onclick="window.print()" class="btn btn-primary">
        Cetak CV / Simpan PDF
    </button>
</div>

</body>
</html>
