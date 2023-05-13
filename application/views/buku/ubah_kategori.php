<!-- Begin Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <?= $judul; ?>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('buku/ubahKategori/') . $kategori['id']; ?>" method="post">
                        <div class="form-group">
                            <label for="kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $kategori['kategori']; ?>">
                            <?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->