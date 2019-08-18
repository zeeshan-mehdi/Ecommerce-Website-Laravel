@extends('layouts.template')

@section('content')

    @if(count($el)>0)
        @foreach($el as $ele)

            <h1>{{$ele->name}}</h1>
        @endforeach
    @endif



@endsection