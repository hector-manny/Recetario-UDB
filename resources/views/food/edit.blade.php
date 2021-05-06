@extends('layouts.app')

@section('content')
<div class="container">


<form action="{{url('/food/'.$datos->id ) }}" method="post" enctype="multipart/form-data">


    @csrf

<!--Ingresando token del mismo sistem-->
{{method_field('PATCH') }}
@include('food.form',['modo'=>'Editar']);
</form>
</div>
@endsection
