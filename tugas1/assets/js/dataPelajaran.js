$(document).ready(function () {
    loadTabelDataPelajaran();
})

function loadTabelDataPelajaran() {
    let tableBody = $("#tableBody");
    let urlDataPelajaran = siteURL + '/data_pelajaran/tabel_data_pelajaran';

     $.ajax({
        type: "POST",
        url: urlDataPelajaran,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let tbl = '';
                tableBody.empty();
                for (let i in res.data) {
                    tbl += '<tr>'
                        + '<td>' + res.data[i].id + '</td>'
                        + '<td>' + res.data[i].nama_pelajaran + '</td>'
                        + '<td>' + res.data[i].jam_mulai + '</td>'
                        + '<td>' + res.data[i].jam_akhir + '</td>'
                        + '<td>' + res.data[i].nama_kelas + '</td>'
                        + '<td>' + res.data[i].nama_guru + '</td>'
                        + '<td> <span class="btn btn-info btn-sm editBtn" data-id="'+ res.data[i].id +'"> Edit </span>'
                        + '<span class="btn btn-danger btn-sm deleteBtn" data-id="'+ res.data[i].id +'"> Delete </span></td>'
                        + '</tr>';
                }
                tableBody.append(tbl);
            }
            else
            {
                //data not available
            }
        }
     });
}

$(document).on('click', '.addBtn', function(){
    console.log('btn di klik');
    let form_user_akun = $("#formDataPelajaran input");
    let guru_pengajar = $("#guru_pengajar");
    let url = siteURL+'/data_pelajaran/tambah_pelajaran/';
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                form_user_akun.val('');
                guru_pengajar.empty();
                guru = '';
                for (let i in response.selectGuru) {
                    guru += '<option value="'+response.selectGuru[i].id+'">'+response.selectGuru[i].username+'</option>'
                }
                guru_pengajar.append(guru);
                $('#modal-DataPelajaran').modal('show'); 
                console.log(response)
            } else {
                console.log(response)
            }
        }
    });
    // console.log('Edit btn di klik: ' + id);
})

$(document).on('click', '.editBtn', function(){
    let id = $(this).data('id');
    let form_user_akun = $("#formDataPelajaran input");
    let guru_pengajar = $("#guru_pengajar");
    let url = siteURL + '/data_pelajaran/edit_pelajaran/' + id;
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                guru = '';
                guru_selected = '';
                form_user_akun.val('');
                guru_pengajar.empty();
                $('#id').val(response.data.id);
                $('#nama_pelajaran').val(response.data.nama_pelajaran);
                $('#jam_mulai').val(response.data.jam_mulai);
                $('#jam_akhir').val(response.data.jam_akhir);
                for (let i in response.selectGuru) {
                    if (response.selectGuru[i].id == response.data.user_akun_id) {
                        guru_selected = 'selected';
                    } else {
                        guru_selected = '';
                    }
                    guru += '<option value="'+response.selectGuru[i].id+'" '+guru_selected+'>'+response.selectGuru[i].username+'</option>'
                }
                $('#nama_kelas').val(response.data.nama_kelas);
                guru_pengajar.append(guru);
                $('#modal-DataPelajaran').modal('show'); 
                console.log(response);
            } else {
                console.log(response);
            }
        }
    });
    console.log('Edit btn di klik: ' + id);
})

$(document).on('click', '.deleteBtn', function(){
    console.log('deletebtn di klik');
    let id = $(this).data('id');
    let url = siteURL + '/data_pelajaran/hapus_pelajaran/' + id;
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url,
                data: "",
                dataType: "JSON",
                success: function (response) {
                    if(response.status) {
                        console.log(response)
                        Swal.fire({
                          title: "Deleted!",
                          text: "Your data has been deleted.",
                          icon: "success"
                        });
                        loadTabelDataPelajaran();
                    } else {
                        console.log(response);
                        Swal.fire({
                            title: "Deleted! not...",
                            text: "Your data has not been deleted.",
                            icon: "error"
                        });
                    }
                }
            });
        }
      });
})

$(document).on('click', '.saveBtn', function(){
    console.log('savebtn di klik');

    let url = siteURL + '/data_pelajaran/simpan_pelajaran/';
    let formData = new FormData($('#formDataPelajaran')[0]);
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                console.log(response)
                Swal.fire({
                    title: "Good Job!",
                    text: response.msg,
                    icon: "success"
                });
                $('#modal-DataPelajaran').modal('hide');
                loadTabelDataPelajaran();
            } else {
                console.log(response);
            }
        }
    });
})