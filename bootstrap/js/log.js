function onLogin(){
        console.log('login clicked');
        let emaillog = $('#emaillogin').val();
        let passwordlog = $('#passwordlogin').val();

        $.ajax({
            url: "login.php",
            method: "POST",
            data : {
                checklogemail : "checklogmail",
                emaillog: emaillog,
                passwordlog: passwordlog,

            },
            success: function (data) {
                // console.log(data);
                if(data == 0){
                    $('#logininvalid').html(
                        "<small class='alert alert-danger'>Invalid Email or Password!</small>"
                    )
                }else if(data == 1){
                    $('#logininvalid').html(
                        "<small class='spinner-border text-sucess'></small>"
                    );
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    },1000);
                }

            } 
        });
    }