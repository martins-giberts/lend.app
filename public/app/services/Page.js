/* global angular */
(function () {
	"use strict";
	
	var injectParams = [];
	var Factory = function() {
		var appName = 'Lend.app sample';
		var title = '';
		
		// TODO: Temporarry translations solution
		var getViewMessages = function(controllerName) {
			var messages = {};
			
			if (controllerName === 'NewLoanController') {
				messages = {
					loanForm: {
						title: 'User & Loan data',
						inputLabels: {
							name: 'Name Surname',
							countryCode: 'Country code',
							phone: 'Phone number',
							iban: 'International Bank Account Number',
							ammount: 'Loan ammount',
							date: 'Payment date (max 30 days)',
							submitButton: 'Apply for loan'
						},
						placeholders: {
							name: 'John Doe',
							countryCode: 371,
							phone: 12345678,
							iban: 'LV00BANK0000000000000'
						}
					},
					loanInfo: {
						title: 'Loan info',
						labels: {
							date: 'Payment date',
							ammount: 'Loan',
							commision: 'Commision',
							total: 'Total'
						}
					},
					errors: {
						required: 'is required',
						pattern: 'has invalid symbols, length or both',
						date: 'has invalid date value'
					}
				};
			}
			
			return messages;
		};
		
		return {
			getAppName: function() {
				return appName;
			},
			title: function() {
				return appName + ((title !== '') ? ' - ' + title : ''); 
			},
			setTitle: function(newTitle) { 
				title = newTitle;
			},
			getViewMessages: getViewMessages
		};
	};
	
	Factory.$inject = injectParams;
	angular.module('lendApp').factory('Page', Factory);
}());