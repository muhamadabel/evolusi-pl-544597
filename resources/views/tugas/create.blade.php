<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Tugas</title>
    <style>
        body { font-family: sans-serif; max-width: 480px; margin: 3rem auto; padding: 0 1rem; color: #1f2937; }
        label { display: block; margin-top: 1rem; }
        input, textarea { width: 100%; padding: .5rem; margin-top: .25rem; box-sizing: border-box; }
        button { margin-top: 1rem; padding: .5rem 1rem; cursor: pointer; }
        .error { color: #b91c1c; font-size: .875rem; }
    </style>
</head>
<body>
    <h1>Tambah Tugas</h1>

    <form method="POST" action="{{ route('tugas.store') }}">
        @csrf
        <label>
            Judul
            <input type="text" name="judul" value="{{ old('judul') }}" required>
            @error('judul') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label>
            Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <span class="error">{{ $message }}</span> @enderror
        </label>
        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('tugas.index') }}">&larr; Kembali</a></p>
</body>
</html>
