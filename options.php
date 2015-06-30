<div class="wrap">
  <h2>Spaceliquis preloader</h2>
  <form method="post" action="options.php">
  <?php wp_nonce_field('update-options'); ?>
  <table class="form-table">
    <tr>
      <td>
        <p>Background color:</p><br>
        <input type="text" name="bg-color" value="<?php echo get_option('new_option_name'); ?>" />
      </td>
    </tr>
    <tr>
      <td>
        <p>Preloader image:</p><br>
        <input type="file" name="preloader-image" value="<?php echo get_option('new_option_name'); ?>" />
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
      </td>
    </tr>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="bg-color,preloader-image" />
    </table>
  </form>
</div>