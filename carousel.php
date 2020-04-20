
<div id="myCarousel" class="carousel slide" data-ride="carousel" >

	<!-- The slideshow -->
	<div class="carousel-inner">
		<div class="carousel-item active">
			<?php 
			echo('<img style="height: 200px; width: auto;" src="' . $tableau[0] . '" />');

			?>
		</div>

		<?php if(count($tableau)>=2) { ?>
			<div class="carousel-item">
				<?php 
				echo('<img style="height: 200px; width: auto;" src="' . $tableau[1] . '" />');

				?>
				</div><?php } ?> <?php if(count($tableau)>=3) { ?>
					<div class="carousel-item">
						<?php 
						echo('<img style="height: 200px; width: auto;" src="' . $tableau[2] . '" />');

						?>
						</div><?php } ?>
					</div>
				</div>
