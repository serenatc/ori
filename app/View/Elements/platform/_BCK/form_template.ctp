<?php if($view === 'left') { ?>

<ul class="originUI-list">
	<li>
		<label>Name</label>
		<div class="originUI-field">
			<div class="originUI-fieldBracket"></div>
			<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.name" required/>
		</div>
	</li>
	<li>
		<label>Description</label>
		<div class="originUI-field">
			<div class="originUI-fieldBracket"></div>
			<textarea class="originUI-textarea originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.content.description" required></textarea>
		</div>
	</li>
	<li>
		<div id="adTemplate-storyboardUpload" class="originUI-upload originUI-icon originUiIcon-upload">
			<span class="originUI-uploadLabel">Upload Storyboard</span>
			<input type="file" name="files[]" id="adTemplate-upload-storyboard" class="originUI-uploadInput" ng:model="<?php echo $editor;?>.content.file_storyboard" fileupload>
		</div>
	</li>
	<li>
		<div id="adTemplate-guidelineUpload" class="originUI-upload originUI-icon originUiIcon-upload">
			<span class="originUI-uploadLabel">Upload Guidelines</span>
			<input type="file" name="files[]" id="adTemplate-upload-guideline" class="originUI-uploadInput" ng:model="<?php echo $editor;?>.content.file_guideline" fileupload>
		</div>
	</li>
</ul>

<?php } else if($view === 'right') { ?>
	<ul class="originUI-list">
		<li>
			<label>Ad Type</label>
			<select class="originUI-select originUI-bgColorSecondary" data-ng-model="<?php echo $editor;?>.config.type" data-ng-change="templateSelect('<?php echo $editor;?>', <?php echo $editor;?>.config.type)">
				<option style="display:none" value="">Select Type</option>
				<option value="default">Standard</option>
				<option value="expand">Expanding</option>
				<option value="overlay">Overlay</option>
				<option value="prestitial">Prestitial</option>
				<option value="interstitial">Interstitial</option>
				<!-- <option value="interstitial" data-ng-show="<?php echo $editor;?>.alias === 'antemeridian' || <?php echo $editor;?>.alias === 'postmeridian'">Interstitial</option> -->
			</select>
		</li>
		<li>
			<label>Placement</label>
			<select class="originUI-select originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.placement">
				<option style="display:none" value="">Select Position</option>
				<option value="default">Standard (inline)</option>
				<option value="top">Top of the Page</option>
				<option value="bottom">Bottom of the Page</option>
			</select>
		</li>
	</ul>
	<tabset id="adSettings-dimensions">
		<?php 
			$platforms	= array('Desktop', 'Tablet', 'Mobile');
			foreach($platforms as $key=>$platform) {
		?>
		<tab heading="<?php echo $platform;?>">
			<div id="adSettings-platform">
				<label class="inline adSettings-label">Enabled</label>
				<div id="" class="inline adSettings-input">
					<div class="originUI-switch">
					    <input type="checkbox" name="<?php echo $editor.$platform;?>ToggleSwitch" class="originUI-switchInput" id="<?php echo $editor.$platform;?>ToggleSwitch" data-ng-model="<?php echo $editor;?>.config.<?php echo $platform;?>.status" data-ng-change="templatePlatform('<?php echo $editor;?>', '<?php echo $platform;?>')">
					    <label class="originUI-switchLabel" for="<?php echo $editor.$platform;?>ToggleSwitch">
					    	<div class="originUI-switchInner">
					    		<div class="originUI-switchActive">
					    			<div class="originUI-switchText">Yes</div>
							    </div>
							    <div class="originUI-switchInactive">
							    	<div class="originUI-switchText">No</div>
								</div>
						    </div>
					    </label>
				    </div>
				</div>
			</div>
			<ul class="originUI-list" data-ng-show="<?php echo $editor;?>.config.<?php echo $platform;?>.status" data-ng-hide="!<?php echo $editor;?>.config.<?php echo $platform;?>.status" data-ng-animate="'originUI-fade'">
				<li>
					<label class="inline adSettings-label">{{<?php echo $editor;?>.templateType.initialWidth}}</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" data-ng-model="<?php echo $editor;?>.config.<?php echo $platform;?>.Initial.width"/>
					</div>
				</li>
				<li>
					<label class="inline adSettings-label">{{<?php echo $editor;?>.templateType.initialHeight}}</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" data-ng-model="<?php echo $editor;?>.config.<?php echo $platform;?>.Initial.height"/>
					</div>
				</li>
				<li data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('triggered') >= 0">
					<label class="inline adSettings-label">Triggered Width</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" data-ng-model="<?php echo $editor;?>.config.<?php echo $platform;?>.Triggered.width"/>
					</div>
				</li>
				<li data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('triggered') >= 0">
					<label class="inline adSettings-label">Triggered Height</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" data-ng-model="<?php echo $editor;?>.config.<?php echo $platform;?>.Triggered.height"/>
					</div>
				</li>
				<li id="adTemplate-configSelector" data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('animation') >= 0">
					<label class="originUI-label inline adSettings-label">Selector</label>
					<select class="originUI-select originUI-bgColorSecondary inline adSettings-input" data-ng-model="<?php echo $editor;?>.config.<?php echo $platform;?>.Animations.selector">
						<option style="display:none" value="">Select</option>
						<option value="initial">Initial</option>
						<option value="triggered">Triggered</option>
					</select>
				</li>
				<li data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('animation') >= 0">
					<label class="originUI-label inline adSettings-label">Animation Start</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.<?php echo $platform;?>.Animations.start"/>
					</div>
				</li>
				<li data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('animation') >= 0">
					<label class="originUI-label inline adSettings-label">Animation End</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.<?php echo $platform;?>.Animations.end"/>
					</div>
				</li>
				<li data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('animation') >= 0">
					<label class="originUI-label inline adSettings-label">Opening Duration</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.<?php echo $platform;?>.Animations.openDuration"/>
					</div>
				</li>
				<li data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('animation') >= 0">
					<label class="originUI-label inline adSettings-label">Closing Duration</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.<?php echo $platform;?>.Animations.closeDuration"/>
					</div>
				</li>
				<li data-ng-hide="<?php echo $editor;?>.templateType.hide.indexOf('timer') >= 0">
					<label class="originUI-label inline adSettings-label">Close Timer</label>
					<div class="originUI-field inline adSettings-input">
						<div class="originUI-fieldBracket"></div>
						<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.<?php echo $platform;?>.Animations.timer"/>
					</div>
				</li>
			</ul>
		</tab>
		<?php } ?>
	</tabset>

<!--



<accordion close-others="true" id="adTemplate-templateConfig" class="originUI-accordion originUI-superAdmin">
	<?php 
		$platforms	= array('Desktop', 'Tablet', 'Mobile');
		foreach($platforms as $key=>$platform) {
			$isOpen	= ($key === 0)? "true": "false";
	?>
	<accordion-group heading="<?php echo $platform;?> Dimensions" is-open="<?php echo $isOpen;?>" class="">
		<div class="inline adTemplate-config">					
			<label class="originUI-label inline">Initial Width</label>
			<div class="originUI-field">
				<div class="originUI-fieldBracket"></div>
				<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.dimensions.Initial.<?php echo $platform;?>.width"/>
			</div>
		</div>
		<div class="inline adTemplate-config">
			<label class="originUI-label">Initial Height</label>
			<div class="originUI-field">
				<div class="originUI-fieldBracket"></div>
				<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.dimensions.Initial.<?php echo $platform;?>.height"/>
			</div>
		</div>
		<div class="inline adTemplate-config" data-ng-hide="templateHide.hide">
			<label class="originUI-label inline">Triggered Width</label>
			<div class="originUI-field">
				<div class="originUI-fieldBracket"></div>
				<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.dimensions.Triggered.<?php echo $platform;?>.width"/>
			</div>
		</div>
		<div class="inline adTemplate-config" data-ng-hide="templateHide.hide">
			<label class="originUI-label">Triggered Height</label>
			<div class="originUI-field">
				<div class="originUI-fieldBracket"></div>
				<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.dimensions.Triggered.<?php echo $platform;?>.height"/>
			</div>
		</div>
	</accordion-group>
	<?php }//End-foreach ?>
	<accordion-group heading="Animation">
		<div data-ng-show="templateHide.hide">
			<div class="inline adTemplate-config" data-ng-show="templateHide.close">
				<label class="originUI-label">Close Timer</label>
				<div class="originUI-field">
					<div class="originUI-fieldBracket"></div>
					<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.animations.timer"/>
				</div>
			</div>
		</div>
		<div data-ng-hide="templateHide.hide || templateHide.overlay">
			<div id="adTemplate-configSelector" class="inline adTemplate-config">
				<label class="originUI-label">Selector</label>
				<select class="originUI-select originUI-bgColorSecondary" data-ng-model="<?php echo $editor;?>.config.animations.selector">
					<option style="display:none" value="">Select Selector</option>
					<option value="initial">Initial</option>
					<option value="triggered">Triggered</option>
				</select>
				
			</div>
			<div class="inline adTemplate-config">
				<label class="originUI-label">Selector Start</label>
				<div class="originUI-field">
					<div class="originUI-fieldBracket"></div>
					<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.animations.start"/>
				</div>
			</div>
			<div class="inline adTemplate-config">
				<label class="originUI-label">Selector End</label>
				<div class="originUI-field">
					<div class="originUI-fieldBracket"></div>
					<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.animations.end"/>
				</div>
			</div>
			<div class="inline adTemplate-config">
				<label class="originUI-label">Opening Duration</label>
				<div class="originUI-field">
					<div class="originUI-fieldBracket"></div>
					<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.animations.openDuration"/>
				</div>
			</div>
			<div class="inline adTemplate-config">
				<label class="originUI-label">Closing Duration</label>
				<div class="originUI-field">
					<div class="originUI-fieldBracket"></div>
					<input type="text" class="originUI-input originUI-bgColorSecondary" ng:model="<?php echo $editor;?>.config.animations.closeDuration"/>
				</div>
			</div>
		</div>
	</accordion-group>
</accordion>
-->
<?php } ?>