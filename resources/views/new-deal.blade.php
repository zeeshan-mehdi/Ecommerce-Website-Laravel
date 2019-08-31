<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Deal</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css"/>
    <script src="{{asset("js/app.js")}}"></script>
    <link rel="stylesheet" href=""/>
    <!-- Custom styles for this template-->
    <link href="/css/admin.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        @include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
            @include('layouts.topbar')
            <!-- End of Topbar -->


                <div class="container-fluid">
                    <h1>Add New Deal </h1>
                    <form action="/dashboard/deals/store" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        <div class="form-group">
                        <label for="sel1">Select post :</label>
                        <select class="form-control select"   id="sel1" onchange="var optionVal = $(this).find(':selected').val(); loadPost(optionVal);">

                        </select>
                            <input name="title" class="invisible in-title"/>
                            <input name="id" class="invisible in-id"/>
                        </div>

                        <div class="form-group">
                            <label for="price">Discount %age </label>
                            <input type="text" name="percentage" placeholder="e.g 20" class="form-control" id="percentage"/>
                        </div>

                        <div class="form-group">
                            <label for="ds-price">Discount Price </label>
                            <input type="text" name="discount-price"  placeholder="" class="form-control" id="ds-price"/>
                        </div>



                        <div class="form-group">
                            <label for="quan">Quantity </label>
                            <input type="text" name="quantity" placeholder="e.g 50" class="form-control" id="quan"/>
                        </div>


                        <input type="submit" value="Submit" class="btn btn-outline-primary"/>
                        <br>
                        <br>

                    </form>
                </div>

            </div>
        </div>

</div>

<script>
    var items = null;
    var item = null;
    $.ajax({
        url:'/posts/fetch/posts',
        type:'GET',
        data:{},
        success:function (posts) {
            items = posts;
            console.log(posts);
            for(let post in posts){
                let title = posts[post]['title'];
                let id = posts[post]['id'];

                let option = "<option id="+id+">"+title+"</option>";

                $('.select').append(option);

            }
        },
        error:function (err) {
            console.log(err);
        }
    });

    $('#percentage').keyup(function (val) {

        // let title = $('option.sel').val();
        //
        // loadPost();

        let percent = $(this).val();
        let total = item['price'];

        total = total.replace('$','');

        let percentage = percent*total/100;

        console.log(percent+" "+" "+total+" "+percentage);

        $('#ds-price').val(total-percentage.toFixed(2));

        $('#quan').val(item['quantity']);

    });

    function loadPost(val) {
        if(items !==null){

            for(let li in items){
                let post = items[li];

                if(post['title']===val){
                    console.log(post['title']);
                    $('.in-title').val(post['title']);
                    $('.in-id').val(post['id']);
                    item = post;
                }
            }

        }
    }
</script>