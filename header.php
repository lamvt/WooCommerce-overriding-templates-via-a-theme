<?php $options = get_option( 'd4j_theme_options' ); ?> 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
	<title>
	<?php
		
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		if ( $paged >= 2 || $page >= 2 ){
			echo ' | ' . sprintf( 'Page %s' , max( $paged, $page ) );		
		}
	?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() .'/images/favicon.png'; ?>">
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">
	<?php 		
		$img_site ='';		
		if (is_category()) {
			$cat = get_query_var('cat');
			$metacat= strip_tags(category_description($cat));
			$description =  $metacat;
			$category = get_the_category();
			if($category[0]){ ?>
				<meta content="<?php get_category_link($category[0]->term_id ) ?>" property="og:url">
				<meta content="<?php get_category_link($category[0]->term_id ) ?>" name="Twitter:url">
				<link href="<?php get_category_link($category[0]->term_id ) ?>" rel="canonical">
			<?php }
		}
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ){
			$description = $site_description; 
			?>		
			<meta content="<?php bloginfo('url') ?>" property="og:url">
			<meta content="<?php bloginfo('url') ?>" name="Twitter:url">
			<link href="<?php bloginfo('url') ?>" rel="canonical">
		<?php }
		if (is_single() || is_page() ) {
			if (have_posts() ) {
				while (have_posts() ) : the_post();
				$description= word_limiter(get_the_excerpt(),100,'');
				?>
				<meta content="<?php the_permalink() ?>" property="og:url">
				<meta content="<?php the_permalink() ?>" name="Twitter:url">
				<link href="<?php the_permalink() ?>" rel="canonical">
				<?php 
				if (function_exists('wp_get_attachment_thumb_url')) {
					$img_site = wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); 
				}
				endwhile;				
			}			
		}
		if($img_site ==''){
			$img_site = get_template_directory_uri().'/images/logo.png';
		}		
	?>	
	<meta name="description" content="<?php	echo $description ;?>">
	<meta name="author" content="<?php echo $options['gplusurl'] ; ?>">	
	<meta content="<?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?>" property="og:title">
	<meta content="<?php echo $img_site; ?>" property="og:image">
	<meta content="<?php echo $description ;?>" property="og:description">
	<meta content="summary" name="Twitter:card">
	<meta content="<?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?>" name="Twitter:title">
	<meta content="<?php echo $description ;?>" name="Twitter:description">
	<meta content="<?php echo $img_site; ?>" name="Twitter:image">
	<link rel="author" href="<?php echo $options['gplusurl'] ; ?>"/>
	<link href="<?php echo site_url().'/xmlrpc.php';?>" rel="pingback">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
	<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
	<?php wp_head(); ?>
	
	<?php if(is_single()){?>	
		<script src="<?php echo site_url() ;?>/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min.js" type="text/javascript"></script>
		<script src="<?php echo site_url() ;?>/wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.init.min.js" type="text/javascript"></script>
	<?php }?>
	<script>
		 if (typeof jQuery == 'undefined'){
		    document.write(unescape('%3Cscript src="<?php echo get_template_directory_uri(); ?>/js/jquery-min.js" %3E%3C/script%3E'));
		 }
		</script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.sequence-min.js"></script>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			var options = {
				autoPlay: true,
				autoPlayDelay: 3000,
				pauseOnHover: false, 
				hidePreloaderDelay: 500,
				nextButton: true,
				prevButton: true,
				pauseButton: true,
				preloader: true,
				pagination:true,
				hidePreloaderUsingCSS: false,                   
				animateStartingFrameIn: true,    
				navigationSkipThreshold: 750,
				preventDelayWhenReversingAnimations: true,
				customKeyEvents: {
					80: "pause"
				}
			};
			var sequence = jQuery("#sequence").sequence(options).data("sequence");			   
		});
	</script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>	
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
<body>
