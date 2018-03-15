<?php 
// Add the column
function ilc_custom_field( $cols ) {
        $cols["ilc_custom_field"] = "Custom Column";
        return $cols;
}

// Display filenames
function ilc_custom_field_value( $column_name, $id ) {
    $custom_field = get_post_meta($id,'ilc_custom_field',true); 
    ?>
	<input type="checkbox" name="ilc_custom_field_<?php echo get_the_ID();?>" data-id="<?php echo get_the_ID();?>" value="is_protected" <?php checked($custom_field, true);?><?php esc_html_e('Is it protected?','i-love-code'); ?> <br>
	<a href="javascript:void(0)" class="ilc_custom_field_link" > 
		<?php esc_html_e('Configure secure URLs','i-love-code');?>
	</a>
	<?php 
}

// Display filenames
function ilc_save_custom_field( $column_name, $id ) {
	return 0;
}

// Register the column as sortable & sort by name
function filename_column_sortable( $cols ) {
    $cols["ilc_custom_field"] = "Custom Column";
    return $cols;
}
// Hook actions to admin_init
function ilc_hook_new_media_columns() {
    add_filter( 'manage_media_columns', 'ilc_custom_field' );
    add_action( 'manage_media_custom_column', 'ilc_custom_field_value', 10, 2 );
    add_filter( 'manage_upload_sortable_columns', 'filename_column_sortable' );
}
add_action( 'admin_init', 'ilc_hook_new_media_columns' );

/*Custom Javascript*/
if ( ! function_exists( 'ilc_custom_js' ) ) {
	function ilc_custom_js( $data = array() ) {
		$data[] = '
			var TFAjaxURL = "' . esc_js( admin_url( 'admin-ajax.php' ) ) . '";
			var TFSiteURL = "' . get_site_url() . '/index.php' . '";
		';
		return preg_replace( '/\n|\t/i', '', implode( '', $data ) );
	}
}
function ilc_save_checkbox(){
   ob_start();
	echo '403';
   $response = ob_get_clean();
   echo json_encode( $response );
   exit;
}
function ilc_admin_save_checkbox(){
   ob_start();
   $checkboxValue = $_POST[data];
   // tranh truong hop co nguoi dua gia tri sai vao js
   $is_cheked = $checkboxValue['value'] == 'true'; 
   $post_id = $checkboxValue['id'];
   if(get_post_type($post_id) == "attachment"){ // tranh truong hop co nguoi dua gia tri sai vao js
	   update_post_meta($post_id,'ilc_custom_field', $is_cheked);
	   echo 'ok  ';
   }else echo 'false';
   $response = ob_get_clean();
   echo json_encode( $response );
   exit;
}
add_action( 'wp_ajax_ilc_save_checkbox', 'ilc_admin_save_checkbox' );
add_action( 'wp_ajax_nopriv_ilc_save_checkbox', 'ilc_save_checkbox');