	<?php 	
	if(!isset($this->params['pass'][0]) || $this->params['pass'][0] !== 'triggered') {
	?>	
		<div id="initial" content-container="initial">
			<div id="content-{{content.id}}" data-ng-repeat="content in originAd_content['OriginAd<?php echo $originAd_platform;?>InitialContent']" content="content"></div>
		</div>
	<?php 
	} else { 
	?>
		<div id="triggered" content-container="triggered">
			<div id="content-{{content.id}}" data-ng-repeat="content in originAd_content['OriginAd<?php echo $originAd_platform;?>TriggeredContent']" content="content"></div>
		</div>	
	<?php 
	} 
	?>