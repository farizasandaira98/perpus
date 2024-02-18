<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <?php if(session()->get('id_role') == 1) : ?>
    <title>Tambah Data User</title>
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
        <h2>Tambah User</h2>
        <form action="/user/post" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
            </div>
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <?php if(session()->has('logged_in') || session()->get('id_role') == 2 ) : ?>
            <div class="mb-3">
                <label for="role" class="form-label">Peran</label>
                <select class="form-select" id="role" name="id_role">
                    <option value=1>Admin</option>
                    <option value=2>User</option>
                </select>
            </div>
            <?php if(session()->get('id_role') == 1) : ?>
                <a href="/user/create" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            <?php endif; ?>
            <?php else : ?>
                <a href="/" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>