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
            { data: 'id', name: 'ID' },
            { data: 'name', name: 'Usuário' },
            { data: 'email', name: 'E-mail' },
            // { data: 'roles', name: 'Papel' },
        //     { data: 'is_superadmin', name: 'Super Admin?'},
            { data: 'active', name: 'Ativo?' },
        //     { name: 'Avatar', orderable: false, searchable: false },
        //     { data: 'action', name: 'Ações', orderable: false, searchable: false }
        ],
    });
});

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
