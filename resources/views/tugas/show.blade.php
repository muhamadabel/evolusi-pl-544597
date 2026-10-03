<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Tugas</title>
    <style>
        body { font-family: sans-serif; max-width: 480px; margin: 3rem auto; padding: 0 1rem; color: #1f2937; }
        dt { font-weight: bold; margin-top: .75rem; }
    </style>
</head>
<body>
    <h1>Detail Tugas</h1>
    <dl>
        <dt>Judul</dt>
        <dd>{{ $tuga->judul }}</dd>
        <dt>Deskripsi</dt>
        <dd>{{ $tuga->deskripsi ?: '-' }}</dd>
        <dt>Selesai</dt>
        <dd>{{ $tuga->selesai ? 'Ya' : 'Belum' }}</dd>
    </dl>
    <p><a href="{{ route('tugas.index') }}">&larr; Kembali</a></p>
</body>
</html>
