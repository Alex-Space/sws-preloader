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
								
								<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/dark.php' ); ?>
								<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/light.php' ); ?>
								<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/juicy.php' ); ?>
								
							</select>
						</th>
					</tr>
					<input type="hidden" name="sws_preloader_options[selected-tab]" value="with_bg">
				<?php elseif ( $active_tab === 'without_bg' ) : ?>
					<!-- Preloaders without background section -->
					<tr>
						<th class="sws-color-picker-inline">
							
							<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/no-bg.php' ); ?>
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