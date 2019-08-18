@extends('layouts.template')

@section('content')



    <div class="alert alert-danger" style="display:none;">
        Something went wrong
    </div>

    <br>



    @if($cart!==null && count($cart)>0)

        <div class="row">
            <div class="col-sm-8 col-md-8 col-md-offset-4 col-sm-offset-4">
                <ul class="list-group">
                    @foreach($cart as $item)
                        <li class="list-group-item {{$item['id']}}">

                            <strong id="{{$item['id']}}">{{$item['title']}}</strong>

                            <span class="label label-success" id="{{$item['id']}}">{{$item['price']}} $</span>

                            <div class="float-right">
                                <button class="btn btn-outline-dark minus" id="{{$item['id']}}">-</button>
                                <span class="badge badge-success" id="{{$item['id']}}">{{$item['quantity']}}x</span>
                                <button class="btn btn-outline-dark add" id="{{$item['id']}}">+</button>

                                <button class="btn btn-danger delete" id="{{$item['id']}}">Remove</button>

                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>
            <div class="card item mx-auto" style="min-width:300px;max-width: 300px;margin:5px; padding: 10px; ">
                <div class="form-group">
                    <label for="title">*Name </label>
                    <input type="text" name="user-name" placeholder="e.g Ali" class="form-control " id="user-name"/>
                </div>
                <div class="form-group">
                    <label for="contact">*Contact </label>
                    <input name="contact" class="form-control" id="contact" placeholder="e.g +923446587575"/>
                </div>
                <div class="form-group">
                    <label for="province">*Province</label>
                    <input type="text" name="province" placeholder="e.g Punjab" class="form-control" id="province"/>
                </div>
                <div class="form-group">
                    <label for="city">*City </label>
                    <input type="text" name="city" placeholder="e.g Islamabad" class="form-control" id="city"/>
                </div>

                <div class="form-group">
                    <label for="area">Area </label>
                    <input type="text" name="area" placeholder="e.g Blue Area" class="form-control" id="area"/>
                </div>
                <div class="form-group">
                    <label for="address">*Address </label>
                    <input type="text" name="address" placeholder="e.g street # house # " class="form-control"
                           id="address"/>
                </div>
                <label class="col-form-label invisible status-indicator text-danger">Please Fill Values Correctly !!</label>
                <label class="col-form-label font-weight-bold amount">Total Amount : ${{session('total')}}</label>

                <a id="btn-pay" class="btn btn-success float-right mt-auto text-white">Proceed To Payment</a>
            </div>
        </div>

        {{--@foreach($cart as $item)--}}
        {{--<div class="row">--}}

        {{--{{$item['title']." quantity : ".$item['quantity']." price ".$item['price']}}--}}
        {{--</div>--}}

        {{--@endforeach--}}


        <script>

            var address = null;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var itemToDelete = -1;

            fetchAddress();

            $('#btn-pay').click(function () {

                if(!validateAddress()){
                    $('.status-indicator').removeClass('invisible');
                    return;
                }else{
                    $('.status-indicator').addClass('visible');
                }



                console.log('clicked');
                var isLoggedIn = "{{auth()->user()===null ? false: true}}";
                console.log(isLoggedIn);
                if (!isLoggedIn) {
                    window.location.href = "http://ecommerce-app.test/login";
                    return;
                }
                //window.url = "http://ecommerce-app.test/login";

                var price = 0;
                price = {{session('total')}} ;

                $.ajax({
                    url: 'price',
                    method: 'POST',
                    data: {'total': price,name:$('#user-name').val(),
                        contact:$('#contact').val(),
                        province:$('#province').val(),
                        city:$('#city').val(),
                        area:$('#area').val(),
                        street:$('#address').val()},
                    success: function (resp) {
                        console.log(resp);
                        window.location.href = "http://ecommerce-app.test/stripe";
                    },

                    error: function (err) {
                        console.log(err);
                        $errView = $('.alert-danger');
                        $errView.text(err);
                        $errView.show();

                    }
                });
            });

            $('.add').click(function (e) {
                const id = $(this).attr('id');
                console.log('add clicked' + id);
                makeRequest(id, 'cart/item-add');
                itemToDelete = -1;
            });

            $('.minus').click(function (e) {
                const id = $(this).attr('id');
                console.log('minus clicked' + id);
                const q = parseInt($('span.badge#' + id).text());
                if (q === 1) {
                    itemToDelete = id;
                } else {
                    itemToDelete = -1;
                }

                makeRequest(id, 'cart/item-minus');
            });

            $('.delete').click(function (e) {

                const id = $(this).attr('id');
                itemToDelete = id;
                console.log('delete clicked' + id);
                makeRequest(id, 'cart/item-delete');
            });

            function makeRequest(id, url) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {'id': id},
                    success: function (resp) {
                        resp = JSON.parse(resp);

                        console.log(resp);

                        var total = resp.totalPrice;
                        var quantity = resp.totalQuantity;
                        resp = resp.item;

                        for (var res in resp) {
                            updateValues(res, resp[res].title, resp[res].price, resp[res].quantity);
                        }

                        console.log(total);

                        $('.amount').text("Total Amount : $ " + total);

                        $('span.q').text(quantity);

                        if (resp.length === 0 && itemToDelete !== -1) {
                            $('#btn-pay').hide();
                            deleteItem();
                            $.post('/cart/setzero', {value: 'nothing'});
                        }


                    },

                    error: function (err) {
                        console.log(err);
                        $errView = $('.alert-danger');
                        $errView.text(err);
                        $errView.show();

                    }
                });
            }

            function updateValues(id, title, price, quantity) {

                console.log(quantity);

                const id_ = 'span#' + id + ".badge.badge-success";
                console.log("id" + id_);
                $(id_).text(quantity + "x");

                if (itemToDelete !== -1) {
                    deleteItem();
                }

            }

            function deleteItem() {
                console.log('deleting');
                $('li.' + itemToDelete).remove();
                itemToDelete = -1;
            }


            function validateAddress() {

                if($('#user-name').val()){
                    $('#user-name').addClass('is-valid');
                }else{
                    $('#user-name').addClass('is-invalid');
                    return false;
                }

                if($('#province').val()){
                    $('#province').addClass('is-valid');
                }else{
                    $('#province').addClass('is-invalid');
                    return false;
                }

                if($('#contact').val()&&$('#contact').val().length>9){
                    $('#contact').addClass('is-valid');
                }else{
                    $('#contact').addClass('is-invalid');
                    return false;
                }

                if($('#city').val()){
                    $('#city').addClass('is-valid');
                }else{
                    $('#city').addClass('is-invalid');
                    return false;
                }

                if($('#address').val()){
                    $('#address').addClass('is-valid');
                }else{
                    $('#address').addClass('is-invalid');
                    return false;
                }

                address = {
                    name:$('#user-name').val(),
                    contact:$('#contact').val(),
                    province:$('#province').val(),
                    city:$('#city').val(),
                    area:$('#area').val(),
                    street:$('#address').val()
                };
                return true;
            }

            function fetchAddress() {
                $.ajax({
                    url: '/user/address',
                    method: 'GET',
                    data: {},
                    success: function (resp) {
                        if(resp!==null)
                            displayData(resp);
                    },

                    error: function (err) {
                        console.log(err);
                        $errView = $('.alert-danger');
                        $errView.text(err);
                        $errView.show();
                    }
                });
            }

            function displayData(data) {
               if(!data){return}
                data = JSON.parse(data);
                console.log(data);
                $('#user-name').val(data[0]['name']);
                $('#contact').val(data[0]['contact']);
                $('#province').val(data[0]['province']);
                $('#city').val(data[0]['city']);
                $('#area').val(data[0]['area']);
                $('#address').val(data[0]['street']);
            }


        </script>
    @else
        <div class="alert alert-danger">
            No items in cart
            {{session(['total'=>'0'])}}
        </div>
        <a href="/posts" class="btn btn-primary">Back To Home</a>
    @endif




@endsection




