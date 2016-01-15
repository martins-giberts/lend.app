/* global angular */
(function () {
	"use strict";

	var app = 'lendApp';
	var controllerName = 'LoansController';
	var injectParams = ['$scope', 'Page', 'CurrentUser'];
	var Controller = function ($scope, Page, CurrentUser) {
		Page.setTitle('My Loans');
		
		angular.extend($scope, {
			messages: Page.getViewMessages(controllerName),
			user: CurrentUser
		});
	};

	Controller.$inject = injectParams;
	angular.module(app).controller(controllerName, Controller);
}());