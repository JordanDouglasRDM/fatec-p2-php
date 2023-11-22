$(document).ready(function () {
    $('.open-edit-perfil').on('click', function () {
        $('#visualizarPerfil').modal('hide');
        $('#editarPerfil').modal('show');
    });
});
$(document).ready(function () {
    $('#editarUsuario').submit(function (event) {
        event.preventDefault();

        const formData = new FormData(this); // Cria um objeto FormData a partir do formulário
        formData.append('foto_perfil', $('#foto_perfil')[0].files[0]); // Adiciona o arquivo ao objeto FormData
        toastr.options = {
            progressBar: true,
            timeOut: 2000
        };
        $.ajax({
            type: 'post',
            url: 'gerenciar-usuario.php',
            data: formData, // Envia o objeto FormData
            processData: false, // Não deixe o jQuery processar o objeto FormData
            contentType: false, // Define o tipo de conteúdo como falso para permitir que o servidor lide com o upload do arquivo
            dataType: 'json', // Espera uma resposta JSON
            success: function (data) {
                if (data.status === 'sucesso') {
                    toastr.success('Sucesso<br>Seus dados foram atualizados com sucesso.');
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else if (data.status === 'aviso') {
                    toastr.warning('Aviso<br>Nada de novo para atualizar.');
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
$(document).ready(function () {
    $('#excluirFotoPerfil').submit(function (event) {
        event.preventDefault();
        toastr.options = {
            progressBar: true,
            timeOut: 2000
        };
        $.ajax({
            type: 'post',
            url: 'gerenciar-usuario.php',
            data: $('#excluirFotoPerfil').serialize(), // Envia o objeto FormData
            dataType: 'json', // Espera uma resposta JSON
            success: function (data) {
                if (data.status === 'sucesso') {

                    toastr.success('Sucesso<br>Foto removida com sucesso.');
                    setTimeout(function () {
                        window.location.reload();
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