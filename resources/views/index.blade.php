@extends('layouts.template')

@section('content')
    @include('layouts.slider')

    <div class="alert alert-success" style="display:none;">
        Item Added to cart
    </div>
    <div class="alert alert-danger" style="display:none;">
        Something went wrong
    </div>

    @if($posts && count($posts)>0)

        @foreach($posts->chunk(4) as $chunk)
            {{--<h1>Category</h1>--}}
            <div class="row ">
            @foreach($chunk as $item)

                <div class="card item mx-auto" style="min-width:250px;max-width: 250px;margin:5px;  ">

                    <a href="/posts/{{$item->id}}">
                    <img class="card-img-top" src="/storage/images/{{$item->image}}" alt="Card image cap"></a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{$item->title}}</h5>
                        {{--<p class="card-text">@php echo substr($item->description,0,5) @endphp</p>--}}
                        <p >{{strpos($item->price,'$')!==false ? $item->price : '$'.$item->price}}</p>
                        <a class="btn btn-success float-right mt-auto text-white" id="{{$item->id}}">Add to Cart</a>
                    </div>
                </div>

            @endforeach
            </div>
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

            </script>
        @endforeach



    @endif




@endsection




