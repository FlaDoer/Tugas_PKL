$(document).ready(function () {
    loadTabelDataSiswa();
})

function loadTabelDataSiswa() {
    let tableBody = $("#tableBody");
    let urlDataSiswa = siteURL + '/data_siswa/tabel_data_siswa';

     $.ajax({
        type: "POST",
        url: urlDataSiswa,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let tbl = '';
                tableBody.empty();
                for (let i in res.data) {
                    tbl += '<tr>'
                        + '<td>' + res.data[i].id + '</td>'
                        + '<td>' + res.data[i].nama_siswa + '</td>'
                        + '<td>' + res.data[i].kelas + '</td>'
                        + '<td>' + res.data[i].tingkat + '</td>'
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
    let form_data_siswa = $("#formDataSiswa input");
    let nama_siswa = $("#nama_siswa");
    let url = siteURL+'/data_siswa/tambah_siswa/';
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                form_data_siswa.val('');
                nama_siswa.empty();
                siswa = '';
                for (let i in response.selectSiswa) {
                    siswa += '<option value="'+response.selectSiswa[i].id+'">'+response.selectSiswa[i].username+'</option>'
                }
                nama_siswa.append(siswa);
                $('#modal-DataSiswa').modal('show'); 
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
    let form_data_siswa = $("#formDataSiswa input");
    let nama_siswa = $("#nama_siswa");
    let url = siteURL + '/data_siswa/edit_siswa/' + id;
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                siswa = '';
                siswa_selected = '';
                form_data_siswa.val('');
                nama_siswa.empty();
                $('#id').val(response.data.id);
                for (let i in response.selectSiswa) {
                    if (response.selectSiswa[i].id == response.data.nama_siswa) {
                        siswa_selected = 'selected';
                    } else {
                        siswa_selected = '';
                    }
                    siswa += '<option value="'+response.selectSiswa[i].id+'" '+siswa_selected+'>'+response.selectSiswa[i].username+'</option>'
                }
                $('#kelas').val(response.data.kelas);
                $('#tingkat').val(response.data.tingkat);
                nama_siswa.append(siswa);
                $('#modal-DataSiswa').modal('show'); 
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
    let url = siteURL + '/data_siswa/hapus_siswa/' + id;
    
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
                        loadTabelDataSiswa();
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

    let url = siteURL + '/data_siswa/simpan_siswa/';
    let formData = new FormData($('#formDataSiswa')[0]);
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
                $('#modal-DataSiswa').modal('hide');
                loadTabelDataSiswa();
            } else {
                console.log(response);
            }
        }
    });
})