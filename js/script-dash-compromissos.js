$(document).ready(function () {
    $('#cadastroCompromisso').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'gerenciar-compromissos.php',
            data: $('#cadastroCompromisso').serialize(),
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
    $(".button-edit-compromissos").click(function () {
        // Obtém o ID do formulário associado ao botão clicado
        var formId = $(this).data('form-id');

        // Encontra o formulário correspondente ao ID
        var form = $("#editarCompromisso-" + formId);

        // Evento de envio do formulário de edição
        form.off("submit");

        form.submit(function (event) {
            event.preventDefault();
            // Faz a requisição AJAX para atualizar o título da lista
            $.ajax({
                type: 'POST',
                url: 'gerenciar-compromissos.php',
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
                    } else if (data.status === 'aviso') {
                        toastr.options = {
                            progressBar: true,
                            timeOut: 1500
                        };
                        toastr.warning('Aviso<br>Nada de novo para atualizar');
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
    $(".button-delete-compromisso").click(function () {
        // Obtém o ID do formulário associado ao botão clicado
        var formId = $(this).data('form-id');

        // Encontra o formulário correspondente ao ID
        var form2 = "removeCompromisso-" + formId;
        document.getElementById(form2).addEventListener("click", (event) => {
            event.preventDefault();
            Swal.fire({
                title: "Tem certeza?",
                text: "Você está prestes a excluir este compromisso",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(form2);
                    document.getElementById(form2).submit();
                }
            });
        });
    });
});
$(document).ready(function () {
    $('.open-edit-modal').on('click', function () {
        var formId = $(this).data('form-id');
        $('#view-compromisso-' + formId).modal('hide');
        $('#edit-compromisso-' + formId).modal('show');
    });
});