<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4">
                <div class="card h-100 overflow-hidden">
                    <div class="card-body ">
                        <div class="">
                            <h4 class="alert alert-info mt-2 p-2"> Tabel Siswa Kelas </h4>
                            <div class="">

                                <div id="table_caleg_rank_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="table_caleg_rank_length"><label>Show
                                                    <select name="table_caleg_rank_length"
                                                        aria-controls="table_caleg_rank"
                                                        class="custom-select custom-select-sm form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> entries</label></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table width="100%" class="table table-hover no-footer dataTable"
                                                id="table_caleg_rank" data-source="table_caleg_rank" role="grid"
                                                aria-describedby="table_caleg_rank_info" style="width: 100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th width="5%" class="sorting_asc sorting_disabled" tabindex="0"
                                                            aria-controls="table_caleg_rank" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="#: activate to sort column descending"
                                                            style="width: 31px;">#</th>
                                                        <th width="10%" class="sorting_disabled" tabindex="0"
                                                            aria-controls="table_caleg_rank" rowspan="1" colspan="1"
                                                            aria-label="Nama Caleg: activate to sort column ascending"
                                                            style="width: 78px;">Kelas</th>
                                                        <th width="10%" class="sorting_disabled" tabindex="0"
                                                            aria-controls="table_caleg_rank" rowspan="1" colspan="1"
                                                            aria-label="Jumlah Anggota: activate to sort column ascending"
                                                            style="width: 97px;">Jumlah Siswa</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableBody">
                                                </tbody>
                                            </table>
                                            <div id="table_caleg_rank_processing" class="dataTables_processing card"
                                                style="display: none;">Processing...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Jumlah Siswa</p>
                                        <h4 class="mb-0" id="jumlahSiswa">0</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-male font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Jumlah Guru</p>
                                        <h4 class="mb-0" id="jumlahGuru">0</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center ">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-female font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Jumlah Akun</p>
                                        <h4 class="mb-0" id="jumlahAkun">0</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                            <span class="avatar-title rounded-circle bg-primary">
                                                <i class="bx bx-user-circle font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="card h-100 ">
                    <div class="card-body">
                        <div class="">
                            <h4 class="card-title mb-2">Chart Siswa Kelas</h4>
                            <div class="ms-auto mt-3">
                                <canvas class="" id="chart" width="652" height="326"
                                    style="display: block; box-sizing: border-box; height: 326px; width: 652px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>