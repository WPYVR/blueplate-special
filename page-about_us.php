<?php
/* Template Name: About Us*/

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<h2><?php the_title(); ?></h2>
				<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail(); ?><!-- /featured image-->	
				<?php else:?>
				<img src="<?php echo get_bloginfo('template_url')?>/images/blue_plate.jpg"><!-- /placeholder image-->
				<?php endif; ?>
				<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>
				<?php
					global $bp_options;
	$bp_settings = get_option( 'bp_options', $bp_options );
	
	echo "Visit Us at ".$myaddress."<br />";
				$myaddress = $bp_settings['resto_address'];
				echo $myaddress;
				$address = $myaddress;
			$newaddress = str_replace(" ","+",$address);			
			$ch = curl_init();
			$_url = "http://maps.google.com/maps/api/geocode/json?address='.$newaddress.'&sensor=false";
			$timeout = 5; // set to zero for no timeout
			curl_setopt ($ch, CURLOPT_URL, $_url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$geocode = curl_exec($ch);
			curl_close($ch);
			//$geocode=@file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$newaddress.'&sensor=false');
		if(!$geocode){ return $storelat = ''; $storelng = '';
		} else {
		$output= json_decode($geocode);
		$lat = $output->results[0]->geometry->location->lat;
		$lng = $output->results[0]->geometry->location->lng;
		$latlng = $lat.','.$lng;
		}
		?>

	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
	  function initialize() {
		var myLatlng = new google.maps.LatLng(<?php echo $latlng; ?>);
		var myOptions = {
		  zoom: 14,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		var contentString = '<?php echo $infowindow; ?>';
			
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Location'
		});
		
		  infowindow.open(map,marker);
		
	  }

	</script>
	<div id="map_canvas" style="width:100%; height:450px;position:relative;"><script type="text/javascript">
    initialize(); </script></div>
					</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>