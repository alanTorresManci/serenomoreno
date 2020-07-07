$('#data-table').DataTable({
    responsive: true
});

$('.delete').click(function(){
    var user = $(this).attr('product');
    var form = $('.form'+user);
    swal({
        title: '¿Seguro?',
        text: "No hay forma de revertir esta acción",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Si, eliminar'
    }).then(function () {
        form.submit();
    })

});
