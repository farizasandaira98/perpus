<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Halaman Buku</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Perpus</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/buku" class="nav-link">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link active">Pengguna</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex justify-content-center">
    <div class="card m-30 p-30" style="width: 90%;">
        <div class="card-body">
            <div class="card-title">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h3>Data User</h3>
                        </div>
                        <div class="col-6">
                            <a href="/buku/create" class="btn btn-primary" style="margin-left: 81%;">
                                <i class="bi bi-plus"></i> Tambah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>
                                Nama Pengguna
                            </th>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>
                               Alamat
                            </th>
                            <th>
                                Pekerjaan
                            </th>
                            <th>
                                Nomor Telepon
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Dibuat
                            </th>
                            <th>
                                Diubah
                            </th>
                            <th>
                                Kontrol
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)) : ?>
                            <p>Tidak ada data buku.</p>
                        <?php else : ?> 
                            <?php foreach ($users as $data) : ?>
                                <tr>
                                    <td><?= esc($data['username']) ?></td>
                                    <td><?= esc($data['nama']) ?></td>
                                    <td><?= esc($data['alamat']) ?></td>
                                    <td><?= esc($data['pekerjaan']) ?></td>
                                    <td><?= esc($data['nomor_telepon']) ?></td>
                                    <td><?= esc($data['email']) ?></td>
                                    <td><?= esc($data['created_at']) ?></td>
                                    <td><?= esc($data['updated_at']) ?></td>
                                    <td>
                                        <a href="/user/delete/<?= esc($data['id_user']) ?>" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <a href="/user/edit/<?= esc($data['id_user']) ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
