/* global angular */
(function () {
	"use strict";
	
	var injectParams = ['Loan'];
	var Factory = function(Loan) {
		
		var User = function() {
			this.id;
			this.ip;
			this.name;
			this.countryCode;
			this.phone;
			this.iban;
			this.updated;
			this.created;
			
			// All the user loans as Loan
			this.loans = [];
			
			// Auto add test data
			this.initialize = function() {
				// Placeholder
			};
			
			this.clearLoans = function() {
				this.loans = [];
			};
			
			this.addLoan = function(data) {
				var loan = new Loan();
				angular.extend(loan, data);
				loan.initialize();

				this.loans.push(loan);
			};
			
			this.canTakeLoan = function(ammount) {
				
				if (this.isLoanLimitReachedToday()) {					
					return false;
				}
				
				// TODO: Refactor - bad place to set maxAmmount
				var maxAmmount = 1000;
				if (this.isNightTime() && parseInt(ammount) === maxAmmount) {
					return false;
				}
				
				return true;
			};
			
			this.isLoanLimitReachedToday = function() {
				
				// TODO: Less than 3 Loans in past 24h
				var dayAgo = (24).hours().ago().getTime();
				var failedChecks = 0;
				for (var i = 0; i < this.loans.length; i++) {
					if (!this.loans[i].isOlderThan(dayAgo)) {
						failedChecks++;
					}
					
					if (failedChecks > 3) {
						return true;
					}
				}
				
				return false;
			};
			
			this.isNightTime = function() {
				
				// TODO: Time is between 0.00 and 6.00
				var now = Date.today().setTimeToNow().getTime();
				var midnight = Date.parse('12am').getTime();
				var morning = Date.parse('6am').getTime();
				
				return (midnight < now && now < morning);
			};			
			
			this.initialize();
		};
		
		return (User);
	};
	
	Factory.$inject = injectParams;
	angular.module('lendApp').factory('User', Factory);
}());