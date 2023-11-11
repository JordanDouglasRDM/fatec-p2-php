toastr.options = {
    progressBar: true,
    timeOut: 2000
}
$(document).ready(function () {
    $('#loginForm').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: 'gerenciar-usuario.php',
            data: $('#loginForm').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === 'sucesso') {
                    toastr.success('Sucesso<br>Sucesso ao realizar o login.');
                    setTimeout(function () {
                        window.location.href = 'home.php';
                    }, 2000);
                } else {
                    toastr.error('Erro<br>' + data.status);
                }
            },
            error: function () {
                toastr.error('Erro<br>Erro interno do servidor, tente novamente mais tarde.');
            }
        });
    });
});
$(document).ready(function () {
    $('#cadastroUserForm').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: 'gerenciar-usuario.php',
            data: $('#cadastroUserForm').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === 'sucesso') {
                    toastr.success('Sucesso<br>Usuário adicionado com sucesso.');
                    setTimeout(function () {
                        window.location.href = 'index.php';
                    }, 2000);
                } else {
                    toastr.error('Erro<br>' + data.status);
                }
            },
            error: function () {
                toastr.error('Erro<br>' + this.data);
            }
        });
    });
});