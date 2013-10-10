	<div id="editor-image" class="editor-content" data-ng-controller="componentCtrl">
		<input type="hidden" name="uploadDir" value="/assets/creator/{{workspace.ad.OriginAd.id}}/"/>
		<div id="editorImage-list" class="originUI-bgColorSecondary inline">
			<ul class="originUI-list">
				<li id="editorImage-upload">
					<file-upload class="test" data-label="Upload" data-upload="/assets/creator/{{originAd.id}}/" data-callback="update()">Upload</file-upload>
				</li>
				<li class="originUI-listItem" data-ng-repeat="asset in assets" data-ng-click="select(asset)">
					<a href="javascript:void(0)" class="originUI-hover">{{asset.name}}</a>
				</li>
			</ul>
		</div><!--
		--><div id="editorImage-preview" class="inline originUI-bgColorTertiary" back-img="{{editor.content.image}}"></div>
	</div>
	<style type="text/css">
		#editorImage-list {
			width: 100px;
			height: inherit;
			overflow-y: auto;
			overflow-x: hidden;
			font-size: 12px;
		}
		
		#editorImage-list .originUI-listItem,
		#editorImage-upload {
			margin: 0;
			padding: 0;
		}
		
		#editorImage-list .originUI-listItem > a {
			margin: 0;
			padding: 0;
			height: 26px;
			line-height: 26px;
			text-align: center;
		}
		
		#editorImage-preview {
			background-repeat: no-repeat;
			background-position: center center;
			background-size: auto auto;
			width: 360px;
			height: inherit;
		}	
	
/*
		#editorImage-list {
			width: 100px;
			height: 200px;
			padding: 10px 0;
			overflow: hidden;
		}
		
		#editorImage-preview {
			background-repeat: no-repeat;
			background-position: center center;
			background-size: 100% auto;
			width: 350px;
			height: 200px;
		}
*/
	</style>
	
	
	<script type="text/javascript">
		var componentCtrl = function($scope, $rootScope) {
			$scope.select = function(model) {
				$scope.editor.config.height = model.height+'px';
				$scope.editor.config.width	= model.width+'px';
				
				$scope.editor.content.image = '/assets/creator/'+$scope.originAd.id+'/'+model.name;
				$scope.editor.render		= '<img src="'+$scope.editor.content.image+'" class="image"/>';
			}
/*
			var _scope 	= $scope.$parent;
			
			$scope.$watch('editor.content.imgUpload', function(newValue, oldValue) {
				if(newValue) {
					$scope.editor.content.image = newValue;
					//Calculate image dimensions
					var img = new Image();
					img.src = newValue;
					img.onload = function() {
						$scope.editor.config.height	= img.height+'px';
						$scope.editor.config.width 	= img.width+'px';
						$scope.$apply();
					}
				}
			}, true);
			
			$scope.imageSelect = function(model) {
				$scope.editor.config.height	= model.height+'px';
				$scope.editor.config.width 	= model.width+'px';
				$scope.editor.content.image = '/assets/creator/'+$scope.workspace.ad.OriginAd.id+'/'+model.name;
			}
			
			$rootScope.creatorModalSave = function() {				
				$scope.editor.render		= '<img src="'+$scope.editor.content.image+'" class="image"/>';
				_scope.creatorModalSaveContent($scope.editor);
			}
*/
		}
	</script>