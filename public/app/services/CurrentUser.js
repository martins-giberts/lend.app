/* global angular */
(function () {
	"use strict";
	
	var injectParams = [
		'$http', 
		'User',
		'Loan'
	];
	var Factory = function($http, User, Loan) {
		
		var backendData,
			dummyData = {
				name: 'John',
				phone: '371 12345678',
				iban: 'LV00BANK0000000001234'
			};
		
		var user = new User();				
		this.$get = function() {
			return user;
		};
		
		this.initialize = function() {
			this.getUserBackendData();
			return user;
		};
		
		this.getUserBackendData = function() {
			$http
				.get('/user')
				.then(onGetUserSuccess, onGetUserError);
		};
		
		var self = this;
		var onGetUserSuccess = function(response) {
			backendData = response.data.data;
			loadUserData();
			console.log('success', response.data.data);
		};
		
		var onGetUserError = function(response) {
			backendData = dummyData;
			loadUserData();
			console.log('error', response.data);
		};
		
		var loadUserData = function() {
			angular.extend(user, backendData);
			
			loadUserLoans();
			user.initialize();
		};
		
		var loadUserLoans = function() {
			user.clearLoans();
			
			if (!backendData.hasOwnProperty('loans')) {
				return;
			}
			if (backendData.loans.data.length === 0) {
				return;
			}
			
			for (var i = 0; i < backendData.loans.data.length; i++) {
				user.addLoan(backendData.loans.data[i]);
			}
		};
		
		return this.initialize();
	};
	
	Factory.$inject = injectParams;
	angular.module('lendApp').factory('CurrentUser', Factory);
}());
