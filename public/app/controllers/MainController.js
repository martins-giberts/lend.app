/* global angular */
(function () {
	"use strict";

	var injectParams = ['$scope', '$location', '$routeParams', 'Page'];
	var Controller = function ($scope, $location, $routeParams, Page) {
		$scope.Page = Page;
		
		$scope.messages = {
			appName: 'Lend.app Sample'
		};		
		
		$scope.getPath = function() {
			$scope.activePath == $location.path();
		};
		$scope.getPath();
		
		// TODO: Update isActive on URL change
		$scope.navList = [
			{
				name: 'Apply for loan',
				href: '/'
			},
			{
				name: 'My loans history',
				href: '/my-loans'
			}
		];
	};

	Controller.$inject = injectParams;
	angular.module('lendApp').controller('MainController', Controller);
}());