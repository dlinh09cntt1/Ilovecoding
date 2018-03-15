<?php
function lovecode_save_checkbox(){
   ob_start();
   $checkboxValue = $_POST[data];
   ?>
   <h3><?php echo esc_attr($checkboxValue);?></h3>
   <?php
   $response = ob_get_clean();
   echo json_encode( $response );
   exit;
}
add_action( 'wp_ajax_ilc_save_checkbox', 'ilc_save_checkbox' );
add_action( 'wp_ajax_nopriv_ilc_save_checkbox', 'ilc_save_checkbox');