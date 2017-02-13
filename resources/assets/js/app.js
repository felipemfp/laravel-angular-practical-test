require('jquery');
require('bootstrap-sass');

var angular = require('angular');

var app = angular.module('womenAndScience', []);

app.run(function($http) {
    $http.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
    $http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
});

app.controller('datasetController', ['$http', function($http) {
  var vm = this;

  vm.loading = 0;
  vm.datasetInputId = 'datasetInputId';
  vm.dataset = null;
  vm.valuesByYear = {};
  vm.states = {};

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
        vm.dataset = response.data[0];

        vm.valuesByYear = vm.dataset.values.reduce(function(obj, value) {
          if (obj[value.year] !== undefined) {
            obj[value.year].push(value);
          } else {
            obj[value.year] = [value];
          }
          return obj;
        }, {});

        vm.loading--;
      }).catch(function(err) {
        console.error(err);
      });

    vm.loading++;
    $http.get('/api/states')
      .then(function(response) {
        vm.states = response.data.reduce(function(obj, state) {
          obj[state.id] = state;
          return obj;
        }, {});
        vm.loading--;
      }).catch(function(err) {
        console.error(err);
      });
  }

  initialize();
}])
