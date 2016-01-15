/* global angular */
(function () {
	"use strict";
	
	var injectParams = [];
	var Factory = function() {
		
		var Loan = function() {
			this.defaultMinAmmount = 100;
			this.defaultMaxAmmount = 1000;
			
			this.id;
			this.userId;
			this.ammount;
			this.commision;
			this.commisionAmmount;
			this.totalAmmount;
			this.datePickerDate;
			this.date;
			this.unixTimestamp;
			this.updated;
			this.created;

			this.initialize = function() {

				// Set dummy data
				if (typeof this.id === 'undefined') {
					this.ammount = 100;
					this.commision = 1.5;
					this.commisionAmmount = 0;
					this.totalAmmount = 0;
				}

				// TODO: Date should be in wrapper
				// This should not be here at all
				this.datePickerDate =  Date.today().add({days: 7});

				// Calculate commision and total ammount on the go
				this.calculateTotalAmmount();
				this.getDate();
			};

			// TODO: Include days
			this.calculateCommisionAmmount = function() {
				this.commisionAmmount = (this.ammount/100) * this.commision;
			};

			this.calculateTotalAmmount = function() {
				this.calculateCommisionAmmount();
				this.totalAmmount = parseInt(this.ammount) + this.commisionAmmount;
			};
			
			this.getDate = function() {
				this.date = Date.parse(this.datePickerDate).toString('yyyy-MM-dd');
				
				if (typeof this.created === 'string') {
					this.created = Date.parse(this.created);
				}
			};
			
			this.isOlderThan = function(time) {
				
				if (typeof this.created === 'undefined') {
					return false;
				}
				return (time >= this.created.getTime());
			};
			
			// TODO: Load loan extensions
			// TODO: add extensions as Extension
			this.loadExtensions = function(data) {
				
			};

			this.initialize();
		};
		
		return (Loan);
	};
	
	Factory.$inject = injectParams;
	angular.module('lendApp').factory('Loan', Factory);
}());