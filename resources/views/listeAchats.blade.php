@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-8">
        <div class="blanc">
            <h2>Liste de mes achats</h2>
        </div>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:5%">Id</th> 
                    <th style="width:40%">Titre</th>  
                    <th style="width:25%">Domaine</th>                      
                    <th style="width:20%">Date achat</th>                      
                </tr>
            </thead>
            @foreach($achats as $achat)
            <tr>   
                <td> {{ $achat->id_article }} </td> 
                <td> {{ $achat->titre }} </td> 
                <td> {{ $achat->libdomaine }} </td>                 
                <td> {{ $achat->date_achat }} </td>                                    
            </tr>
            @endforeach
        </table>
        @include('error')
    </div>
</div>
@stop