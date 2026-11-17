
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow mx-auto" style="max-width:850px;">
        <div class="card-header bg-warning">
            <h4>Edit Data CV</h4>
        </div>

        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cv.update', $cv->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="nama" class="form-control"
                           value="{{ old('nama', $cv->nama) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                               value="{{ old('tempat_lahir', $cv->tempat_lahir) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                               value="{{ old('tanggal_lahir', $cv->tanggal_lahir ? \Illuminate\Support\Carbon::parse($cv->tanggal_lahir)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Laki-laki"
                            @selected(old('jenis_kelamin', $cv->jenis_kelamin) == 'Laki-laki')>
                            Laki-laki
                        </option>
                        <option value="Perempuan"
                            @selected(old('jenis_kelamin', $cv->jenis_kelamin) == 'Perempuan')>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control">{{ old('alamat', $cv->alamat) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $cv->email) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control"
                               value="{{ old('no_hp', $cv->no_hp) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pendidikan</label>
                    <input type="text" name="pendidikan" class="form-control"
                           value="{{ old('pendidikan', $cv->pendidikan) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Keahlian</label>
                    <textarea name="keahlian" rows="3" class="form-control">{{ old('keahlian', $cv->keahlian) }}</textarea>
                </div>

                <hr>
                <h5 class="mb-3">Foto Profil</h5>

                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label><br>
                    @if ($cv->foto)
                        <img src="{{ asset('storage/' . $cv->foto) }}"
                             width="100" height="100"
                             style="object-fit:cover;border-radius:50%;">
                    @else
                        <p>Belum ada foto.</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">
                    <small class="text-muted">
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                        Kosongkan jika tidak ingin mengganti foto.
                    </small>
                </div>

                <hr>
                <h5 class="mb-3">Video Perkenalan</h5>

                <div class="mb-3">
                    <label class="form-label">Video Saat Ini</label>

                    @if ($cv->video)
                        <div class="mt-2">
                            <video width="100%" style="max-width:480px;"
                                   controls preload="metadata">
                                <source src="{{ asset('storage/' . $cv->video) }}"
                                        type="video/mp4">
                                Browser kamu tidak mendukung pemutaran video.
                            </video>
                        </div>
                    @else
                        <p class="text-muted">Belum ada video perkenalan.</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label">Upload atau Ganti Video (Opsional)</label>
                    <input type="file" name="video" class="form-control"
                           accept="video/mp4,.mp4">
                    <small class="text-muted">
                        Format MP4, maksimal 20 MB.
                        Kosongkan jika tidak ingin mengganti video.
                    </small>
                </div>

                <button type="submit" class="btn btn-warning">
                    Simpan Perubahan
                </button>
                <a href="{{ route('cv.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
