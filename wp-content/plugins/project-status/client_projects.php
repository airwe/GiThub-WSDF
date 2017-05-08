<!DOCTYPE html>
	<head>
	<meta charset="utf-8" />
	<title>Project Status for <?php echo get_post_meta($post->ID, 'client_name', true); ?>, <?php the_title(); ?></title> 	
	
	<?php $siteurl = get_option('siteurl'); ?>
  	<?php echo '<!-- site url:'.$siteurl.' -->'; ?>
	<?php $cssurl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/main.css';	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $cssurl; ?>">

	
</head>
<body>
	
	<div id="page">
		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>

					<header id="primary" class="clearfix">
						<hgroup>
							<h1><strong>Project Status For:</strong> <?php echo get_post_meta($post->ID, 'client_name', true); ?>, <?php the_title(); ?></h1>
							<!-- <h2 id="logo"><a href="/">3.7 DESIGNS</a></h2> -->
						</hgroup>
					</header>
					
						<header id="secondary" class="clearfix">
							<article id="project_details">	
								<h4>Project Description</h4>
								<?php the_content(); ?>
								
								<h4>Project Timing</h4>
								<ul>
									<li><strong>Start Date:</strong> <?php echo get_post_meta($post->ID, 'project_start', true); ?></li>
									<li><strong>Predicted End:</strong> <?php echo get_post_meta($post->ID, 'project_end', true); ?></li>
								</ul>
								
							</article>

							<article id="project_status" class="clearfix">
								<div class="current_tasks">
									<h3>Current Tasks</h3>
									<?php echo get_post_meta($post->ID, 'current_tasks', true); ?>
								</div>
								<div class="current_holds">
									<h3>Current Holds</h3>
									<?php echo get_post_meta($post->ID, 'current_holds', true); ?>
								</div>
							</article><!--/#project_status-->
						</header> <!--/header-->

						<section id="progress_bar">

							<h3>Project Overview and Overall Progress</h3>

							<div class="meter">
								<span class="progress-<?php echo get_post_meta($post->ID, 'progress', true); ?>"></span>
							</div>

							<div id="milestones" class="clearfix">
								<div class="p20">
									<h4><span><strong>20%</strong></span> <b>20%</b> <?php echo get_post_meta($post->ID, 'twenty_percent_title', true); ?></h4>
									<?php echo get_post_meta($post->ID, 'twenty_percent_desc', true); ?>
								</div>
								<div class="p40">
									<h4><span><strong>40%</strong></span> <b>40%</b> <?php echo get_post_meta($post->ID, 'fourty_percent_title', true); ?></h4>
									<?php echo get_post_meta($post->ID, 'fourty_percent_desc', true); ?>
								</div>
								<div class="p60">
									<h4><span><strong>60%</strong></span> <b>60%</b> <?php echo get_post_meta($post->ID, 'sixty_percent_title', true); ?></h4>
									<?php echo get_post_meta($post->ID, 'sixty_percent_desc', true); ?>
								</div>
								<div class="last p80">
									<h4><span><strong>80%</strong></span> <b>80%</b> <?php echo get_post_meta($post->ID, 'eighty_percent_title', true); ?></h4>
									<?php echo get_post_meta($post->ID, 'eighty_percent_desc', true); ?>
								</div>
							</div>	

						</section>
						<?php if ( comments_open() ) : ?>
						<section id="project_discussion">
							
							<h3>Project Discussion</h3>
							<?php comments_template( '', true ); ?>
						</section>
						<?php endif; ?>

						<footer id="credit">
							<p><?php echo get_post_meta($post->ID, 'footer_text', true); ?></p></footer>
						</footer>

			<?php endwhile; ?>

				<!-- Navigation -->

			<?php else : ?>

				<!-- No Posts Found -->

		<?php endif; ?>
		
	
	</div>
	
	
</body>
</html>