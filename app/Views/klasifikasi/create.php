<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <?php if(session()->get('id_role') == 1) : ?>
    <title>Tambah Data Klasifikasi</title>
    <?php else :?>
    <title>Form Registrasi</title>
    <?php endif?>
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
        <h2>Tambah Klasifikasi</h2>
        <form action="/klasifikasi/post" method="post">
            <div class="mb-3">
                <label for="nama_klasifikasi" class="form-label">Nama Klasifikasi</label>
                <input type="text" class="form-control" id="nama_klasifikasi" name="nama_klasifikasi">
            </div>
                <a href="/klasifikasi" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>