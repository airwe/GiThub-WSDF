<?php global $smof_data; ?>
<?php if($smof_data['slidingbar_open_on_load']): ?>
<div id="slidingbar-area" class="open_onload">
<?php else: ?>
<div id="slidingbar-area">
<?php endif; ?>
	<div id="slidingbar">
		<div class="avada-row">
			<section class="fusion-columns row fusion-columns-<?php echo $smof_data['slidingbar_widgets_columns']; ?> columns columns-<?php echo $smof_data['slidingbar_widgets_columns']; ?>">
				<?php 
				$column_width = 12 / $smof_data['slidingbar_widgets_columns']; 
				if( $smof_data['slidingbar_widgets_columns'] == '5' ) {
					$column_width = 2;
				}				
				?>
			
				<?php if( $smof_data['slidingbar_widgets_columns'] >= 1 ): ?>
				<article class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?> ">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SlidingBar Widget  1')):
				endif;
				?>
				</article>
				<?php endif; ?>
				
				<?php if( $smof_data['slidingbar_widgets_columns'] >= 2 ): ?>
				<article class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SlidingBar Widget  2')):
				endif;
				?>
				</article>
				<?php endif; ?>
				
				<?php if( $smof_data['slidingbar_widgets_columns'] >= 3 ): ?>
				<article class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SlidingBar Widget  3')):
				endif;
				?>
				</article>
				<?php endif; ?>
				
				<?php if( $smof_data['slidingbar_widgets_columns'] >= 4 ): ?>
				<article class="fusion-column col last <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SlidingBar Widget  4')):
				endif;
				?>
				</article>
				<?php endif; ?>

				<?php if( $smof_data['slidingbar_widgets_columns'] >= 5 ): ?>
				<article class="fusion-column col last <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SlidingBar Widget  5')):
				endif;
				?>
				</article>
				<?php endif; ?>

				<?php if( $smof_data['slidingbar_widgets_columns'] >= 6 ): ?>
				<article class="fusion-column col last <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('SlidingBar Widget  6')):
				endif;
				?>
				</article>
				<?php endif; ?>
				<div class="fusion-clearfix"></div>
			</section>			
		</div>
	</div>
	<div class="sb-toggle-wrapper"><a class="sb-toggle" href="#"></a></div>
</div>
<?php wp_reset_postdata(); ?>