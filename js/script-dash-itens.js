$(document).ready(function () {
    $('#cadastroItem').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: 'gerenciar-itens.php',
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === 'sucesso') {
                    toastr.options = {
                        progressBar: true,
                        timeOut: 1500
                    };
                    toastr.success('Sucesso<br>Adicionado com sucesso');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.options = {
                        progressBar: true,
                        timeOut: 2000
                    };
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
    $('form[id^="alterarItemForm_"]').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: 'gerenciar-itens.php',
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === 'sucesso') {
                    location.reload();
                } else {
                    toastr.options = {
                        progressBar: true,
                        timeOut: 2000
                    };
                    toastr.error('Erro<br>' + data.status);
                }
            },
            error: function () {
                toastr.error('Erro<br>Erro interno do servidor, tente novamente mais tarde.');
            }
        });
    });
});