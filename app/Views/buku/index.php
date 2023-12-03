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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Perpus</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/buku" class="nav-link active">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link">Pengguna</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h3>Data Buku</h3>
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
                                Kode Buku
                            </th>
                            <th>
                                Nama Buku
                            </th>
                            <th>
                                Nama Pengarang
                            </th>
                            <th>
                                Nama Penerbit
                            </th>
                            <th>
                                Tahun Terbit
                            </th>
                            <th>
                                Dibuat
                            </th>
                            <th>
                                Diperbarui
                            </th>
                            <th>
                                Foto
                            </th>
                            <th>
                                Kontrol
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($buku)) : ?>
                            <p>Tidak ada data buku.</p>
                        <?php else : ?>
                            <?php foreach ($buku as $data) : ?>
                                <tr>
                                    <td><?= esc($data['kode_buku']) ?></td>
                                    <td><?= esc($data['nama_buku']) ?></td>
                                    <td><?= esc($data['nama_pengarang']) ?></td>
                                    <td><?= esc($data['nama_penerbit']) ?></td>
                                    <td><?= esc($data['tahun_terbit']) ?></td>
                                    <td><?= esc($data['created_at']) ?></td>
                                    <td><?= esc($data['updated_at']) ?></td>
                                    <td>
                                        <?php if ($data['foto']) : ?>
                                            <img src="<?= base_url('uploads/fotos/' . $data['foto']) ?>" alt="<?= $data['nama_buku'] ?>" class="img-fluid" width="100">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning">
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
</body>

</html>