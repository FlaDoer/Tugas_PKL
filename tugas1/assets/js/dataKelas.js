$(document).ready(function () {
    loadTabelDataKelas();
})

function loadTabelDataKelas() {
    let tableBody = $("#tableBody");
    let urlDataKelas = siteURL + '/data_kelas/tabel_data_kelas';

     $.ajax({
        type: "POST",
        url: urlDataKelas,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let tbl = '';
                tableBody.empty();
                for (let i in res.data) {
                    tbl += '<tr>'
                        + '<td>' + res.data[i].id + '</td>'
                        + '<td>' + res.data[i].nama_kelas + '</td>'
                        + '<td>' + res.data[i].kode_kelas + '</td>'
                        + '<td>' + res.data[i].tingkat + '</td>'
                        + '<td> <span class="btn btn-xs btn-primary editBtn" data-id="'+ res.data[i].id +'"> Edit </span> <span class="btn btn-xs btn-danger deleteBtn" data-id="'+ res.data[i].id +'"> Delete </span></td>'
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
    let form_user_akun = $("#formDataKelas input");
    let url = siteURL+'/data_kelas/tambah_kelas/';
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                form_user_akun.val('');
                console.log(response)
                $('#modal-DataKelas').modal('show'); 
            } else {
                console.log(response)
            }
        }
    });
    // console.log('Edit btn di klik: ' + id);
})

$(document).on('click', '.editBtn', function(){
    let id = $(this).data('id');
    let url = siteURL + '/data_kelas/edit_kelas/' + id;
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                console.log(response)
                $('#modal-DataKelas').modal('show'); 
                    $('#id').val(response.data.id);
                    $('#nama_kelas').val(response.data.nama_kelas);
                    $('#kode_kelas').val(response.data.kode_kelas);
                    $('#tingkat').val(response.data.tingkat);
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
    let url = siteURL + '/data_kelas/hapus_kelas/' + id;
    
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
                        loadTabelUserAkun();
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

    let url = siteURL + '/data_kelas/simpan_kelas/';
    let formData = new FormData($('#formDataKelas')[0]);
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
                $('#modal-DataKelas').modal('hide');
                loadTabelDataKelas();
            } else {
                console.log(response);
            }
        }
    });
})