<div id="dashboard" class="" ng:controller="dashboardController" ng:show="activities" ng:animate="'originUI-fade'">
	<h2 class="originUI-header">Dashboard</h2>
	<div id="dashboard-activity" class="inline originUI-tiles originUI-bgColor" data-intro="Recent system activities" data-position="left">
		<h3 id="" class="originUI-tileHeader originUI-borderColor originUI-textColor">Activity</h3>
		<div class="originUI-tileContent">
			<ul class="originUI-list">
				<li ng:repeat="activity in activities">
					<span class="dashboard-activityUser">{{activity.activity.userid}}</span>
					<span class="dashboard-activityAction">{{activity.activity.action}}</span>
					<span class="dashboard-activityAd">{{activity.activity.name}}</span> on 
					<span class="dashboard-activityDate">{{activity.activity.date}}</span>
				</li>
			</ul>
		</div>
	</div><!--
	--><div id="dashboard-right" class="inline">
			<a href="/administrator/list" id="dashboard-creator" class="originUI-tiles" data-intro="Create Origin ad units" data-position="right">
				<div class="originTile-title">Ad Creator</div>
			</a><!--
			--><a href="/administrator/demos" id="dashboard-demo" class="originUI-tiles">
				<div class="originTile-title">Demos</div>
			</a><!--
			--><a href="/administrator/" id="dashboard-analytics" class="originUI-tiles" data-intro="View Origin ad metrics" data-position="right">
				<div class="originTile-title">Analytics</div>
			</a>
	</div>
</div>
<?php
	echo $this->Minify->script(array('controllers/dashboardController'));
?>