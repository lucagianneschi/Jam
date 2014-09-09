<?php
/* box collaboration
 * box chiamato tramite load con:
 * data: {data,typeuser}
 */


//adattare questo codice
$collaboratorsBox = new CollaboratorsBox();
$collaboratorsBox->init($_POST['id'], 8, 0);

if (is_null($collaboratorsBox->error)) {
    $venuesCollaborators = $collaboratorsBox->venueArray;
    $jammersCollaborators = $collaboratorsBox->jammerArray;
    $venuesCollaboratorsCounter = count($venuesCollaborators);
    $jammersCollaboratorsCounter = count($jammersCollaborators);
    $totCollaborators = $_POST['collaborationcounter'];
    ?>
    <!-- Collaboration-->
    <div class="row" id="social-collaboration">
        <div  class="large-12 columns">
    	<h3 style="cursor: pointer" onclick="loadBoxRelation('collaboration', 21, 0,<?php echo $totCollaborators; ?>)"><?php echo Yii::t('string', 'view.profile.collaboration.title'); ?> <span class="orange">[<?php echo $totCollaborators ?>]</span></h3>
    	<div class="row  ">
    	    <div  class="large-12 columns ">
    		<div class="box">
			<?php
			if ($totCollaborators > 0) {
			    if ($venuesCollaboratorsCounter > 0) {
				?>
	    		    <div class="row  ">
	    			<div  class="large-12 columns ">
	    			    <div class="text orange">Venue <!--span class="grey">[<?php echo $venuesCollaboratorsCounter ?>]</span--></div>
	    			</div>
	    		    </div>
				<?php
				$totalView = $venuesCollaboratorsCounter > 4 ? 4 : $venuesCollaboratorsCounter;
				$i = 0;
				foreach ($venuesCollaborators as $key => $value) {
				    switch ($value->getType()) {
					case 'JAMMER':
					    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];

					    break;
					case 'VENUE':
					    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
					    break;
				    }
				    if ($i % 2 == 0) {
					?> <div class="row">  <?php } ?>
					<div  class="small-6 columns">
					    <a href="profile.php?user=<?php echo $value['id']; ?>">
						<div class="box-membre">
						    <div class="row " id="collaborator_<?php echo $value['id']; ?>">
							<div  class="small-3 columns ">
							    <div class="icon-header">
								<!-- THUMB USER-->
								<?php
								$fileManagerService = new FileManagerService();
								$thumbPath = $fileManagerService->getUserAvatarPath($value['id'], $value['thumbnail'], true);
								?>
								<img src="<?php echo $thumbPath; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt="<?php echo $value['username']; ?>">
							    </div>
							</div>
							<div  class="small-9 columns ">
							    <div class="text grey-dark breakOffTest"><strong><?php echo $value['username']; ?></strong></div>
							</div>		
						    </div>	
						</div>
					    </a>
					</div>
					<?php if (($i + 1) % 2 == 0 || count($venuesCollaborators) == ($i + 1)) { ?>  </div>  <?php
				    }
				    $i++;
				    if ($i == 4)
					break;
				}
				?>
	    		    <!--FINE venue-->
	    		    <div class="row">
	    			<div  class="large-12 columns"><div class="line"></div></div>
	    		    </div>
				<?php
			    }
			    if ($jammersCollaboratorsCounter > 0) {
				?>
	    		    <div class="row  ">
	    			<div  class="large-12 columns ">
	    			    <div class="text orange">Jammer <!--span class="grey">[<?php echo $jammersCollaboratorsCounter ?>]</span--></div>
	    			</div>
	    		    </div>
				<?php
				$totalView = $jammersCollaboratorsCounter > 4 ? 4 : $jammersCollaboratorsCounter;
				$i = 0;
				foreach ($jammersCollaborators as $key => $value) {
				    switch ($value['type']) {
					case 'JAMMER':
					    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBJAMMER'];
					    break;
					case 'VENUE':
					    $defaultThum = Yii::app()->params['defaultImages']['DEFTHUMBVENUE'];
					    break;
				    }
				    if ($i % 2 == 0) {
					?> <div class="row">  <?php }
				    ?>
					<div  class="small-6 columns">
					    <a href="profile.php?user=<?php echo $value['id']; ?>">
						<div class="box-membre">
						    <div class="row " id="collaborator_<?php echo $value['id']; ?>">
							<div  class="small-3 columns ">
							    <div class="icon-header">
								<?php
								$fileManagerService1 = new FileManagerService();
								$thumbPath1 = $fileManagerService1->getUserAvatarPath($value['id'], $value['thumbnail'], true);
								?>
								<img src="<?php echo $thumbPath1; ?>" onerror="this.src='<?php echo $defaultThum; ?>'" alt="<?php echo $value['username']; ?>">
							    </div>
							</div>
							<div  class="small-9 columns ">
							    <div class="text grey-dark breakOffTest"><strong><?php echo $value['username']; ?></strong></div>
							</div>		
						    </div>	
						</div>
					    </a>
					</div>
					<?php if (($i + 1) % 2 == 0 || count($jammersCollaborators) == ($i + 1)) { ?>  </div>  <?php
				    }
				    $i++;
				    if ($i == 4)
					break;
				}
				?>		    
				<?php
			    }
			} else {
			    ?>	
			    <div class="row  ">
				<div  class="large-12 columns ">
				    <p class="grey"><?php echo Yii::t('string', 'view.profile.collaboration.nodata'); ?></p>
				</div>
			    </div>
			    <?php
			}
			?>
    		</div>	
    	    </div>
    	</div>
        </div>
    </div>
    <?php
}