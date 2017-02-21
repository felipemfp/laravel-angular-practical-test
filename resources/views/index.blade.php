@extends('layouts.app')

@section('content')
@verbatim
<div class="container" ng-cloak ng-app="womenAndScience" ng-controller="DatasetController as vm">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button type="button" class="btn btn-default pull-right" ng-click="vm.upload()">
                    Upload
                  </button>
                  <h4>Dashboard</h4>
                </div>
                <div ng-if="vm.isLoading()" class="panel-body">
                  Wait a moment...
                </div>
                <div ng-if="!vm.isLoading() && vm.dataset === null" class="panel-body">
                  Please upload a dataset.
                </div>
                <div ng-if="!vm.isLoading() && vm.dataset !== null && vm.dataset.values.length === 0" class="panel-body">
                  Please upload a valid dataset or try again.
                </div>
                <div ng-if="!vm.isLoading() && vm.dataset !== null && vm.dataset.values.length > 0" class="panel-body">
                  <div>
                    The Women and Science program offers research opportunity in Brazil since 2005.
                  </div>
                  <div class="row">
                    <div class="col-lg-6" ng-repeat="(region, _) in vm.regions">
                      <h4>{{ region }}</h4>
                      <div>
                        <canvas id="datasetChart-{{ region }}" width="400" height="250"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                  Data provided by <a href="http://dados.gov.br/" target="_blank">Portal Brasileiro de Dados Abertos</a>.
                  <a href="http://portal.mec.gov.br/component/content/article?id=4175:sp-780687610" target="_blank" class="pull-right">
                    Read more
                  </a>
                </div>
            </div>
        </div>
    </div>
    <div hidden>
      <form action="/upload" method="post" enctype="multipart/form-data">
        @endverbatim
        {{ csrf_field() }}
        @verbatim
        <input id="{{ vm.datasetInputId }}" type="file" name="dataset" accept=".xml" />
      </form>
    </div>
</div>
@endverbatim
@endsection
