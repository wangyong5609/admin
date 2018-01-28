@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Create')
@section('content')

<div class = 'container'>
    <h1>
        Create mission
    </h1>
    <form method = 'get' action = '{!!url("mission")!!}'>
        <button class = 'btn blue'>mission Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("mission")!!}'>
        <input type = 'hidden' name = '_token' value = '{{ Session::token() }}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate">
            <label for="name">name</label>
        </div>
        <div class="input-field col s6">
            <input id="post_id" name = "post_id" type="text" class="validate">
            <label for="post_id">post_id</label>
        </div>
        <div class="input-field col s6">
            <input id="description" name = "description" type="text" class="validate">
            <label for="description">description</label>
        </div>
        <div class="input-field col s6">
            <input id="status" name = "status" type="text" class="validate">
            <label for="status">status</label>
        </div>
        <div class="input-field col s6">
            <input id="start_time" name = "start_time" type="text" class="validate">
            <label for="start_time">start_time</label>
        </div>
        <div class="input-field col s6">
            <input id="end_time" name = "end_time" type="text" class="validate">
            <label for="end_time">end_time</label>
        </div>
        <div class="input-field col s6">
            <input id="complete_time" name = "complete_time" type="text" class="validate">
            <label for="complete_time">complete_time</label>
        </div>
        <div class="input-field col s6">
            <input id="amount" name = "amount" type="text" class="validate">
            <label for="amount">amount</label>
        </div>
        <div class="input-field col s6">
            <input id="staff_id" name = "staff_id" type="text" class="validate">
            <label for="staff_id">staff_id</label>
        </div>
        <div class="input-field col s6">
            <input id="upper" name = "upper" type="text" class="validate">
            <label for="upper">upper</label>
        </div>
        <button class = 'btn red' type ='submit'>Create</button>
    </form>
</div>
@endsection