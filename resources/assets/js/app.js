require('jquery');
require('bootstrap-sass');

var angular = require('angular');

var app = angular.module('womenAndScience', []);

app.run(['$http', function($http) {
    $http.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
    $http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);

require('./controllers')
