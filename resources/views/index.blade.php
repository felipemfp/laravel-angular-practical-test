@extends('layouts.app')

@section('content')
@verbatim
<div class="container" ng-app="womenAndScience" ng-controller="datasetController as vm">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button type="button" class="btn btn-default pull-right" ng-click="vm.upload()">
                    Upload
                  </button>
                  <h4>Dashboard</h4>
                </div>
                <div ng-if="vm.isLoading()" class="panel-body">
                  Wait a moment.
                </div>
                <div ng-if="!vm.isLoading() && vm.dataset === null" class="panel-body">
                  Please upload a dataset.
                </div>
                <div ng-if="!vm.isLoading() && vm.dataset !== null" class="panel-body">
                  <h4><i>Programa Mulher e Ciência</i> at
                    <select class="form-control" ng-model="yearFilter" ng-init="yearFilter = yearFiler || '2012'" style="width: auto; display: inline">
                      <option ng-repeat="(year, _) in vm.valuesByYear">{{ year }}</option>
                    </select>
                  </h4>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>State</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="value in vm.valuesByYear[yearFilter] | orderBy: '-data'">
                        <td>{{ vm.states[value.state_id].description }}</td>
                        <td>{{ value.data }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="panel-footer">
                  Data provided by <a href="http://dados.gov.br/" target="_blank">Portal Brasileiro de Dados Abertos</a>.
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
