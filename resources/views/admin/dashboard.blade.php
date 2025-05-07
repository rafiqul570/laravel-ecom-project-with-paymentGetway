@extends('admin.layouts.template')
@section('content')


<h1>Wellcome {{ Auth::user()->name }}</h1>


@endsection
