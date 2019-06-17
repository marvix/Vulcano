$(document).ready(function() {
    $('#table-config').DataTable({
        paging: false,
        info: false,
        searching: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        columns: [
            { name: 'ID' },
            { name: "Ordem" },
            { name: 'Chave' },
            { name: 'Descrição' },
            { name: 'Tipo' },
            { name: 'DataEnum' },
            { name: 'Ações', orderable: false, searchable: false }
        ],
    });
});


function deleteConfig(route) {
    swal({
        title: 'Atenção',
        text: 'Deseja realmente excluir esta configuração?',
        icon: 'warning',
        closeModal: false,
        dangerMode: true,
        buttons: {
            cancel: { text: "Não", value: false, visible: true },
            confirm: { text: "Sim", value: true, visible: true },
        }
    }).then((value) => {
        if (value) {
            location.href=route;
        }
    });
}
