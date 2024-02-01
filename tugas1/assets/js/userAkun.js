$(document).ready(function () {
    loadTabelUserAkun();
})

function loadTabelUserAkun() {
    let tableBody = $("#tableBody");
    let urlUserAkun = siteURL + '/user_akun/tabel_user_akun';

     $.ajax({
        type: "POST",
        url: urlUserAkun,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let tbl = '';
                tableBody.empty();
                for (let i in res.data) {
                    tbl += '<tr>'
                        + '<td>' + res.data[i].id + '</td>'
                        + '<td>' + res.data[i].username + '</td>'
                        + '<td>' + res.data[i].password + '</td>'
                        + '<td>' + res.data[i].tipe_akun + '</td>'
                        + '<td>' + res.data[i].last_update + '</td>'
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
    let form_user_akun = $("#formUserAkun input");
    let url = siteURL+'/user_akun/tambah_user/';
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                form_user_akun.val('');
                console.log(response)
                $('#modal-UserAkun').modal('show'); 
            } else {
                console.log(response)
            }
        }
    });
    // console.log('Edit btn di klik: ' + id);
})

$(document).on('click', '.editBtn', function(){
    let id = $(this).data('id');
    let url = siteURL + '/user_akun/edit_user/' + id;
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if(response.status) {
                console.log(response)
                $('#modal-UserAkun').modal('show'); 
                    $('#id').val(response.data.id);
                    $('#username').val(response.data.username);
                    $('#password').val(response.data.password);
                    $('#tipe_akun').val(response.data.tipe_akun);
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
    let url = siteURL + '/user_akun/hapus_user/' + id;
    
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
                          text: "Your file has been deleted.",
                          icon: "success"
                        });
                        loadTabelUserAkun();
                    } else {
                        console.log(response);
                        Swal.fire({
                            title: "Deleted! not...",
                            text: "Your file has not been deleted.",
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

    let url = siteURL + '/user_akun/simpan_user/';
    let formData = new FormData($('#formUserAkun')[0]);
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
                $('#modal-UserAkun').modal('hide');
                loadTabelUserAkun();
            } else {
                console.log(response);
            }
        }
    });
})