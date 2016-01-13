/* global angular */
(function () {
	"use strict";
	
	var injectParams = [];
	var Factory = function() {
		
		var User = function() {
			this.name;
			this.countryCode;
			this.phone;
			this.iban;
			
			// Auto add test data
			this.initialize = function() {
				this.name = 'John';
				this.countryCode = '371';
				this.phone = '12345678';
				this.iban = 'LV00BANK0000000001234';
			};
			
			this.initialize();
		};
		
		return (User);
	};
	
	Factory.$inject = injectParams;
	angular.module('lendApp').factory('User', Factory);
}());