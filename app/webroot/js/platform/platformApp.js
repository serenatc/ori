'use strict';

var platformApp = angular.module('platformApp', 
					[
					'ui', 
					'ui.bootstrap', 
					'originApp.services', 
					'originApp.directives',
					'platformApp.directives',
					'platformApp.filters'
					])
					.run(function($rootScope) {
						//Modal Operations
						$rootScope.originModalOptions = {
							backdropClick:	false,
							backdropFade: 	true
						}
					});


//var originApp = angular.module('originApp', ['ui', 'ui.bootstrap', 'originApp.services', 'originApp.directives', 'originApp.filters']);
