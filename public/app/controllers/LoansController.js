/* global angular */
(function () {
	"use strict";

	var injectParams = ['Page'];
	var Controller = function (Page) {
		Page.setTitle('My Loans');
	};

	Controller.$inject = injectParams;
	angular.module('lendApp').controller('LoansController', Controller);
}());