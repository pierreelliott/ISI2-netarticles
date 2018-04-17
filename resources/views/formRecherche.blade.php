@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'getArticles']) !!}
<div class="col-md-12 well well-md">
    <center><h1>Recherche d'articles</h1></center>
    <div class="form-horizontal">                     
        <div class="form-group">
            <label class="col-md-3 control-label">Domaine : </label>
            <div class="col-md-3">
                <select class="form-control" name="cbDomaine" required>  
                    <OPTION VALUE=0>Sélectionner un domaine</option>
                    @foreach($domaines as $domaine)
                        <option value="{{$domaine->id_domaine}}">
                            {{$domaine->libdomaine}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3">
            @include('error')
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop