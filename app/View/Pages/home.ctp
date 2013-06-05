<?php
?>

<div id="homepage-container" ng:controller="homeController">
<!--
	<div id="homepage-cover">
		<a href="/demo/Origin/{{ad.OriginAd.id}}" class="showcase-ad" target="_blank" ng:repeat="ad in ads|limitTo:10|filter:{OriginAd.showcase:1}">
			<img class="showcase-ad" ng:src="{{ad.OriginAd.content.img_thumbnail}}"/>
			<span class="showcase-adTitle originUI-bgColor">{{ad.OriginAd.name}}</span>
		</a>
	</div>
	<div class="clear"></div>
	 ng:animate="'originUI-fade'"
-->


	<div id="homepage-products" class="inline originUI-bgColorSecondary originUI-shadow">
		<ul class="originUI-list">
			<li ng:repeat="product in products" class="homepage-product originUI-hover originUI-borderColorSecondary" ng:click="loadGuideline(product, $index)" ng:class="(guidelines.OriginTemplate.alias == product.OriginTemplate.alias)?'active':''" ng:cloak>
				<span class="product-name">{{product.OriginTemplate.name}}</span>
				<img class="product-image" ng:src="{{product.OriginAds.content.img_thumbnail}}"/>
			</li>
		</ul>
	</div><!--
	--><div id="homepage-guidelines" class="inline originUI-bgColor originUI-shadow">
		<h3 id="" class="originUI-tileHeader originUI-borderColor originUI-textColor">{{guidelines.OriginTemplate.name}} Ad Unit</h3>
		<ul id="guidelines-platforms" class="originUI-list">
			<li id="guidelines-platforms{{platform.name}}" class="guidelines-platformsIcon originUI-hover" ng:show="guidelines.OriginTemplate.config.dimensions.Initial[platform.name].width" ng:repeat="platform in platforms" ng:click="dimensionsShow(platform.name)" ng:class="(platform.name == platformShow)? 'active': ''">{{platform.name}}</li>
		</ul>
		
		<div class="originUI-tileContent" ng:show="guidelinesDisplay" ng:animate="'originUI-fade'">
			<div id="guidelines-summaryWrapper" class="originUI-borderColorSecondary">
				<img id="guidelines-summaryImage" class="inline" ng:src="{{guidelines.OriginAds.content.img_thumbnail}}"/>
				<p id="guidelines-summaryDescription" class="inline">{{guidelines.OriginTemplate.content.description}}</p>
			</div>
			
			<div id="guidelines-initial" class="originUI-borderColorSecondary">
				<h4 id="">Initial</h4>
				<div id="" class="guidelines-imageWrapper">
					<span class="guidelines-imageWidth">{{guidelines.OriginTemplate.config.dimensions.Initial[platformShow].width}}px</span>
					<span class="guidelines-imageHeight">{{guidelines.OriginTemplate.config.dimensions.Initial[platformShow].height}}px</span>
					<img id="" class="guidelines-image" ng:src="{{guidelinesInitial}}" src="http://placehold.it/100/100"/>
				</div>
			</div>
			<div id="guidelines-triggered" class="originUI-borderColorSecondary" ng:show="guidelines.OriginTemplate.config.dimensions.Triggered[platformShow].width > 0">
				<h4 id="">Triggered</h4>
				<div id="" class="guidelines-imageWrapper">
					<span class="guidelines-imageWidth">{{guidelines.OriginTemplate.config.dimensions.Triggered[platformShow].width}}px</span>
					<span class="guidelines-imageHeight">{{guidelines.OriginTemplate.config.dimensions.Triggered[platformShow].height}}px</span>
					<img id="" class="guidelines-image" ng:src="{{guidelinesTriggered}}" src="http://placehold.it/100/100"/>
				</div>
			</div>
		</div>
		
	</div>
	

<!--
	<div id="homepage-products" class="">
		<div class="product-item originUI-bgColor originUI-shadow originUI-borderColor" ng:repeat="product in products|unique:OriginTemplate.alias|filter:{OriginTemplate.status: '1'}">
			<div class="product-meta ">
				<div class="product-metaName originUI-borderColor">{{product.OriginTemplate.name}}</div>
				<div class="product-metaDescription">{{product.OriginTemplate.content.description}}</div>
			</div>
			<a href="/guidelines/{{product.OriginTemplate.alias}}" class="product-link"></a>
		</div>
	</div>
-->
</div>


<?php
	echo $this->Minify->script(array('controllers/homeController'));
	echo $this->Minify->css(array('home'));