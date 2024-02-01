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
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tingkat</th>
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
<div class="modal fade bs-example-modal-center show" id="modal-DataSiswa" tabindex="-1" aria-modal="true" role="dialog"
    style="display: none; padding-left: 0px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDataSiswa">
                    <input type="hidden" class="form-control" name="id" value="" id="id">
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Nama Siswa</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="nama_siswa" name="nama_siswa">

                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kelas" placeholder="Kelas" name="kelas">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Tingkat</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="tingkat" name="tingkat">
                                <option>X</option>
                                <option>XI</option>
                                <option>XII</option>
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