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
                        <li class="list-group-item {{$item->id}}">
                            <span class="badge badge-success" id="{{$item->id}}">{{$item->quantity}}x</span>
                            <strong id="{{$item->id}}">{{$item->title}}</strong>

                            <span class="label label-success" id="{{$item->id}}">{{$item->price}} $</span>
                            <span id="{{$item->id}}" class="badge badge-success">{{$item->status}}</span>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            No Orders Found
            {{session(['total'=>'0'])}}
        </div>

        <a href="/posts" class="btn btn-primary">Back To Home</a>
    @endif




@endsection




