<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <span class="btn btn-info addBtn">+ Tambah Data</span>
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Pelajaran</th>
                                <th>Jam Mulai</th>
                                <th>Jam Akhir</th>
                                <th>Nama Kelas</th>
                                <th>Guru Pengajar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-center show" id="modal-DataPelajaran" tabindex="-1" aria-modal="true"
    role="dialog" style="display: none; padding-left: 0px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDataPelajaran">
                    <input type="hidden" class="form-control" name="id" value="" id="id">
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nama Pelajaran</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Jam Akhir</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control" id="jam_akhir" name="jam_akhir">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Nama Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Guru Pengajar</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="guru_pengajar" name="guru_pengajar">
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md saveBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>