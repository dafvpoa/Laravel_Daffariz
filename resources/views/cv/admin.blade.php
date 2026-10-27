<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data CV</h2>
        <a href="{{ route('cv.create') }}" class="btn btn-primary">
            + Tambah CV
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No.</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cvs as $cv)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($cv->foto)
                                    <img src="{{ asset('storage/' . $cv->foto) }}"
                                         width="55" height="55"
                                         style="object-fit:cover;border-radius:50%;">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $cv->nama }}</td>
                            <td>{{ $cv->email ?: '-' }}</td>
                            <td>{{ $cv->no_hp ?: '-' }}</td>
                            <td>
                                <a href="{{ route('cv.show', $cv->id) }}"
                                   class="btn btn-sm btn-info text-white">Lihat</a>

                                <a href="{{ route('cv.edit', $cv->id) }}"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('cv.destroy', $cv->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus CV ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Belum ada data CV.
                                <a href="{{ route('cv.create') }}">Tambah sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>