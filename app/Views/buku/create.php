<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Tambah Data Buku</title>
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Buku</h2>

        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger">
                <?= \Config\Services::validation()->listErrors(); ?>
            </div>
        <?php endif; ?>

        <form action="/buku/post" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="kode_buku" class="form-label">Kode Buku</label>
            <input type="text" class="form-control" id="kode_buku" name="kode_buku" required>
        </div>

        <div class="mb-3">
            <label for="nama_buku" class="form-label">Nama Buku</label>
            <input type="text" class="form-control" id="nama_buku" name="nama_buku" required>
        </div>

        <div class="mb-3">
            <label for="nama_pengarang" class="form-label">Nama Pengarang</label>
            <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" required>
        </div>

        <div class="mb-3">
            <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="/buku" class="btn btn-secondary">Kembali</a>

        </form>
    </div>
</body>

</html>