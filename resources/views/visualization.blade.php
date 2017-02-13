@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <a class="btn btn-default pull-right" href="{{ action('HomeController@index') }}">
                    Voltar
                  </a>
                  <h4>Visualization</h4>
                </div>
                <div class="panel-body">
                  {{var_dump($dataset)}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
