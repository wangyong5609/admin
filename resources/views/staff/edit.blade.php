@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Edit')
@section('content')

<div class = 'container'>
    <h1>
        Edit staff
    </h1>
    <form method = 'get' action = '{!!url("staff")!!}'>
        <button class = 'btn blue'>staff Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("staff")!!}/{!!$staff->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate" value="{!!$staff->
            name!!}"> 
            <label for="name">name</label>
        </div>
        <div class="input-field col s6">
            <input id="birthday" name = "birthday" type="text" class="validate" value="{!!$staff->
            birthday!!}"> 
            <label for="birthday">birthday</label>
        </div>
        <div class="input-field col s6">
            <input id="phone" name = "phone" type="text" class="validate" value="{!!$staff->
            phone!!}"> 
            <label for="phone">phone</label>
        </div>
        <button class = 'btn red' type ='submit'>Update</button>
    </form>
</div>
@endsection