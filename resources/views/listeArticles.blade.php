@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-8">
        <div class="blanc">
            <h2>Liste des articles du domaine {{ $domaine->libdomaine }} </h2>
        </div>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:10%">Id</th> 
                    <th style="width:60%">Titre</th>  
                    <th style="width:10%">Prix</th> 
                    <th style="width:10%">Résumé</th> 
                    <th style="width:10%">Panier</th>                     
                </tr>
            </thead>
           @foreach($articles as $article)
            <tr>   
                <td> {{ $article->id_article }} </td> 
                <td> {{ $article->titre }} </td> 
                <td> {{ $article->prix }} </td>                 
                <td style="text-align:center;"><a href="{{ url('/getArticle') }}/{{ $article->id_article }}">
                        <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Résumé"></span></a></td>
                <td style="text-align:center;">
                        <a href="{{ url('/addBasket') }}/{{ $article->id_article }}">
                        <span class="glyphicon glyphicon-shopping-cart" data-toggle="tooltip" data-placement="top" title="Panier"></span></a></td>
                </td>                    
            </tr>
            @endforeach
        </table>
        @include('error')
    </div>
</div>
@stop
