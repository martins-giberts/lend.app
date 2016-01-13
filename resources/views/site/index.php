<?php

use Illuminate\Support\Facades\URL;

?>
<!doctype html>
<html ng-app="lendApp" ng-controller="MainController">
	<head>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo URL::to('/'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo URL::to('/'); ?>/bower_components/angular-bootstrap/ui-bootstrap-csp.css">
		
		<title ng-bind="Page.title()"></title>
	</head>
	<body ng-cloak>
		
		<!-- Fixed navbar -->
		<header class="navbar navbar-default">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#/">{{ messages.appName }}</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav">
				<li ng-repeat="item in navList" class="{{ item.isActive ? 'active' : '' }}"><a href="#{{ item.href }}">{{ item.name }}</a></li>
			  </ul>
			</div>
		  </div>
		</header>
		
		<div ng-view id="ng-view"></div>
	
		<!-- Note: Minified version of angular is not showing proper error messages in console -->
		<!-- TODO: Use require.js-->
		<script src="<?php echo URL::to('/'); ?>/bower_components/DateJS/build/production/date.min.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular/angular.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular-route/angular-route.min.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular-messages/angular-messages.min.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular-animate/angular-animate.min.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular-ui-mask/dist/mask.min.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular-bootstrap/ui-bootstrap.min.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
		<script src="<?php echo URL::to('/'); ?>/bower_components/angular-bootstrap-show-errors/src/showErrors.min.js"></script>
		
		<script src="<?php echo URL::to('/'); ?>/app/app.js"></script>
		<script src="<?php echo URL::to('/'); ?>/app/controllers/MainController.js"></script>
		<script src="<?php echo URL::to('/'); ?>/app/controllers/LoansController.js"></script>
		<script src="<?php echo URL::to('/'); ?>/app/controllers/NewLoanController.js"></script>
		<script src="<?php echo URL::to('/'); ?>/app/controllers/ErrorController.js"></script>
		<script src="<?php echo URL::to('/'); ?>/app/services/Page.js"></script>
		<script src="<?php echo URL::to('/'); ?>/app/services/Loan.js"></script>
		<script src="<?php echo URL::to('/'); ?>/app/services/User.js"></script>
	</body>
</html>