// Karma configuration
// Generated on Mon Jan 11 2016 15:55:52 GMT+0000 (UTC)

module.exports = function(config) {
	config.set({
	
		// base path that will be used to resolve all patterns (eg. files, exclude)
		basePath: '',


		// frameworks to use
		// available frameworks: https://npmjs.org/browse/keyword/karma-adapter
		frameworks: ['jasmine', 'requirejs'],


		// list of files / patterns to load in the browser
		files: [
			'test-main.js',
			'node_modules/angular/angular.js',
			'node_modules/angular-mocks/angular-mocks.js',			

			'public/bower_components/DateJS/build/production/date.min.js',
			'public/bower_components/angular-route/angular-route.min.js',
			'public/bower_components/angular-messages/angular-messages.min.js',
			'public/bower_components/angular-animate/angular-animate.min.js',
			'public/bower_components/angular-ui-mask/dist/mask.min.js',
			'public/bower_components/angular-bootstrap/ui-bootstrap.min.js',
			'public/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js',
			'public/bower_components/angular-bootstrap-show-errors/src/showErrors.min.js',
			
			'public/app/*.js',
			'public/tests/*.js',
			//'public/tests/first.js',
			{pattern: 'public/app/*.js, public/tests/*.js', included: false}
		],


		// list of files to exclude
		exclude: [
		],


		// preprocess matching files before serving them to the browser
		// available preprocessors: https://npmjs.org/browse/keyword/karma-preprocessor
		preprocessors: {
		},


		// test results reporter to use
		// possible values: 'dots', 'progress'
		// available reporters: https://npmjs.org/browse/keyword/karma-reporter
		reporters: ['progress'],


		// web server port
		port: 9876,


		// enable / disable colors in the output (reporters and logs)
		colors: true,


		// level of logging
		// possible values: config.LOG_DISABLE || config.LOG_ERROR || config.LOG_WARN || config.LOG_INFO || config.LOG_DEBUG
		logLevel: config.LOG_INFO,


		// enable / disable watching file and executing tests whenever any file changes
		autoWatch: true,


		// start these browsers
		// available browser launchers: https://npmjs.org/browse/keyword/karma-launcher
		browsers: ['PhantomJS'],


		// Continuous Integration mode
		// if true, Karma captures browsers, runs the tests and exits
		singleRun: false
	});
};
