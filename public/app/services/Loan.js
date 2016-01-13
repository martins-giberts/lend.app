/* global angular */
(function () {
	"use strict";
	
	var injectParams = [];
	var Factory = function() {
		
		var Loan = function() {
			this.ammount;
			this.commision;
			this.commisionAmmount;
			this.totalAmmount;
			this.date;

			this.initialize = function() {

				// Set default data
				this.ammount = 100;
				this.commision = 1.5;
				this.commisionAmmount = 0;
				this.totalAmmount = 0;

				// TODO: Date should be in wrapper
				this.date =  Date.today().add({days: 7});

				// Calculate commision and total ammount on the go
				this.calculateTotalAmmount();
			};

			// TODO: Include days
			this.calculateCommisionAmmount = function() {
				this.commisionAmmount = (this.ammount/100) * this.commision;
			};

			this.calculateTotalAmmount = function() {
				this.calculateCommisionAmmount();
				this.totalAmmount = parseInt(this.ammount) + this.commisionAmmount;
			};


			this.initialize();
		};
		
		return (Loan);
	};
	
	Factory.$inject = injectParams;
	angular.module('lendApp').factory('Loan', Factory);
}());