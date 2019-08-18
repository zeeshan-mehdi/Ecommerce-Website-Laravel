@extends('layouts.template')

@section('content')
<div>
    {{\Illuminate\Support\Facades\Auth::user()->getAuthIdentifierName()}}
</div>
@endsection