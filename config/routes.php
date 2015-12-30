<?php

return [
	['method'=>'get', 'url'=>'/loan', 'controller'=>'LoanController', 'action'=>'index', 'name'=>'listLoan'],
	['method'=>'post', 'url'=>'/loan', 'controller'=>'LoanController', 'action'=>'store', 'name'=>'storeLoan'],
	['method'=>'get', 'url'=>'/loan/{id}', 'controller'=>'LoanController', 'action'=>'show', 'name'=>'showLoan'],
	['method'=>'put', 'url'=>'/loan/{id}', 'controller'=>'LoanController', 'action'=>'update', 'name'=>'updateLoan'],
	['method'=>'delete', 'url'=>'/loan/{id}', 'controller'=>'LoanController', 'action'=>'destroy', 'name'=>'destroyLoan'],
];