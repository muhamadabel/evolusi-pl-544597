<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Tugas</title>
    <style>
        body { font-family: sans-serif; max-width: 720px; margin: 3rem auto; padding: 0 1rem; color: #1f2937; }
        table { border-collapse: collapse; width: 100%; margin-top: 1rem; }
        th, td { border: 1px solid #d1d5db; padding: .5rem .75rem; text-align: left; }
        th { background: #f3f4f6; }
        .sukses { color: #047857; }
        .aksi form { display: inline; }
        button { cursor: pointer; }
    </style>
</head>
<body>
    <h1>Daftar Tugas</h1>

    @if (session('sukses'))
        <p class="sukses">{{ session('sukses') }}</p>
    @endif

    <p><a href="{{ route('tugas.create') }}">+ Tambah tugas</a></p>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tugas as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->selesai ? 'Ya' : 'Belum' }}</td>
                    <td class="aksi">
                        <a href="{{ route('tugas.edit', $item) }}">Edit</a>
                        <form method="POST" action="{{ route('tugas.destroy', $item) }}" onsubmit="return confirm('Hapus tugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada tugas.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
