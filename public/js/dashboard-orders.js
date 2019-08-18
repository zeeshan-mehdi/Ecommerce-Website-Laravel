$("#myInput").keyup(function() {
    var value = $(this).val().toLowerCase();
    $("#tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var id_;
$('.st').click(function (e) {
    id_ = $(this).attr('id');
});
var x;

//modal drop down
$(".dropdown-item").click(function (event) {
    x = $(this).text(); // Get the text of the element
    $("#dropdownMenuLink").text(x);
});
$('.save').click(function () {
    $('td#'+id_).children('span').text(x);

    $.ajax({
        type: 'GET',
        url: '/orders/status',
        data: {"id": id_,"status":x},
        success: function (resp) {
            console.log(resp);
        },
        error: function (err) {
            console.log(err);
        }
    });
    $('.btn-secondary').click();

});


$('.details').click(function () {
    var id = $(this).attr('id');

    var userId = $('td.'+id).text();

    console.log(userId);


    $.ajax({
        type: 'GET',
        url: '/dashboard/user/address',
        data: {"id": userId},
        success: function (resp) {
            if(resp===null || resp==='undefined' || !resp){
                $('p.a-status').show();
                hide();
                return;
            }

            $('p.a-status').hide();

            try {

                let address = JSON.parse(resp);
                $('.name').text('Name : ' + address[0]['name']);
                $('.contact').text('Contact : ' + address[0]['contact']);
                $('.province').text('Province : ' + address[0]['province']);
                $('.city').text('City : ' + address[0]['city']);
                $('.area').text('Area : ' + address[0]['area']);
                $('.street').text('Street : ' + address[0]['street']);
                show();
                console.log(resp);
            }catch (e) {
                hide();
                $('p.a-status').show();
            }
        },
        error: function (err) {
            console.log(err);
            hide();
            $('p.a-status').show();
        }
    });

    function hide() {
        $('.name').hide();
        $('.contact').hide();
        $('.province').hide();
        $('.city').hide();
        $('.area').hide();
        $('.street').hide();
    }
    function show() {
        $('.name').show();
        $('.contact').show();
        $('.province').show();
        $('.city').show();
        $('.area').show();
        $('.street').show();
    }

});

// $(document).ready(function(){
//
//
// });








