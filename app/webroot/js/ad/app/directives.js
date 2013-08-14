'use strict';

angular.module('originAd.directives', [])
	.directive('analytics', function(OriginAdService) {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				element.bind('mouseenter', function() {
					OriginAdService.analyticsLog('Mouse Over');
				});
				
				element.bind('mouseleave', function() {
					OriginAdService.analyticsLog('Mouse Exit');
				})
				
				element.bind('click', function(event) {
					OriginAdService.analyticsLog('Mouse Click (X:'+event.clientX+', Y:'+event.clientY+')');
				})
			}
		}
	})
	.directive('close', function(serviceToggle) {
		return {
			restrict: 'E',
			link: function(scope, element) {
				element.bind('click', function() {
					//serviceToggle.toggleoverlay();
					serviceToggle[scope.xdDataToggle.callback]();
				});
			}
		}
	})
	.directive('collapse', function($rootScope) {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				switch(attrs.collapse) {
					case 'content':
						element.data('source', element.html());
						break;
					case 'iframe':
						element.data('source', element.attr('src'));
						break;
				}
			
				$rootScope.$watch('hiddenView', function(newValue, oldValue) {
					// && (originAd_action === undefined)
					
					//Is this needed..?
					//if(scope.originAd_config.type === 'inpage') {
						//Special case for Overlay type units
						if((typeof originAd_action !== 'undefined') && (originAd_action === 'close')) {
							return false;
						}
						if(element.parent().parent().attr('id') === newValue) {
							/**
							* Hide elements
							*/
							switch(attrs.collapse) {
								case 'content':
									element.html('');
									break;
								case 'iframe':
									element.attr('src', 'about:blank');
									break;
							}
						} else {
							/**
							* Show elements
							*/
							switch(attrs.collapse) {
								case 'content':
									element.html(element.data('source'));
									break;
								case 'iframe':
									element.attr('src', element.data('source'));
									//setInterval(function() {console.log(element.attr('data-status'));}, 3000);
									break;
							}
						}
					//}
				});
			}
		}
	})
	.directive('content', function($compile){
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				//Construct styles object
				var styles = {
					'position':	'absolute',
					'width':	scope.content.config.width,
					'height':	scope.content.config.height,
					'top':		scope.content.config.top,
					'left':		scope.content.config.left,
					'zIndex':	scope.content.order
				},
				render	= angular.element(decodeURIComponent(scope.content.render.replace(/\+/g, ' '))).css(styles);
				element.append($compile(render)(scope));
			}
		}
	})
	.directive('contentContainer', function($rootScope) {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				var param	= attrs.contentContainer[0].toUpperCase() + attrs.contentContainer.substring(1);
				
				element.css({
					'width':	$rootScope.originAd_config.dimensions[param][origin_platform].width+(($rootScope.originAd_config.dimensions[param][origin_platform].width.indexOf('%') === -1)? 'px': ''),
					'height':	$rootScope.originAd_config.dimensions[param][origin_platform].height+(($rootScope.originAd_config.dimensions[param][origin_platform].height.indexOf('%') === -1)? 'px': ''),
					'marginLeft': -$rootScope.originAd_config.dimensions[param][origin_platform].width/2 + 'px'
				});
				
				//Add an initial offset for expanding ads
				if($rootScope.originAd_config.type === 'expand' && param === 'Triggered') {
					element.css({
						'top':	$rootScope.originAd_config.dimensions.Initial[origin_platform].height+(($rootScope.originAd_config.dimensions[param][origin_platform].height.indexOf('%') === -1)? 'px': '')
					});
				}
				
				//Add a top offset for overlay's triggered view
				if($rootScope.originAd_config.type === 'overlay' && param === 'Triggered') {
					element.css({
						'marginTop': -$rootScope.originAd_config.dimensions.Initial[origin_platform].height + 'px'
					});
				}
			}
		}
	})
	.directive('countdown', function($rootScope, $timeout, serviceToggle) {		
		return {
			restrict: 'E',
			link: function(scope, element, attrs) {
				var countdownTimer	= function() {
					scope.countdown -= 1;
					if(scope.countdown > 0) {
						$timeout(countdownTimer, 1000);
					} else {
						serviceToggle[scope.xdDataToggle.callback]();
					}
				};
						
				if($rootScope.originAd_config.animations.timer) {
					scope.countdown 	= $rootScope.originAd_config.animations.timer;
					countdownTimer();	
				} else {
					angular.element(element).css('visibility', 'hidden');
				}
			}
		}
	})
	.directive('dfp', function($rootScope) {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				if(typeof $rootScope.originParams.dfp !== 'undefined') {
					angular.element(element).attr('href', $rootScope.originParams.dfp[attrs.dfp]);
				}
			}
		}
	})
	.directive('overlay', function($rootScope, serviceToggle) {
		return {
			restrict: 'E',
			link: function(scope, element, attrs) {
				angular.element(element).css('backgroundColor', $rootScope.originAd_configContent.hex);
				
				element.bind('click', function() {
					$rootScope.xdDataToggle.type	= attrs.type;
					$rootScope.xdDataToggle.action 	= 'close';
					serviceToggle.toggleoverlay();
/*
					switch(originAd_action) {
						case 'close':
							break;
						case 'open':
							$rootScope.xdDataToggle.action 	= 'close';
							break;
					}
				
					serviceToggle.toggleoverlay();
*/
				});
			}
		}
	})
	.directive('toggle', function(serviceToggle) {
		var trigger;
		function hoverIntent(scope) {
			//??? clearTimeout(autoClose);
			var onMouseStop = function() {
					serviceToggle[scope.xdDataToggle.callback]();
					trigger	= false;
				};
				
			return function() {
				clearTimeout(trigger);
				trigger = setTimeout(onMouseStop, 100);
				//trigger = setTimeout(onMouseStop, 1000 * scope.originParams.hover);
			}();
		}
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				switch(attrs.toggle) {
					case 'click':
						element.bind('click', function() {
							serviceToggle[scope.xdDataToggle.callback]();
						});
						break;
					case 'hover':
						element.bind('mouseenter', function() {
							serviceToggle[scope.xdDataToggle.callback]();
						});
						break;
					case 'hoverIntent':
						element.bind('mousemove', function() {
							hoverIntent(scope);
						});						
					
						element.bind('mouseout', function() {
							clearTimeout(trigger);
						});
						break;
				}
			}
		}	
	});