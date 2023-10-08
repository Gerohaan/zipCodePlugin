jQuery(document).ready(function($){
    $("#btnNew").click(function(){
        $("#modalNew").modal("show");
    });    
});
jQuery(document).ready(function($){
    $('.eliminar-item').on('click', function() {
    var item_id = $(this).data('item-id');
    console.log(item_id)
});    
});