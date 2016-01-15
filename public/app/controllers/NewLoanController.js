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
		'CurrentUser',
		'Loan'
	];
	var Controller = function ($scope, $location, $routeParams, $http, Page, CurrentUser, Loan) {
		
		Page.setTitle('Apply for new loan');
		
		angular.extend($scope, {
			messages: Page.getViewMessages(controllerName),
			
			// TODO: Read User cookie, detect if this is returning client
			user: CurrentUser,
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
		
		$scope.checkIfValidAmmount = function() {
			var ammount = 0,
				min = $scope.loan.defaultMinAmmount,
				max = $scope.loan.defaultMaxAmmount;
		
			// Take it as zero if undefined
			if (typeof $scope.loanForm.ammount.$modelValue !== 'undefined') {
				ammount = parseInt($scope.loanForm.ammount.$modelValue);
			}
			
			if (ammount < min || max < ammount)
			{
				$scope.loanForm.ammount.$invalid = true;
			}
		};
		
		
		// TODO: Move to API service
		$scope.requestHasErrors = false;
		$scope.apiErrors = {};
		$scope.onSubmitForLoan = function() {
			$scope.$broadcast('show-errors-check-validity');
			
			if (!$scope.loanForm.$valid) {
				console.log($scope.loanForm.$error);
				console.log($scope.loanForm.name.$error);
				return;
			}
			
			if (!$scope.user.canTakeLoan($scope.loan.ammount)) {
				
				$scope.showHighRiskError = true;
				return;
			}
			else {
				$scope.showHighRiskError = false;
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
		var onSubmitSuccess = function(response)
		{
			$scope.user.addLoan(response.data);
			$location.path('/my-loans');
		};
		
		// TODO: Show error page with the returned message
		// TODO: Better and testable error handling
		var onSubmitError = function(response)
		{
			console.log(' $httponSubmitError', response);
			
			// TODO: Right now we are interested only in error messages			
			if (response.data.status !== 'error') {
				return;
			}
			
			$scope.requestHasErrors = true;
			$scope.apiErrors = response.data.messages;
			
		};
	};

	Controller.$inject = injectParams;
	angular.module(app).controller(controllerName, Controller);
}());