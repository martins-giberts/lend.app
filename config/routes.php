<?php

return [
	
	// Users
	['method'=>'get', 'url'=>'/user', 'controller'=>'UserController', 'action'=>'index', 'name'=>'currentUser'],
	['method'=>'post', 'url'=>'/user', 'controller'=>'UserController', 'action'=>'store', 'name'=>'storeUser'],
	['method'=>'get', 'url'=>'/user/{id}', 'controller'=>'UserController', 'action'=>'show', 'name'=>'showUser'],
	['method'=>'put', 'url'=>'/user/{id}', 'controller'=>'UserController', 'action'=>'update', 'name'=>'updateUser'],
	['method'=>'delete', 'url'=>'/user/{id}', 'controller'=>'UserController', 'action'=>'destroy', 'name'=>'destroyUser'],
	
	// Loans
	['method'=>'get', 'url'=>'/loan', 'controller'=>'LoanController', 'action'=>'index', 'name'=>'listLoan'],
	['method'=>'post', 'url'=>'/loan', 'controller'=>'LoanController', 'action'=>'store', 'name'=>'storeLoan'],
	['method'=>'get', 'url'=>'/loan/{id}', 'controller'=>'LoanController', 'action'=>'show', 'name'=>'showLoan'],
	['method'=>'put', 'url'=>'/loan/{id}', 'controller'=>'LoanController', 'action'=>'update', 'name'=>'updateLoan'],
	['method'=>'delete', 'url'=>'/loan/{id}', 'controller'=>'LoanController', 'action'=>'destroy', 'name'=>'destroyLoan'],
];