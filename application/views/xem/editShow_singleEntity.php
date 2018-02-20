<?php
$lastIdentifier = null;
$curElementLocation = null;
?>
<li style="float:left;" class="entityList" data-locationName="<?=$curLocation->name?>">
<div style="float:left;position:relative;" class="entity <?=$curLocation->name?>" data-id="<?=$curLocation->id?>" data-name="<?=$curLocation->name?>">
	<h3 class="<?=$curLocation->name?>">
		<?=anchor($curLocation->url,imgLazy('images/entitys/icon_'.$curLocation->name.'.png'),'target="_blank"')?><span><?=$curLocation->name?></span><?php /*=img(array('src'=>'images/info.png','data-entity'=>$curLocation->name,'data-entityID'=>$curLocation->id,'class'=>'conInfo','alt'=>'Info'))*/?>
	</h3>
	<ul>
		<li>
			<div class="seasonHeaderInfo" id="infoHeader<?=$curLocation->name?>" data-locationName="<?=$curLocation->name?>" data-locationID="<?=$curLocation->id?>">
				<span style="margin-left:5px;"></span>
			</div>
		</li>
		<?php foreach($fullelement->seasonForLocationId($curLocation->id) as $curElementLocation):?>
		<?php if($curElementLocation->absolute_start > 0)
			$absolute_number = $curElementLocation->absolute_start;
		?>
		<li>
			<div class="seasonHeader" id="seasonHeader_<?=$curElementLocation->season?>_<?=$curLocation->name?>" data-season="<?=$curElementLocation->season?>" data-locationName="<?=$curLocation->name?>" data-locationID="<?=$curLocation->id?>">
				<span><?php if($curElementLocation->season == -1) echo 'S*';else echo 'S'.zero_pad($curElementLocation->season,2)?>
                    <?php
				if($curElementLocation->identifier){
					$lastIdentifier = $curElementLocation->identifier;
				}
				if(isset($lastIdentifier))
					echo '| '.anchorEncode($fullelement->getdirectLink($curLocation->id,$lastIdentifier),$lastIdentifier,'target="_blank"');
				?>
				</span>
			</div>
			<div id="seasonEdit_<?=$curElementLocation->season?>_<?=$curLocation->name?>" class="seasonEdit">

				<?=form_open("xem/editSeason",array('class'=>'form-inline','id'=>'seasonEditForm_'.$curLocation->name.'_'.$curElementLocation->season))?>
					<?=form_hidden("element_id",$fullelement->id)?>
					<?=form_hidden("location_id",$curLocation->id)?>
					<?=form_hidden("season_id",$curElementLocation->id)?>
					<?=form_hidden("delete")?>
					<ul>
						<li>
							<label>Season</label><input class="season" name="season" autocomplete="off" maxlength="5" value="<?php if($curElementLocation->season == -1)echo '*';else echo $curElementLocation->season?>" <?=$disabled?>/>
						</li>
						<li>
							<label>Size</label><input class="season" name="size" autocomplete="off" maxlength="3" value="<?php if($curElementLocation->season_size == -1)echo '0';else echo $curElementLocation->season_size?>" <?=$disabled?>/>
						</li>
                        <?php if(!($curLocation->name == 'master' || $curLocation->name == 'scene')):?>
						<li>
							<label>Identifier</label><input class="season" maxlength="20" autocomplete="off" name="identifier" value="<?=$curElementLocation->identifier?>" <?=$disabled?>/>
						</li>
                        <?php endif?>
						<li>
							<label>Ab. Start</label><input class="season" name="absolute_start" autocomplete="off" value="<?php if($curElementLocation->absolute_start == 0)echo 'auto';else echo $curElementLocation->absolute_start?>" <?=$disabled?>/>
						</li>
						<li>
							<label>Ep. Start</label><input class="season" name="episode_start" autocomplete="off" value="<?=$curElementLocation->episode_start?>" <?=$disabled?>/>
						</li>
						<li>
							<input class="btn btn-primary btn-block" type="submit" value="Save" onclick="saveSeasonValues('<?=$curLocation->name?>',<?=$curElementLocation->season?>)" <?=$disabled?>/>
						</li>
						<li>
							<input class="btn btn-danger btn-block" type="button" value="Delete Season" onclick="markSeasonForDeleteAndSubmit('<?=$curLocation->name?>',<?=$curElementLocation->season?>);" <?=$disabled?>/>
						</li>
					</ul>

				</form>
			</div>
			<ul>
			<?php $size = $curElementLocation->season_size;for($i = 0; $i < $size; $i++):?>
				<li class="episode" id="<?=$curLocation->name?>_<?=$curElementLocation->season?>_<?php $curEp = $i+$curElementLocation->episode_start; echo $curEp;?>" data-entity="<?=$curLocation->name?>" data-season="<?=$curElementLocation->season?>" data-episode="<?=$curEp?>" data-absolute="<?=$absolute_number?>">
					<?php if($curElementLocation->season != 0):?><span class="absolute_number"><?php echo zero_pad($absolute_number,3);$absolute_number++;?></span><?php endif?><span class="episode_number">e<?php echo zero_pad($curEp,2)?></span>
				</li>
			<?php endfor?>
			</ul>

		</li>
		<?php endforeach?>
		<li>

			<?php if($editRight):?>
			<div class="newSeason">
				<?=form_open("xem/newSeason", array('class'=>'form-inline'))?>
					<?=form_hidden("element_id",$fullelement->id)?>
					<?=form_hidden("location_id",$curLocation->id)?>
					<ul>
						<li><label>Season</label><input class="season" name="season" autocomplete="off" maxlength="5" value="<?php if(isset($curElementLocation->season)) echo $curElementLocation->season+1?>" <?=$disabled?>/></li>
						<li><label>Size</label><input class="season" name="season_size" autocomplete="off" maxlength="3" value="" <?=$disabled?>/></li>
						<li><label>Identifier</label><input class="season disabled" name="identifier" autocomplete="off" <?php if($curLocation->name == 'master' || $curLocation->name == 'scene'):?>disabled=""<?php endif?> <?php if(isset($lastIdentifier)):?>placeholder="<?=$lastIdentifier?>"<?php endif;?>/></li>
						<li style="margin: 3px 0;"><input class="btn btn-primary btn-block" type="submit" value="Add New Season" <?=$disabled?>/></li>
					</ul>
				</form>

				<div style="height:1px;"></div>
			</div>
			<?php else:?>
			<?php if(count($fullelement->seasonForLocationId($curLocation->id))==0):?>
				<div class="seasonHeaderFake">No Unique Data</div>
			<?php else:?>
				<div class="newSeason"></div>
			<?php endif?>
			<?php endif?>
		</li>
	</ul>
</div>
<div class="seasonConnection" id="con_after_<?=$curLocation->name?>" data-locationName="<?=$curLocation->name?>">

	<div class="editConIcon" id="editConIcon_<?=$curLocation->name?>">
	</div>
</div>

<div class="clear"></div>
</li>