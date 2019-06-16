/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$('.action_destroy').on('click', function(e){
    e.preventDefault();

    if( !confirm('Deseja realmente excluir este registro?') ) {
        return false;
    }

    $(this).parent().find('form').submit();
    return;
});
$('table:not(.custom)').DataTable({
    responsive: true,
    aaSorting: [],
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
    }
});
