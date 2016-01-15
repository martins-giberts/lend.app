/* global angular */
(function () {
	"use strict";

	var app = angular.module('lendApp', ['ngRoute', 'ui.mask', 'ui.bootstrap', 'ngAnimate', 'ui.bootstrap.showErrors', 'ngMessages']);

	app.config(['$routeProvider', 'showErrorsConfigProvider', function ($routeProvider, showErrorsConfigProvider) {
		var viewBase = '/views/';
		
		showErrorsConfigProvider.showSuccess(true);

		$routeProvider
		
			// Lend.App basic lending form for clients
			.when('/', {
				controller: 'NewLoanController',
				templateUrl: viewBase + 'new_loan_form.html',
				controllerAs: 'vm'
			})
			
			// Client loans list, history, additional options - extend, pay up
			.when('/my-loans', {
				controller: 'LoansController',
				templateUrl: viewBase + 'my_loans.html',
				controllerAs: 'vm'
			})
			
			// In case anything unexpected happens with the app, show error
			.when('/error', {
				controller: 'ErrorController',
				templateUrl: viewBase + 'error_page.html',
				controllerAs: 'vm'
			})
			.otherwise({ redirectTo: '/' });
	}]);
	
	// TODO: Remove, this was just for learning purpose of writing tests
	app.filter('reverse',[function(){
		return function(string){
			return string.split('').reverse().join('');
		};
	}]);
}());