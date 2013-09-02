'use strict';

/**
* Draggable directive for library asset items
*/
platformApp.directive('asset', function() {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			element.draggable({
				appendTo: 'body',
				cursorAt: {
					top: 16,
					left: 16 
				},
				helper: 'clone',
				revert: true,
				revertDuration: 0,
				scroll: false,
				start: function(event, ui) {
					//scope.panelSlide('close');
					//element.data('asset', scope.asset);
				}
			});
		}
	}
});

/**
* Keystroke functionality for component configuration fields - ISOLATED USE
*/
platformApp.directive('config', function() {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {			
			element.keypress(function(event) {
				if(event.keyCode === 38 || event.keyCode === 40) {
					switch(event.keyCode) {
						case 38:
							var value 	= element.val().split('px')[0],
                    			value 	= Number(value) + 1;
                    			element.val(value+'px');
							break;
						case 40:
							var value 	= element.val().split('px')[0],
                    			value 	= Number(value) - 1;
                    			element.val(value+'px');
							break;
					}
					scope.$apply(function() {
                    	scope.editor.config[attrs.config] 	= element.val();
                    	//Update workspace - SHOULD THIS UPDATE WORKSPACE???
                    	//console.log(scope.originEditor.content_config[attrs.config]);
                    	//$j('#workspace #content-'+scope.originEditor.id).css(attrs.config, element.val());
                    });
				}
			});
			element.blur(function(event) {
				var value 	= element.val(),
                    value 	= value.match(/[0-9]+/g);
                element.val(value[0]+'px');
                
                scope.$apply(function() {
                    scope.editor.config[attrs.config] 		= element.val();
                    //$j('#workspace #content-'+scope.originEditor.id).css(attrs.config, element.val());
                });              
			});
		}
	}
});

/**
* Layer sorting for components list
*/
platformApp.directive('layerSortable', function() {
	var template = '<li id="contentItem-{{content.id}}" class="content-item" ng:repeat="content in layers|orderBy:\'-order\'" data-layer-id="{{content.id}}">'+
						'<span class="content-item-wrapper">'+
							'<span class="content-handle inline originUI-hover">handle</span>'+
							'<span class="content-label inline">{{content.content.title}}-{{content.id}}</span>'+
							'<span class="content-edit inline originUI-hover" ng:click="creatorModalOpen(\'content\', \'\', content)">edit</span>'+
						'</span>'+
					'</li>';
	return {
		restrict: 'A',
		replace: false,
		scope: true,
		template: template,
		link: function(scope, element, attr) {
			element.sortable({
				'axis':		'y',
				'handle':	'.content-handle, .content-label',
				'update': function(event, ui) {
					var newOrder	= $j(element).find('.content-item').length - 1;
					
					$j(element).find('.content-item').each(function() {
						//console.log($j(this).data('id'));
						
						for(var i in scope.workspace.ad.OriginAdSchedule[scope.ui.schedule][scope.ui.content]) {
							
							if($j(this).data('layer-id').toString() === scope.workspace.ad.OriginAdSchedule[scope.ui.schedule][scope.ui.content][i].id.toString()) {
								scope.$apply(function() {
									scope.workspace.ad.OriginAdSchedule[scope.ui.schedule][scope.ui.content][i].order = newOrder;
								});
								
								newOrder--;
							}
						}
						
					});
					//$j('#actions-wrapper').fadeIn(300);
				}
			});
		}
	}
});

/**
* Drag and drop uploader
*/
platformApp.directive('panelUpload', function() {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			$j(document).bind('drop dragover', function (e) {
				e.preventDefault();
			});
		
			element.fileupload({
				dataType: 	'json',
				dropZone: 	$j('#creator-panel-left'),
				url: 		'/administrator/Origin/upload',
				add: function(e, data) {
					data.submit();
					//console.log(data);	
				},
				stop: function(e, data) {
					scope.updateLibrary();
					scope.creatorToggle('library');
					scope.$apply();
				}
			});
		}
	}
});

/**
* Allows drag and drop add-to-workspace functionality from assets library
*/
platformApp.directive('workspace', function(){
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			scope.$watchCollection('[ui.platform, ui.state]', function() {
				var config	= angular.fromJson(scope.originAd.config);
				//sets width/height
				element.css({
					'width':		config[scope.ui.platform][scope.ui.state].width+'px',
					'height':		config[scope.ui.platform][scope.ui.state].height+'px',
					'margin-top':	-(config[scope.ui.platform][scope.ui.state].height/2)+'px',
					'margin-left':	-(config[scope.ui.platform][scope.ui.state].width/2)+'px'
				});
				
			});
		
			//Accepts drag and drop items from library
/*
			element.droppable({
				accept: '.asset',
				drop: function(event, ui) {
					var id 		= ui.draggable.data('asset'),
						data = {
							content: {
								type: 	scope.library[id].type,
								title:	scope.library[id].name
							},
							config: {
								top: 	Math.floor(event.pageY - $j(this).offset().top - 16)+'px',
								left:	Math.floor(event.pageX - $j(this).offset().left - 16)+'px',
								width: 	scope.library[id].width,
								height: scope.library[id].height
							},
							type: scope.library[id].type
						};
					
					switch(scope.library[id].type) {
						case 'flash':
							//FINISH THIS....
							break;
						default:
							data.render = '<img src="http://'+document.domain+'/assets/creator/'+originAd_id+'/'+scope.library[id].name+'" <%=style%>/>';
							break;
					}
					
					//Send data over to controller to save
					scope.creatorLibrarySave(data);
				}
			});
*/
							
		}	
	}
});

/**
* Displays workspace content. Permits dragging, resizing and selection functions
*/
platformApp.directive('workspaceContent', function() {
	return {
		restrict: 'E',
		replace: true,
		template: '<div class="workspace-content" ng:dblclick="creatorModalOpen()" ng:click="creatorCompanionSelect()"></div>',
		scope: {
			/* creatorCompanionSelect: '&click', */
			creatorModalOpen: 		'&doubleClick',
			ngModel: 				'='
		},
		link: function(scope, element, attrs) {
		
			//Updates the workspace z-index based on layer panel updates
			scope.$watch('ngModel.order', function(newValue, oldValue) {
				if(newValue !== oldValue) {
					element.css({'zIndex': scope.ngModel.order});
				}
			});
			
			//Prep CSS
			var css = {
				'height':	scope.ngModel.config.height,
				'width':	scope.ngModel.config.width,
				'left':		scope.ngModel.config.left,
				'top':		scope.ngModel.config.top,
				'zIndex':	scope.ngModel.order
			};
			
			//Prep render
			var render = scope.ngModel.render;
			
			element.attr('id', 'content-'+scope.ngModel.id);
			
			//Compile config into inline styles
			element.css(css).html(render).append('<span class="workspace-content-label">'+scope.ngModel.content.title+'</span>').addClass('content-'+scope.ngModel.content.type);
			
			//Make it draggable
			element.draggable({
				cancel: '.content-background',
				containment: $j('#creator-panel-workspace'),
				iframeFix: true,
				snap: true,
				snapTolerance: 7,
				stop: function(event, ui) {
					//$j('#actions-wrapper').fadeIn(300);
					
					//construct config dataset
					scope.ngModel.config = {
						top: 	Math.round(ui.position.top)+'px',
						left: 	Math.round(ui.position.left)+'px',
						width: 	Math.round(ui.helper.width())+'px',
						height: Math.round(ui.helper.height())+'px'
					}
				}
			});
			
			//Make it resizable
			element.resizable({
				cancel: '.content-image, .content-background',
				containment: $j('#creator-panel-workspace'),
				handles: 'all',
				stop: function(event, ui) {
					//$j('#actions-wrapper').fadeIn(300);
					
					//construct config dataset
					scope.ngModel.config = {
						top: 	Math.round(ui.position.top)+'px',
						left: 	Math.round(ui.position.left)+'px',
						width: 	Math.round(ui.helper.width())+'px',
						height: Math.round(ui.helper.height())+'px'
					}
					
					switch(scope.ngModel.type) {
						case 'springboard':
							var width	= ui.originalSize.width+'px',
								height	= ui.originalSize.height+'px';
							
							scope.ngModel.content.embed = scope.ngModel.content.embed.replace(width, scope.ngModel.config.width);
							scope.ngModel.content.embed = scope.ngModel.content.embed.replace(height, scope.ngModel.config.height);
							break;
					}
				}
			});	
			
			//Selecting a content item will highlight the companion content throughout the UI
			element.click(function() {
				element.attr('tabindex', -1).focus().keydown(function(event) {
					if((event.keyCode >= 37 && event.keyCode <= 40) || event.keyCode === 8) {
						event.preventDefault();
						var position  = element.position();
						switch(event.keyCode) {
							case 37:
								var value 	= position.left - 1;
                    				element.css({left: value+'px'});
								break;
							case 38:
								var value 	= position.top - 1;
                    				element.css({top: value+'px'});
								break;
							case 39:
								var value 	= position.left + 1;
                    				element.css({left: value+'px'});
								break;
							case 40:
								var value 	= position.top + 1;
                    				element.css({top: value+'px'});
								break;
							case 8:
								scope.$parent.creatorModalRemove(scope.ngModel);
								break;
						}
						
						if(event.keyCode !== 8) {							
							//$j('#actions-wrapper').fadeIn(300);
							var newPosition  = element.position();
							//construct config dataset
							scope.ngModel.config = {
								top: 	newPosition.top+'px',
								left: 	newPosition.left+'px',
								width: 	element.width()+'px',
								height: element.height()+'px'
							}
						}
					}
					
				}).blur(function() {
					//console.log('here');
					$j('.content-item').removeClass('active');
				});
			
				$j('.content-item').removeClass('active');
				$j('#contentItem-'+scope.ngModel.id).addClass('active');	
			});	
		}
	}
});