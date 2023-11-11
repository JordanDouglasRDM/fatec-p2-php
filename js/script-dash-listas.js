$(document).ready(function () {
    $('#cadastroLista').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'gerenciar-lista.php',
            data: $('#cadastroLista').serialize(),
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

$(document).ready(function () {
    // Evento de clique no botão de edição
    $(".button-edit-items").click(function () {
        // Obtém o ID do formulário associado ao botão clicado
        var formId = $(this).data('form-id');

        // Encontra o formulário correspondente ao ID
        var form = $("#editaLista-" + formId);

        // Evento de envio do formulário de edição
        form.submit(function (event) {
            event.preventDefault();

            // Faz a requisição AJAX para atualizar o título da lista
            $.ajax({
                type: 'POST',
                url: 'gerenciar-lista.php',
                data: form.serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'sucesso') {
                        toastr.options = {
                            progressBar: true,
                            timeOut: 1500
                        };
                        toastr.success('Sucesso<br>Lista alterada com sucesso');
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
});

$(document).ready(function () {
    // Evento de clique no botão de edição
    $(".button-delete-items").click(function () {
        // Obtém o ID do formulário associado ao botão clicado
        var formId = $(this).data('form-id');

        // Encontra o formulário correspondente ao ID
        var form = "editaLista-" + formId;
        document.getElementById(form).addEventListener("click", (event) => {
            event.preventDefault();
            Swal.fire({
                title: "Tem certeza?",
                text: "Você está prestes a excluir essa lista",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.form.submit();
                }
            });
        });
    });
});
