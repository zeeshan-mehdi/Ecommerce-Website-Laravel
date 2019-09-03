@extends('layouts.template')

@section('content')
    @include('layouts.slider')

    <div class="alert alert-success" style="display:none;">
        Item Added to cart
    </div>
    <div class="alert alert-danger" style="display:none;">
        Something went wrong
    </div>

    <style>
        .card:hover{
            -webkit-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
            -moz-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
            box-shadow:-1px 9px 40px -12px rgba(0,0,0,0.75);
        }
    </style>

    @if($posts && count($posts)>0)

        @foreach(array_chunk($posts,4) as $chunk)
            {{--<h1>Category</h1>--}}
            <div class="row ">
                @foreach($chunk as $item)

                    <div class="card item mx-auto overlay zoom" style="min-width:250px;max-width: 250px;margin:5px;  ">

                        <a href="/posts/{{$item->id}}">
                            <img class="card-img-top" src="{{$item->image}}" alt="Card image cap" style="max-height: 300px"></a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{$item->title}}</h5>
                            {{--<p class="card-text">@php echo substr($item->description,0,5) @endphp</p>--}}
                            <p >{{strpos($item->price,'$')!==false ? $item->price : '$'.$item->price}}  <span class="text-info float-right" style="text-decoration: line-through;">{{strpos($item->rating,'$')!==false ? $item->rating : '$'.$item->rating}}</span></p>

                            <a class="btn btn-success float-right mt-auto text-white" id="{{$item->id}}">Add to Cart</a>
                        </div>
                    </div>

                @endforeach
            </div>

        @endforeach



        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('a.btn-success').off().click(function (e) {

                var url = "/deals/cart";


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


            $(document).ready(function () {
                $('.card').hover(
                    function () {
                        $(this).animate(
                            {
                                marginTop:"-1%"
                            },200
                        )
                    },
                    function () {
                        $(this).animate(
                            {
                                marginTop:"0%"
                            },200                           )
                    }
                );


            });

            $.ajax({
                type: 'GET',
                url: '/posts/fetch/categories',
                data: {},
                success: function (d) {
                    console.log(d);

                    var categories = d;

                    for(let cat in categories ){
                        console.log(categories[cat]['category']);

                        var category = categories[cat]['category'];

                        var link = "/posts/categories/"+ categories[cat]['category'];

                        var li = ' <a  class="dropdown-item" href='+link+'\n' +
                            '                     aria-haspopup="true" aria-expanded="false" v-pre>'+category+'</a>';

                        $('.categories').append(li);

                    }



                },
                error: function (error) {
                    console.log(error);
                }

            });
        </script>


    @endif




@endsection




