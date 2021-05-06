@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/food')}}" method="post" enctype="multipart/form-data">
@csrf
<!--Ingresando token del mismo sistem-->
@include('food.form',['modo'=>'Crear']);

</form>
</div>
@endsection
