


$(document).ready(function(){
    $("#myInput").keyup(function() {
        var value = $(this).val().toLowerCase();
        $("#tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    console.log('connected');


    $('.btn-outline-primary').click(function () {
        console.log('clicked');

        var id = $(this).attr('id');
        $.ajax({
            url:'/dashboard/products/delete',
            type:'GET',
            data:{'id':id},
            success:function (msg) {
                console.log(msg);
                $('#'+id).remove();
            },

            error:function (err) {
                console.log(err);
            }
        });
        //console.log('deleted');
    });



});





