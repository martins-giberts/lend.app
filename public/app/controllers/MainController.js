/* global angular */
(function () {
	"use strict";

	var injectParams = ['$scope', '$location', '$routeParams', 'Page'];
	var Controller = function ($scope, $location, $routeParams, Page) {
		$scope.Page = Page;
		
		$scope.messages = {
			appName: 'Lend.app Sample'
		};
		
		// TODO: Update isActive on URL change
		$scope.navList = [
			{
				name: 'Apply for loan',
				href: '/',
				isActive: true
			},
			{
				name: 'My loans history',
				href: '/my-loans',
				isActive: false
			}
		];
		
	};

	Controller.$inject = injectParams;
	angular.module('lendApp').controller('MainController', Controller);
}());