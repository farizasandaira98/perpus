<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Edit Klasifikasi</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Data Klasifikasi</h1>
        <form action="/klasifikasi/update/<?= $klasifikasi['id'] ?>" method="post">
            <div class="mb-3">
                <label for="nama_klasifikasi" class="form-label">Nama Klasifikasi</label>
                <input type="text" class="form-control" id="nama_klasifikasi" name="nama_klasifikasi" value="<?= $klasifikasi['nama_klasifikasi'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/klasifikasi" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>