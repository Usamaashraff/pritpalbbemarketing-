<?php
class Backend 
{
    private $plugin_url = COUPON_PLUGIN_URL;
    public function __construct()
    {
        // $this->plugin_init();
    }
    public function plugin_init()
    {
        add_action( 'init', array($this,'cu_register_post_type') );
        add_action( 'admin_menu', array($this,'cu_generate_coupon_code') );
        add_action( 'save_post', array($this,'cu_save_meta') ,10,2);
        add_action( 'admin_enqueue_scripts', array($this,'cu_js_enqueue') );
    }
    public function cu_register_post_type()
    {
        $labels = array(
            'name'                  => _x( 'Coupons', 'Post type general name', 'textdomain' ),
            'singular_name'         => _x( 'Coupon', 'Post type singular name', 'textdomain' ),
            'menu_name'             => _x( 'Coupons', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'Coupon', 'Add New on Toolbar', 'textdomain' ),
            'add_new'               => __( 'Add New', 'textdomain' ),
            'add_new_item'          => __( 'Add New Coupon', 'textdomain' ),
            'new_item'              => __( 'New Coupon', 'textdomain' ),
            'edit_item'             => __( 'Edit Coupon', 'textdomain' ),
            'view_item'             => __( 'View Coupon', 'textdomain' ),
            'all_items'             => __( 'All Coupons', 'textdomain' ),
            'search_items'          => __( 'Search Coupons', 'textdomain' ),
            'parent_item_colon'     => __( 'Parent Coupons:', 'textdomain' ),
            'not_found'             => __( 'No Coupons found.', 'textdomain' ),
            'not_found_in_trash'    => __( 'No Coupons found in Trash.', 'textdomain' ),
            'featured_image'        => _x( 'Coupon Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'Coupon archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'insert_into_item'      => _x( 'Insert into Coupon', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Coupon', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter Coupons list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'Coupons list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'Coupons list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'coupon' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title' ),
        );
     
        register_post_type( 'coupon', $args );
    }
    function cu_js_enqueue($hook) {
        wp_enqueue_style('coupon_code_jquery_ui_style',   'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
        wp_enqueue_script('coupon_code_jquery_ui_script', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',array('jquery'),true);
        wp_enqueue_script('coupon_code_custom_script',   '/wp-content/plugins/custom-coupan/assets/js/custom-script.js',array('jquery'),true);
    }
    function cu_generate_coupon_code() {

        add_meta_box(
            'coupon_code_metabox', 
            'Coupon Code Generate', 
            array($this,'coupon_code_metabox_callback'), 
            'coupon', 
            'normal', 
            'default' 
        );
    
    }
    
    function coupon_code_metabox_callback( $post ) {
    
    $get_coupon_code = get_post_meta( $post->ID, 'coupon_code', true );
    $get_coupon_code_expiry_date = get_post_meta( $post->ID, 'coupon_code_expiry_date', true );
    wp_nonce_field( 'somerandomstr', '_cu_nonce' );
	echo '<table class="form-table">
		<tbody>
			<tr>
				<th><label for="coupon_code">Coupon Code</label></th>
				<td><input type="text" id="coupon_code" name="coupon_code" value="' . esc_attr( $get_coupon_code ) . '" class="regular-text"><button type="button" class="generate_code">Generate Code</button></td>
			</tr>
			<tr>
				<th><label for="coupon_code_expiry_date">Coupon Code Expire Date</label></th>
				<td><input type="text" id="coupon_code_expiry_date" name="coupon_code_expiry_date" value="' . esc_attr( $get_coupon_code_expiry_date ) . '" class="regular-text datepicker"></td>
			</tr>
			
		</tbody>
	</table>';
        
    }
    
function cu_save_meta( $post_id, $post ) {

	if ( ! isset( $_POST[ '_cu_nonce' ] ) || ! wp_verify_nonce( $_POST[ '_cu_nonce' ], 'somerandomstr' ) ) {
		return $post_id;
	}

	$post_type = get_post_type_object( $post->post_type );

	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if( $post->post_type != 'coupon' ) {
		return $post_id;
	}
    
	if( isset( $_POST[ 'coupon_code' ] ) ) {
		update_post_meta( $post_id, 'coupon_code', sanitize_text_field( $_POST[ 'coupon_code' ] ) );
	} else {
		delete_post_meta( $post_id, 'coupon_code' );
	}
	if( isset( $_POST[ 'coupon_code_expiry_date' ] ) ) {
		update_post_meta( $post_id, 'coupon_code_expiry_date', sanitize_text_field( $_POST[ 'coupon_code_expiry_date' ] ) );
	} else {
		delete_post_meta( $post_id, 'coupon_code_expiry_date' );
	}
	

	return $post_id;

}
    
}


?>