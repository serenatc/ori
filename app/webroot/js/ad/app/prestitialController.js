var prestitialController = function($scope, $rootScope, $timeout, OriginAdService, serviceFrequency, serviceTimer, serviceToggle) {
	
	//Configuration object for trigger
	$rootScope.xdDataToggle = {
		callback: 	'toggleoverlay',
		action:		'close',
		id:			$scope.origin_ad.OriginAd.id
	};
	
	switch(originAd_action) {
		case 'close':
			break;
		case 'open':
			//Prestitial initializes & opens
			OriginAdService.analyticsLog('Load');
			$scope.xdAdInit.config.width = $scope.xdAdInit.config.height = '100%';
			OriginAdService.xd($scope.xdAdInit, $scope.originParams.xdSource);
			break;
	}
	
/*
	$scope.xdData.width		= '100%';
	$scope.xdData.height	= '100%';
	$rootScope.countdownShow= true;
	$rootScope.timeout		= '15';
	$scope.countdown		= angular.copy($rootScope.timeout);
	var timer 				= $timeout(serviceToggle.toggleOverlay, $rootScope.timeout * 1000);
	
	$rootScope.$watch('timeout', function(newValue, oldValue) {
		if(newValue !== oldValue) {
			$rootScope.countdownShow	= true;
			$scope.countdown			= angular.copy($rootScope.timeout);
			$timeout.cancel(timer);
			$timeout(serviceToggle.toggleOverlay, $rootScope.timeout * 1000);
		}
	});
*/
	
/*
	$rootScope.countdownCancel = function() {
		$scope.countdownShow = false;
		$timeout.cancel(timer);
	}
*/
/*

	OriginAdService.analyticsLog('Load');
	//console.log($scope.xdData);
	OriginAdService.xd($scope.xdData, $scope.originParams.xdSource);
	
	$rootScope.xdDataToggle = {
		callback: 	'toggleoverlay',
		action:		'close',
		idInitial:	'originAd-'+$scope.origin_ad.OriginAd.id,
		idTriggered:'originAd-'+$scope.origin_ad.OriginAd.id,
		type:		'antemeridian'
	};
	
	$scope.close = function() {
		serviceToggle.toggleoverlay();
	}
*/
	
	//serviceFrequency.init();
	//serviceTimer.init();
}