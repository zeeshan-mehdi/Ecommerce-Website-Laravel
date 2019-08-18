@include('layouts.dashboard-head')

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include('layouts.sidebar')
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include('layouts.topbar')
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Orders</h1>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                    </div>
                    <div class="card-body">
                        <input id="myInput" type="text" placeholder="Search..">
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Item Id</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>User Id</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">

                                @if($products&&count($products)>0)

                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->item}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{$product->price}}</td>
                                            <td class="{{$product->id}}">{{$product->user_id}}</td>
                                            <td>{{$product->created_at}}</td>
                                            <td id="{{$product->id}}" class="stat"><span class="status" id="{{$product->id}}">{{$product->status}}</span>
                                                <button type="button" class="btn btn-outline-primary st float-right"
                                                        id="{{$product->id}}" data-toggle="modal"
                                                        data-target="#editModal">Edit
                                                </button>
                                                <button type="button" class="btn btn-outline-primary float-right details" id="{{$product->id}}" data-toggle="modal"
                                                        data-target="#detailsModal" style="margin-right: 5px">Details</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
    @include('layouts.dashboard-footer')
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Edit Modal-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Change Order Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Status
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Processing</a>
                        <a class="dropdown-item" href="#">Dispatched</a>
                        <a class="dropdown-item" href="#">Delivered</a>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <input class="btn btn-primary save" type="submit" value="Save" />
            </div>
        </div>
    </div>
</div>


{{--Details Model--}}
<!-- Edit Modal-->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="text-info">
                    <p class="a-status  text-danger" >Address Not Provided</p>
                    <p class="name">Name</p>
                    <p class="contact">Contact</p>
                    <p class="province">Province</p>
                    <p class="city">City</p>
                    <p class="area"></p>
                    <p class="street">Street</p>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


@include('layouts.logout-modal')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script src="{{asset("js/dashboard-orders.js")}}"></script>

</body>

</html>


