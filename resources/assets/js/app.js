require('jquery');
require('bootstrap-sass');

var angular = require('angular');
var Chart = require('chart.js');
var randomColor = require('randomcolor');

var app = angular.module('womenAndScience', []);

app.run(function($http) {
    $http.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
    $http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
});

app.controller('datasetController', ['$http, $log', function($http, $log) {
  var vm = this;

  vm.yearFilter = '2012';
  vm.loading = 0;
  vm.datasetInputId = 'datasetInputId';
  vm.dataset = null;
  vm.valuesByYear = {};
  vm.regions = {};
  vm.regionCharts = {};

  vm.upload = function () {
    var datasetInput = angular.element('#' + vm.datasetInputId);

    datasetInput.click();

    datasetInput.off('change').on('change', function() {
      if (datasetInput.get(0).files[0]) {
        datasetInput.parent().submit();
      }
    });
  }

  vm.isLoading = function () {
    return vm.loading > 0;
  }

  var initialize = function () {
    vm.loading++;
    $http.get('/api/datasets')
      .then(function(response) {
        if (response.data.length === 0) {
          return;
        }
        vm.dataset = response.data[0];
        if (vm.dataset.values.length === 0) {
          return;
        }
        vm.valuesByYear = vm.dataset.values.reduce(function(obj, value) {
          if (obj[value.year] !== undefined) {
            obj[value.year].push(value);
          } else {
            obj[value.year] = [value];
          }
          return obj;
        }, {});
      }, function(err) {
        $log.error('XHR Failed for get datasets.\n' + angular.toJson(err.data, true));
      }).then(function() {
        vm.loading--;
        setTimeout(function() {
          drawChart();
        }, 500);
      });

    vm.loading++;
    $http.get('/api/states')
      .then(function(response) {
        vm.regions = response.data.reduce(function(obj, state) {
          if (obj[state.region] !== undefined) {
            obj[state.region].push(state);
          } else {
            obj[state.region] = [state];
          }
          return obj;
        }, {});
      }, function(err) {
        $log.error('XHR Failed for get states.\n' + angular.toJson(err.data, true));
      }).then(function() {
        vm.loading--;
        setTimeout(function() {
          drawChart();
        }, 500);
      });
  }

  var createChartData = function (region) {
    var labels = Object.keys(vm.valuesByYear);

    var datasets = vm.regions[region].map(function (state) {
      var set = {};
      var color = randomColor({
        hue: 'blue',
        format: 'rgba',
        seed: region + state.id,
        alpha: 0.8,
        luminosity: 'light'
      });

      set.fill = false;
      set.borderColor = color;
      set.backgroundColor = color;
      set.label = state.description;
      set.data = labels.map(function(year) {
        return vm.valuesByYear[year].reduce(function (data, value) {
          if (value.state_id === state.id) {
            return value.data;
          }
          return data;
        }, 0);
      });

      return set;
    });

    return {
      labels: labels,
      datasets: datasets
    }
  }

  var drawChart = function () {
    if (vm.isLoading()) {
      return;
    }
    if (vm.dataset.values.length === 0) {
      return;
    }

    Object.keys(vm.regions).forEach(function (region) {
      var data = createChartData(region);
      vm.regionCharts[region] = new Chart('datasetChart-' + region, {
        type: 'line',
        data: data
      });
    });
  }

  initialize();
}])
