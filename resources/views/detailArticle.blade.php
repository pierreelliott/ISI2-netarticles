@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'validerManga']) !!}
<div class="col-md-12 well well-md">
    <center><h1>Détail article</h1></center>
    <div class="form-horizontal">  
        <div class="form-group">
            <label class="col-md-3 control-label">N° : </label>
            <div class="col-md-8">
                <label class="control-label">{{$article->id_article or ''}}</label>
            </div>
        </div>           
        <div class="form-group">
            <label class="col-md-3 control-label">Titre : </label>
            <div class="col-md-8">
                <label class="control-label">{{$article->titre or ''}}</label>
            </div>
        </div>          
        <div class="form-group">
            <label class="col-md-3 control-label">Résumé : </label>
            <div class="col-md-8">
                <label>{{$article->resume or ''}}</label>
            </div>
        </div>        
        <div class="form-group">
            <label class="col-md-3 control-label">Prix : </label>
            <div class="col-md-8">
                <label class="control-label">{{$article->prix or ''}}</label>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-3 control-label">Date publication : </label>
            <div class="col-md-8">
                <label class="control-label">{{$article->date_article or ''}}</label>
            </div>
        </div>         
        <div class="form-group">
            <label class="col-md-3 control-label">Domaine : </label>
            <div class="col-md-8">
                <label class="control-label">{{$domaine->libdomaine or ''}} </label>
            </div>
        </div>    
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <a href="{{ url('/getArticles')}}/{{$article->id_domaine}}" ><button type="button" class="btn btn-default btn-primary"> Retour</button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{ url('/addBasket')}}/{{$article->id_article}}" ><button type="button" class="btn btn-default btn-primary"> Acquérir</button></a>
            </div> 
        </div> 
        <div class="form-group">

        </div>        
        <div class="col-md-6 col-md-offset-3">
            @include('error')
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
