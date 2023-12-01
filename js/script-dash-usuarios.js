$(document).ready(function () {
    // Evento de clique no botão de edição
    $(".button-delete-usuario").click(function () {
        var formId = $(this).data('form-id');

        var form2 = "#removerUsuario-" + formId; // Adiciona "#" para indicar uma seleção por ID
        $(form2).submit(function (event) {
            event.preventDefault();
            Swal.fire({
                title: "Tem certeza?",
                text: "CUIDADO, você excluirá todos os registros associados a este usuário!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'gerenciar-usuario.php',
                        data: $(form2).serialize(), // Correção aqui
                        dataType: 'json',
                        success: function (data) {
                            if (data.status === 'sucesso') {
                                toastr.options = {
                                    progressBar: true,
                                    timeOut: 2000
                                };
                                toastr.success('Sucesso<br>Usuário excluído com sucesso');
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    timeOut: 2000
                                };
                                toastr.error('Erro<br>' + data.status);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error("Status da requisição: " + textStatus);
                            console.error("Erro lançado: " + errorThrown);
                            console.error("Resposta do servidor: " + jqXHR.responseText);

                            toastr.error('Erro<br>Erro interno do servidor, tente novamente mais tarde.');
                        }
                    });
                }
            });
        });
    });
});

$(document).ready(function () {
    $(".button-save-user").click(function () {
        var formId = $(this).data('form-id');
        var form = $("#atualizar-usuario-" + formId);

        form.off("submit");

        form.submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'gerenciar-usuario.php',
                data: form.serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'sucesso') {
                        toastr.options = {
                            progressBar: true,
                            timeOut: 1500
                        };
                        toastr.success('Sucesso<br>Usuário atualizado com sucesso.');
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