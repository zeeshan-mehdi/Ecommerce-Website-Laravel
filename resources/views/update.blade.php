<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css"/>
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
                <h1>Add New Item </h1>
                <form action="/posts/{{$product->id}}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="title">Item Title </label>
                        <input type="text" name="title" placeholder="Post Title" class="form-control" id="title"
                               value="{{$product->title}}"/>
                    </div>
                    <div class="form-group">
                        <label for="desc">Item Description </label>
                        <textarea name="desc" class="form-control" id="desc"
                                  rows="10">{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload Image </label>
                        <input type="file" name="image" class="form-control-file" id="file"/>
                    </div>

                    <div class="form-group">
                        <label for="price">Price </label>
                        <input type="text" name="price" placeholder="e.g 200$" class="form-control" id="price"
                               value="{{$product->price}}"/>
                    </div>

                    <div class="form-group">
                        <label for="vend">Vender </label>
                        <input type="text" name="vender" placeholder="vender e.g Ali" class="form-control" id="vend"
                               value="{{$product->vendor}}"/>
                    </div>

                    <div class="form-group">
                        <label for="quan">Quantity </label>
                        <input type="text" name="quantity" placeholder="e.g 50" class="form-control" id="quan"
                               value="{{$product->quantity}}"/>
                    </div>


                    <input type="submit" value="Submit" class="btn btn-outline-primary"/>
                    <br>
                    <br>

                </form>
            </div>

        </div>
    </div>
</div>

