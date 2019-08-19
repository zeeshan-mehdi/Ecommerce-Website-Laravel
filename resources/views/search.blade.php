@extends('layouts.template')

@section('content')

    <!-- Search form -->


    <div class="alert alert-success" style="display:none;">
        Item Added to cart
    </div>
    <div class="alert alert-danger" style="display:none;">
        Something went wrong
    </div>

    @if($posts)

        @foreach($posts as $post)

            <div class="row" style="max-height: 300px;">
                <div class="col img-thumbnail" style="max-width: 300px;">
                    <img src="/storage/images/{{$post->image}}" alt="Lights" style="width:100%">
                </div>

                <div class="col">
                    <h1>{{$post->title}}</h1>
                    <p class="font-weight-bold">{{strpos($post->price,'$')!==false ? $post->price : '$'.$post->price}}</p>
                    <p>{{$post->description}}</p>
                    <a class="btn btn-success float-right mt-auto text-white" id="{{$post->id}}">Add to Cart</a>
                    <a class="btn btn-info float-right mt-auto text-white" style="margin-right: 5px;" id="{{$post->id}}">Buy Now</a>
                </div>
            </div>
            <br>
            <hr>
            <br>
        @endforeach
    @endif


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('a.btn-success').off().click(function (e) {

            var url = "/posts/cart";


            $.ajax({
                type: 'POST',
                url: url,
                data: {id: $(this).attr('id')},
                success: function (data) {
                    console.log(data);
                    $('.fas').css('color', '#38c172');
                    $('.alert-success').show();
                },
                error: function (error) {
                    console.log(error);
                    $('.alert-danger').show();
                }

            });
        });

        $('a.btn-info').off().click(function (e) {

            var url = "/posts/cart";


            $.ajax({
                type: 'POST',
                url: url,
                data: {id: $(this).attr('id')},
                success: function (data) {
                    console.log(data);
                    $('.fas').css('color', '#38c172');
                    $('.alert-success').show();
                    window.location= "/cart";
                },
                error: function (error) {
                    console.log(error);
                    $('.alert-danger').show();
                }

            });
        });


    </script>
@endsection