/* global angular */
(function () {
	"use strict";

	// TODO: Move stuff to services
	/*
	 * A controller is the middle man. 
	 * Its main role is to talk to the Service to get the model 
	 * and then make sure this model is available to our presentation layer(html). 
	 * Even in large applications, the controller should be small, compact and dumb!
	 */
	var app = 'lendApp';
	var controllerName = 'NewLoanController';
	var injectParams = [
		'$scope', 
		'$location',
		'$routeParams', 
		'$http', 
		'Page', 
		'User',
		'Loan'
	];
	var Controller = function ($scope, $location, $routeParams, $http, Page, User, Loan) {
		
		Page.setTitle('Apply for new loan');
		
		angular.extend($scope, {
			messages: Page.getViewMessages(controllerName),
			
			// TODO: Read User cookie, detect if this is returning client
			user: new User(),
			loan: new Loan()
		});
		
		// Calendar Popup
		$scope.datePicker = {
			options: {},
			minDate: Date.today(),
			maxDate: Date.today().add({days: 30}),
			opened: false,
			open: function() {
				this.opened = true;
			}
		};
		
		$scope.getTotalAmmount = function() {
			$scope.loan.calculateTotalAmmount();
		};
		
		
		// TODO: Move to API service
		$scope.onSubmitForLoan = function() {
			$scope.$broadcast('show-errors-check-validity');
			
			if (!$scope.loanForm.$valid) {
				return;
			}
			
			// TODO: Disable post button
			// TODO: Get URL from config/settings
			
			// Build request
			$http
				.post('/loan', {
					user: $scope.user,
					loan: $scope.loan
				})
				.then(onSubmitSuccess, onSubmitError);
		};
		
		// TODO: Redirrect to my loans page
		var onSubmitSuccess = function()
		{
			console.log('onSubmitSuccess');
		};
		
		// TODO: Show error page with the returned message
		var onSubmitError = function()
		{
			console.log('onSubmitError');
		};
	};

	Controller.$inject = injectParams;
	angular.module(app).controller(controllerName, Controller);
}());