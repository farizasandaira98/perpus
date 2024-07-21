<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Edit Data Buku</title>
</head>

<body>
    <div class="container mt-4">
    <?php if (session()->has('errors')) : ?>
            <div class="alert alert-danger">
                <ul>
                    <!-- Iterate through the errors and display them -->
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li> <!-- Escape the error message to prevent XSS attacks -->
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <h2>Edit Buku</h2>
        <form action="/buku/update/<?= esc($data['id']) ?>" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="kode_buku" class="form-label">Kode Buku</label>
            <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="<?= esc($data['kode_buku']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_buku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?= esc($data['nama_buku']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_pengarang" class="form-label">Nama Pengarang</label>
            <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" value="<?= esc($data['nama_pengarang']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="<?= esc($data['nama_penerbit']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= esc($data['tahun_terbit']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
            <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" value="<?= esc($data['jumlah_buku']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="klasifikasi" class="form-label">Klasifikasi</label>
            <select name="klasifikasi" class="form-control custom-form-control" required>
                <option value="">Pilih Klasifikasi</option>
                <option value="Karya Umum" <?= ($data['klasifikasi'] == 'Karya Umum') ? 'selected' : '' ?>>Karya Umum</option>
                <option value="Agama" <?= ($data['klasifikasi'] == 'Agama') ? 'selected' : '' ?>>Agama</option>
                <option value="Ilmu-ilmu Sosial" <?= ($data['klasifikasi'] == 'Ilmu-ilmu Sosial') ? 'selected' : '' ?>>Ilmu-ilmu Sosial</option>
                <option value="Bahasa" <?= ($data['klasifikasi'] == 'Bahasa') ? 'selected' : '' ?>>Bahasa</option>
                <option value="Buku Paket" <?= ($data['klasifikasi'] == 'Buku Paket') ? 'selected' : '' ?>>Buku Paket</option>
                <option value="Teknologi" <?= ($data['klasifikasi'] == 'Teknologi') ? 'selected' : '' ?>>Teknologi</option>
                <option value="Seni Dan Hiburan" <?= ($data['klasifikasi'] == 'Seni Dan Hiburan') ? 'selected' : '' ?>>Seni Dan Hiburan</option>
                <option value="Olahraga" <?= ($data['klasifikasi'] == 'Olahraga') ? 'selected' : '' ?>>Olahraga</option>
                <option value="Geografi" <?= ($data['klasifikasi'] == 'Geografi') ? 'selected' : '' ?>>Geografi</option>
                <option value="Sejarah" <?= ($data['klasifikasi'] == 'Sejarah') ? 'selected' : '' ?>>Sejarah</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="/buku" class="btn btn-secondary">Kembali</a>

        </form>
    </div>
</body>

</html>