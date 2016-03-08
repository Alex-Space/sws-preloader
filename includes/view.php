<?php


if ( ! is_admin() && ! preg_match("/wp-login/i", $_SERVER['REQUEST_URI'] ) ) {
	
	function sws_add_preloader_to_frontend() {
		$options = get_option( 'sws_preloader_options' );
		$image_with_bg = $options['with_bg'];
		$image_without_bg = $options['without_bg'];
		$image_custom = $options['url'];
		
		switch ( $image_with_bg ) {
			
			case 'yellow-r.gif':
				$bg_color = '#000';
				break;

			case 'two-iridescent-drops.gif':
			case 'lazy-human-dance.gif':
			case 'runing-clock.gif':
			case 'red-sign-intro.gif':
			case 'boy-and-girl.gif':
			case 'color-splash-wheel.gif':
			case 'three-color-gears.gif':
			case 'two-whater-drops.gif':
			case 'waves-triange.gif':
			case 'geometric-shapes-transformation.gif':
			case 'loading-and-a-ball.gif':
				$bg_color = '#fff';
				break;

			case 'double-whell-with-shadow.gif':
				$bg_color = '#fffffb';
				break;
			
			case 'fire.gif':
				$bg_color = '#18191b';
				break;
				
			case 'fire-2.gif':
				$bg_color = '#100010';
				break;
			
			case 'rotating-ball-loading.gif':
				$bg_color = '#dee1e2';
				break;
			
			case 'planet-earth.gif':
				$bg_color = '#e3f4fd';
				break;
			
			case 'changing-shapes.gif':
				$bg_color = '#9fe2dd';
				break;
			
			case 'drop.gif':
				$bg_color = '#222222';
				break;
			
			case 'bulb.gif':
				$bg_color = '#191f26';
				break;

			case 'bubble-breathing.gif':
				$bg_color = '#1c2126';
				break;
			
			case 'crazy-geometry.gif':
				$bg_color = '#2e2e2e';
				break;

			case 'timer.gif':
				$bg_color = '#3d4049';
				break;

			case 'eating-cookie.gif':
				$bg_color = '#292929';
				break;

			case 'hexagons-in-round.gif':
				$bg_color = '#15191f';
				break;

			case 'ruby-rotating.gif':
				$bg_color = '#00172a';
				break;

			case 'pink-dots.gif':
				$bg_color = '#2f2e33';
				break;

			case 'envato-leaf.gif':
				$bg_color = '#f4f6f4';
				break;

			case 'dancing-multicolor-dots.gif':
				$bg_color = '#ecf0f1';
				break;

			case 'infinity-sign.gif':
				$bg_color = '#c4ebe8';
				break;

			case 'fried-eggs.gif':
				$bg_color = '#f4ecdf';
				break;

			case 'three-light-green-gears.gif':
				$bg_color = '#e3f4fd';
				break;

			case 'space-rocket-charging.gif':
				$bg_color = '#28292e';
				break;

			case 'hexagonal-fractal.gif':
			case 'red-monster.gif':
				$bg_color = '#eeeeee';
				break;

			case 'planet-and-spaceship.gif':
				$bg_color = '#676d89';
				break;

			case 'sphere-cutting.gif':
				$bg_color = '#ffd87b';
				break;

			case 'gray-cat.gif':
				$bg_color = '#ff7c61';
				break;

			case 'small-black-ball.gif':
				$bg_color = '#ffdf01';
				break;

			case 'loadbar-to-circle.gif':
				$bg_color = '#ff5959';
				break;

			case 'upside-black-cat.gif':
				$bg_color = '#e19a2e';
				break;

			case 'download-cloud.gif':
				$bg_color = '#429ace';
				break;

			case 'jumping-ball.gif':
				$bg_color = '#635684';
				break;

			case 'jumping-dots.gif':
				$bg_color = '#2e425d';
				break;

			case 'black-squid.gif':
				$bg_color = '#36465d';
				break;

			case 'running-rabbit.gif':
				$bg_color = '#9b66c8';
				break;

			case 'african-woman-with-child.gif':
				$bg_color = '#bbd140';
				break;

			default:
				$bg_color = '#fff';
				break;
		}

		if ( ! empty( $image_with_bg ) ) {
			
			$preloader = '<div style="background: ' . $bg_color . ' url(' . plugins_url('assets/img/bg-true/' . $image_with_bg, __DIR__) . ') no-repeat center;" class="preloader"></div>';
			echo $preloader;

		} elseif ( ! empty( $image_without_bg ) ) {
			$bg_color = $options['bg_color'];
			$preloader = '<div style="background: ' . $bg_color . ' url(' . plugins_url('assets/img/bg-false/' . $image_without_bg, __DIR__) . ') no-repeat center;" class="preloader"></div>';
			echo $preloader;

		} elseif ( ! empty( $image_custom ) ) {

			$bg_color = $options['custom_bg_color'];
			$preloader = '<div style="background: ' . $bg_color . ' url(' . $image_custom . ') no-repeat center;" class="preloader"></div>';
			echo $preloader;

		}

	}
	add_action( 'wp_head', 'sws_add_preloader_to_frontend' );

}