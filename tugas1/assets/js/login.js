$(document).on('click', '#signInButton', function() {
    console.log('SignIn Button Pressed!');
    let namaUser = $('#namaUser').val();
    let passUser = $('#passUser').val();
    let userError = $('#userError').val();
    let passError = $('#passError').val();
    let alert = $('.alertLogin');
    alert.addClass('d-none');
    if(namaUser == ''){
      userError.text('Username tidak boleh kosong');
    }
    else if(passUser == ''){
      passError.text('Password tidak boleh kosong');
    }
    else{
      let url = siteURL + '/login/do_login';
      $.ajax({
        type: 'POST',
        url: url,
        dataType: 'JSON',
        data: {
          username:namaUser,
          password:passUser
        },
        success:function(res) {
          if(res.status){
            window.location.href = siteURL + '/dashboard/index';
          }
          else{
            alert.removeClass('d-none').html(respon.msg);
          }
          console.log(respon);
        }
      });
    }
  })