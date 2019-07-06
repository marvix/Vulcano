$(document).ready(function() {
    $('#table-usuarios').DataTable({
        paging: true,
        info: true,
        searching: true,
        serverside: true,
        processing: true,
        ajax: {
            url: "{{ route('users.index') }}",
        },
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        columns: [
            { name: 'ID' },
            { name: 'Usuário' },
            { name: 'E-mail' },
            { name: 'Papel' },
            { name: 'Super Admin?'},
            { name: 'Ativo?' },
            { name: 'Avatar', orderable: false, searchable: false },
            { name: 'Ações', orderable: false, searchable: false }
        ],
    });
});

function active(route) {
    swal({
        closeOnEsc: false,
        title: 'Atenção',
        text: 'Deseja ativar este usuário?',
        icon: 'warning',
        closeModal: false,
        buttons: {
            cancel: { text: "Não", value: false, visible: true },
            confirm: { text: "Sim", value: true,visible: true},
        }
    }).then((value) => {
        if (value) {
            location.href=route;
        }
    });
}

function desactive(route) {
    swal({
        title: 'Atenção',
        text: 'Deseja desativar este usuário?',
        icon: 'warning',
        closeModal: false,
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

function deleteUser(route) {
    swal({
        title: 'Atenção',
        text: 'Deseja realmente excluir este usuário?',
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
