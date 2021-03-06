@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Edit')
@section('content')

<div class = 'container'>
    <h1>
        Edit log
    </h1>
    <form method = 'get' action = '{!!url("log")!!}'>
        <button class = 'btn blue'>log Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("log")!!}/{!!$log->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="input-field col s6">
            <input id="mission_id" name = "mission_id" type="text" class="validate" value="{!!$log->
            mission_id!!}"> 
            <label for="mission_id">mission_id</label>
        </div>
        <div class="input-field col s6">
            <input id="project" name = "project" type="text" class="validate" value="{!!$log->
            project!!}"> 
            <label for="project">project</label>
        </div>
        <div class="input-field col s6">
            <input id="original" name = "original" type="text" class="validate" value="{!!$log->
            original!!}"> 
            <label for="original">original</label>
        </div>
        <div class="input-field col s6">
            <input id="modification" name = "modification" type="text" class="validate" value="{!!$log->
            modification!!}"> 
            <label for="modification">modification</label>
        </div>
        <button class = 'btn red' type ='submit'>Update</button>
    </form>
</div>
@endsection