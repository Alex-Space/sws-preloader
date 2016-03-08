<?php
/**
 * Register options page
 */
function sws_preloader_options() {
	add_options_page( 'Preloader options', 'Preloader SWS', 'manage_options', 'sws-preloader-options', 'sws_option_page' );
	add_action( 'admin_init', 'sws_preloader_register_settings' );
}
add_action( 'admin_menu', 'sws_preloader_options' );

/**
 * Register settigns for options page
 */
function sws_preloader_register_settings(){
	register_setting( 'sws-preloader-options-group', 'sws_preloader_options', 'sws_preloader_sanitize_options' );
}

/**
 * Sanitize all fields
 */
function sws_preloader_sanitize_options( $options ) {
	$clean_options = array();
	$old_options = get_option( 'sws_preloader_options' );
	
	if ( ! empty( $_FILES['sws-preloader-custom-file']['tmp_name'] ) ) {
		$overrides = array( 'test_form' => false );
		$file = wp_handle_upload( $_FILES['sws-preloader-custom-file'], $overrides );
		$clean_options['url'] = $file['url'];
		$clean_options['file'] = $file['file'];

	} else {
		
		
		if ( ! empty( $old_options['url'] ) && ! empty( $old_options['file'] ) ) {
			$clean_options['url'] = $old_options['url'];
			$clean_options['file'] = $old_options['file'];
		}

	}

	foreach ( $options as $key => $value ) {
		$clean_options[$key] = strip_tags( $value );
	}

	if ( $clean_options['selected-tab'] !== 'upload_a_custom' && ! empty( $clean_options['file'] ) ) {
		unlink( $clean_options['file'] );
		unset( $clean_options['url'] );
		unset( $clean_options['file'] );
	} elseif ( isset( $file ) && isset( $old_options['url'] ) && $file['url'] !== $old_options['url'] ) {
		unlink( $old_options['file'] );
	}

	return $clean_options;
}

/**
 * Options page
 */
function sws_option_page(){
		$options = get_option( 'sws_preloader_options' );
		$type = $options['sws-preloader-type'];
		
		if ( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = $_GET[ 'tab' ];
		} elseif ( isset( $options[ 'selected-tab' ] ) ) {
			$active_tab = $options[ 'selected-tab' ];
		} else {
			$active_tab = 'with_bg';
		}

		function sws_set_selected( $value ) {
			$options = get_option( 'sws_preloader_options' );

			if ( isset( $options['without_bg'] ) ) {
				$type =  'without_bg';
			} elseif ( isset( $options['with_bg'] ) ) {
				$type =  'with_bg';
			} elseif ( isset( $options['upload_a_custom'] ) ) {
				$type = 'upload_a_custom';
			}

			echo ( $options[$type] === $value ) ? 'selected="true"' : '';
		}
	?>
	<div class="wrap">
		<h2 class="dashicons-before sws-header-icon dashicons-update">Preloader SWS</h2>
	    <h2 class="nav-tab-wrapper">
	        <a href="?page=sws-preloader-options&tab=with_bg" class="nav-tab <?php echo ( $active_tab == 'with_bg' ) ? 'nav-tab-active' : ''; ?>">With background</a>
	        <a href="?page=sws-preloader-options&tab=without_bg" class="nav-tab <?php echo ( $active_tab == 'without_bg' ) ? 'nav-tab-active' : ''; ?>">Without background</a>
	        <a href="?page=sws-preloader-options&tab=upload_a_custom" class="nav-tab <?php echo ( $active_tab == 'upload_a_custom' ) ? 'nav-tab-active' : ''; ?>">Upload a custom</a>
	    </h2>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields( 'sws-preloader-options-group' ); ?>
			<table class="form-table">
				<?php if ( $active_tab === 'with_bg' ) : ?>
					<!-- Preloaders with background section -->
					<tr>
						<th>
							<select name="sws_preloader_options[with_bg]" class="sws-pleloader-choose-select">
								<optgroup label="Dark background">
									<option value="drop.gif" class="sws-preloader-black" <?php sws_set_selected( 'drop.gif' ); ?>>Drop</option>
									<option value="bulb.gif" class="sws-preloader-black" <?php sws_set_selected( 'bulb.gif' ); ?>>Bulb</option>
									<option value="fire.gif" class="sws-preloader-black" <?php sws_set_selected( 'fire.gif' ); ?>>Fire</option>
									<option value="bubble-breathing.gif" class="sws-preloader-black" <?php sws_set_selected( 'bubble-breathing.gif' ); ?>>Breathing bubble</option>
									<option value="crazy-geometry.gif" class="sws-preloader-black" <?php sws_set_selected( 'crazy-geometry.gif' ); ?>>Crazy geometry</option>
									<option value="yellow-r.gif" class="sws-preloader-black" <?php sws_set_selected( 'yellow-r.gif' ); ?>>Yellow R</option>
									<option value="timer.gif" class="sws-preloader-black" <?php sws_set_selected( 'timer.gif' ); ?>>Timer</option>
									<option value="eating-cookie.gif" class="sws-preloader-black" <?php sws_set_selected( 'eating-cookie.gif' ); ?>>Eating cookie</option>
									<option value="hexagons-in-round.gif" class="sws-preloader-black" <?php sws_set_selected( 'hexagons-in-round.gif' ); ?>>Hexagons in round</option>
									<option value="ruby-rotating.gif" class="sws-preloader-dark-blue" <?php sws_set_selected( 'ruby-rotating.gif' ); ?>>Ruby rotating</option>
									<option value="pink-dots.gif" class="sws-preloader-dark-blue" <?php sws_set_selected( 'pink-dots.gif' ); ?>>Pink dots</option>

								</optgroup>
								<optgroup label="Light background">
									<option value="boy-and-girl.gif" class="sws-preloader-white" <?php sws_set_selected( 'boy-and-girl.gif' ); ?>>Boy & girl</option>
									<option value="color-splash-wheel.gif" class="sws-preloader-white" <?php sws_set_selected( 'color-splash-wheel.gif' ); ?>>Multicolor Splash Wheel</option>
									<option value="three-color-gears.gif" class="sws-preloader-white" <?php sws_set_selected( 'three-color-gears.gif' ); ?>>Three multicolor gears</option>
									<option value="two-whater-drops.gif" class="sws-preloader-white" <?php sws_set_selected( 'two-whater-drops.gif' ); ?>>Two water drops</option>
									<option value="waves-triange.gif" class="sws-preloader-white" <?php sws_set_selected( 'waves-triange.gif' ); ?>>Waves in triange</option>
									<option value="geometric-shapes-transformation.gif" class="sws-preloader-white" <?php sws_set_selected( 'geometric-shapes-transformation.gif' ); ?>>Geometric shapes transformation</option>
									<option value="loading-and-a-ball.gif" class="sws-preloader-white" <?php sws_set_selected( 'loading-and-a-ball.gif' ); ?>>Loading & ball</option>
									<option value="envato-leaf.gif" class="sws-preloader-light-grey" <?php sws_set_selected( 'envato-leaf.gif' ); ?>>Envato leaf</option>
									<option value="dancing-multicolor-dots.gif" class="sws-preloader-light-grey" <?php sws_set_selected( 'dancing-multicolor-dots.gif' ); ?>>Dancing multicolor dots</option>
									<option value="infinity-sign.gif" class="sws-preloader-light-green" <?php sws_set_selected( 'infinity-sign.gif' ); ?>>Infinity sign</option>
									<option value="fried-eggs.gif" class="sws-preloader-light-grey" <?php sws_set_selected( 'fried-eggs.gif' ); ?>>Fried eggs</option>
									<option value="three-light-green-gears.gif" class="sws-preloader-pale-blue" <?php sws_set_selected( 'three-light-green-gears.gif' ); ?>>Three light green gears</option>
									<option value="red-monster.gif" class="sws-preloader-light-grey" <?php sws_set_selected( 'red-monster.gif' ); ?>>Red monster</option>
								</optgroup>
								<optgroup label="Juicy background">
									<option value="planet-and-spaceship.gif" class="sws-preloader-gray-blue" <?php sws_set_selected( 'planet-and-spaceship.gif' ); ?>>Planet & spaceship</option>
									<option value="sphere-cutting.gif" class="sws-preloader-yellow" <?php sws_set_selected( 'sphere-cutting.gif' ); ?>>Cutting the sphere</option>
									<option value="gray-cat.gif" class="sws-preloader-light-red" <?php sws_set_selected( 'gray-cat.gif' ); ?>>Gray purring cat</option>
									<option value="small-black-ball.gif" class="sws-preloader-yellow" <?php sws_set_selected( 'small-black-ball.gif' ); ?>>Small black ball</option>
									<option value="loadbar-to-circle.gif" class="sws-preloader-light-red" <?php sws_set_selected( 'loadbar-to-circle.gif' ); ?>>Loadbar to circle</option>
									<option value="upside-black-cat.gif" class="sws-preloader-orange" <?php sws_set_selected( 'upside-black-cat.gif' ); ?>>Upside black cat</option>
									<option value="download-cloud.gif" class="sws-preloader-ligh-blue" <?php sws_set_selected( 'download-cloud.gif' ); ?>>Cloud download</option>
									<option value="jumping-ball.gif" class="sws-preloader-purple" <?php sws_set_selected( 'jumping-ball.gif' ); ?>>Jumping ball</option>
									<option value="jumping-dots.gif" class="sws-preloader-dirty-blue" <?php sws_set_selected( 'jumping-dots.gif' ); ?>>Jumping dots</option>
									<option value="black-squid.gif" class="sws-preloader-dirty-blue" <?php sws_set_selected( 'black-squid.gif' ); ?>>Black squid</option>
									<option value="running-rabbit.gif" class="sws-preloader-purple" <?php sws_set_selected( 'running-rabbit.gif' ); ?>>Running Rabbit</option>
									<option value="african-woman-with-child.gif" class="sws-preloader-green" <?php sws_set_selected( 'african-woman-with-child.gif' ); ?>>African woman with child</option>
								</optgroup>
							</select>
						</th>
					</tr>
					<input type="hidden" name="sws_preloader_options[selected-tab]" value="with_bg">
				<?php elseif ( $active_tab === 'without_bg' ) : ?>
					<!-- Preloaders without background section -->
					<tr>
						<th class="sws-color-picker-inline">
							<select name="sws_preloader_options[without_bg]" class="sws-pleloader-choose-select">
					  			<option value="blue-egg.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'blue-egg.gif' ); ?>>Blue egg</option>
					  			<option value="green-orbits.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'green-orbits.gif' ); ?>>Green orbits</option>
					  			<option value="milk-jug.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'milk-jug.gif' ); ?>>Milk jug</option>
					  			<option value="dot-in-round.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'dot-in-round.gif' ); ?>>Dot in round</option>
					  			<option value="iridescent-house.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'iridescent-house.gif' ); ?>>Iridescent house</option>
					  			<option value="three-squares-change-color.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'three-squares-change-color.gif' ); ?>>Three squares changing color</option>
					  			<option value="snake.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'snake.gif' ); ?>>Snake</option>
					  			<option value="thin-circle.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'thin-circle.gif' ); ?>>Thin circle</option>
					  			<option value="small-thin-circle.gif" class="sws-no-bg-preloader" <?php sws_set_selected( 'small-thin-circle.gif' ); ?>>Small thin circle</option>
							</select>
							<input type="text" id="sws-preloader-bg-color" name="sws_preloader_options[bg_color]" value="<?php echo $options['bg_color']; ?>" class="sws-color-picker" />
						</th>
					</tr>
					<input type="hidden" name="sws_preloader_options[selected-tab]" value="without_bg">
				<?php elseif ( $active_tab === 'upload_a_custom' ) : ?>
					<!-- Custom preloader section -->
					<tr>
						<th>
							Upload preloader image <br>
							<i>( jpg, png, gif )</i>
						</th>
						<td>
							<button class="sws-button-select-file button button-secondary">Upload from computer</button>
							<input type="file" id="sws-preloader-custom-file" name="sws-preloader-custom-file" class="sws-invisible-input">
							<p class="condition"></p>
						</td>
					</tr>
					<tr>
						<th>
							Background color
						</th>
						<td>
							<input type="text" id="sws-preloader-bg-color" name="sws_preloader_options[custom_bg_color]" value="<?php echo $options['custom_bg_color']; ?>" class="sws-color-picker" />
						</td>
					</tr>
					<input type="hidden" name="sws_preloader_options[selected-tab]" value="upload_a_custom">
					<?php if ( ! empty( $options['file'] ) ) : ?>
						<tr>
							<th>Your preloader</th>
							<td>
								<img src="<?php echo $options['url'] ?>" alt="" class="custom-preloader">
							</td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
				<tr>
					<th><?php submit_button( 'Save settigns' ); ?></th>
				</tr>
			</table>
		</form>

	</div>
	<?php
}