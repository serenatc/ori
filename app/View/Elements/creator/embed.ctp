	<div id="embed-widget" data-ng-controller="embedController" data-ng-init="embedInit()">
		<div id="embedWidget-config" class="inline">
			<ul class="originUI-list">
				<li>
					<label class="">Auto Open</label>
					<input-switch class="originUI-switch" name="toggleAutoSwitch" active="Yes" inactive="No" data-ng-model="embedOptions.auto" data-ng-checked="embedOptions.auto === true"></input-switch>
				</li>
				<li data-ng-class="{disabled: !embedOptions.auto}">
					<label class="">Auto Close</label>
					<input-switch class="originUI-switch" name="toggleCloseSwitch" active="Yes" inactive="No" data-ng-model="embedOptions.close" data-ng-checked="embedOptions.close === true" data-ng-disabled="!embedOptions.auto"></input-switch>
				</li>
				<li>
					<label class="">Tablet Unit</label>
					<input-switch class="originUI-switch" name="toggleTabletSwitch" active="Yes" inactive="No" data-ng-model="embedOptions.tablet" data-ng-checked="embedOptions.tablet === true"></input-switch>
				</li>
				<li>
					<label class="">Mobile Unit</label>
					<input-switch class="originUI-switch" name="toggleMobileSwitch" active="Yes" inactive="No" data-ng-model="embedOptions.mobile" data-ng-checked="embedOptions.mobile === true"></input-switch>
				</li>
				<li>
					<label class="">Minified</label>
					<input-switch class="originUI-switch" name="toggleMinifySwitch" active="Yes" inactive="No" data-ng-model="minify" data-ng-checked="minify === true"></input-switch>
				</li>
			</ul>
		</div>
		<div id="embedWidget-codemirror" class="inline">
			<textarea data-ng-model="embed" data-ui-codemirror="{mode:'htmlmixed',lineWrapping:true,theme:'night',readOnly:true}" data-ui-refresh=true><?php //echo $this->element('origin_embed');?></textarea>
		</div>
	</div>
	<style type="text/css">
		.modal #embed {
			height: 300px;	
		}
		
		.modal #embed #embedWidget-codemirror {
			width: 450px;
			font-size: 12px;
		}
		
		#embed-widget {
			width: inherit;
			height: inherit;
		}
		
		#embedWidget-config {
			width: 100px;
			margin-right: 15px;
		}
		
		#embedWidget-config .originUI-list > li {
			margin: 0 0 10px 0;
		}
		
		#embedWidget-codemirror {
			width: 350px;
			height: 235px;
			font-size: 11px;
		}
	</style>
	<script type="text/javascript">
		var embedController = function($scope, $interpolate, Rest) {
			var embed, embedUrl;
			
			function _refresh() {
				$scope.embed = $interpolate(embed)($scope);
			}
			
			function _loadEmbed() {
				embedUrl = ($scope.minify)? 'origin_embed_min': 'origin_embed';
				
				Rest.element('creator', embedUrl).then(function(response) {
					embed = response;
					_refresh();
				});
			}
			
			$scope.embedInit = function() {
				$scope.minify = true;
				
				$scope.embedOptions = {
					id: $scope.originAd.id,
					placement: angular.fromJson($scope.originAd.config).placement,
					auto: false,
					close: false,
					tablet: false,
					mobile: false
				};
				//_loadEmbed();
			}
			
			$scope.$watchCollection('[embedOptions.auto, embedOptions.close, embedOptions.tablet, embedOptions.mobile]', function(newVal) {
				if(newVal && embed) {
					//Special condition for auto/close
					if(!$scope.embedOptions.auto) {
						$scope.embedOptions.close = false;
					}
					_refresh();
				}
			});
			
			$scope.$watch('minify', function(newVal) {
				_loadEmbed();
			});
			
		}
	</script>