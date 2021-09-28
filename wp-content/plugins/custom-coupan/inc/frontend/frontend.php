<?php

class Frontend 
{
    private $plugin_url = COUPON_PLUGIN_URL;
    public function __construct()
    {
        // $this->plugin_init();
    }
    public function plugin_init_frontend()
    {
        add_shortcode( 'coupon-code-html', array($this,'cu_shortcode') );
        add_action( 'wp_enqueue_scripts', array($this,'cu_frontend_js_enqueue') );
        add_action("wp_ajax_coupon_check", array($this,"coupon_check"));
        add_action("wp_ajax_nopriv_coupon_check", array($this,"coupon_check"));
    }
    public function cu_shortcode($atts)
    {
        $output="";
       
         $output.='<section class="video-pop">';
         $output.='<div class="video">';
         $output.='    <iframe width="100%" height="100vh" src="https://www.youtube.com/embed/N6hl1No1Syc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
         $output.='    <form class="coupon-form" action="" method="post">';
         $output.='       <p> <label for="coupon-field">coupon code</label></p>';
         $output.='       <p> <input type="text" name="couponcode" class="coupon-field" placeholder="Enter Code Here"></p><br>';
         $output.='        <input type="submit" value="Submit">';
         $output.='    </form> ';
         $output.='</div>';
         $output.='<div class="video">';
         $output.='    <iframe width="100%" height="100vh" src="https://www.youtube.com/embed/N6hl1No1Syc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
         $output.='    <form class="coupon-form" action="" method="post">';
         $output.='       <p> <label for="coupon-field">coupon code</label></p>';
         $output.='       <p> <input type="text" name="couponcode" class="coupon-field" placeholder="Enter Code Here"></p><br>';
         $output.='        <input type="submit" value="Submit">';
         $output.='    </form> ';
         $output.='</div>';
         $output.='<div class="video">';
         $output.='    <iframe width="100%" height="100vh" src="https://www.youtube.com/embed/N6hl1No1Syc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
         $output.='    <form class="coupon-form" action="" method="post">';
         $output.='       <p> <label for="coupon-field">coupon code</label></p>';
         $output.='       <p> <input type="text" name="couponcode" class="coupon-field" placeholder="Enter Code Here"></p><br>';
         $output.='        <input type="submit" value="Submit">';
         $output.='    </form> ';
         $output.='</div>';
         $output.='</section>';
        return $output;
    } 
    public function cu_frontend_js_enqueue()
    {
        wp_enqueue_style('coupon_code_front_end_style',   '/wp-content/plugins/custom-coupan/assets/css/style.css');
        wp_enqueue_script('coupon_code_custom_script',   '/wp-content/plugins/custom-coupan/assets/js/custom-script-frontend.js',array('jquery'),true);
        wp_localize_script( 'coupon_code_custom_script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
    public function coupon_check()
    {
        if(isset($_POST['data'])){
        $args = array(
            'numberposts' => 10,
            'post_type'   => 'coupon'
          );
        $input_coupan_code = $_POST['data'];
          $coupons = get_posts( $args );
          $is_coupon = false;
          if(!empty($input_coupan_code )){
              foreach($coupons as $coupon){
                if($input_coupan_code ==  get_post_meta( $coupon->ID, 'coupon_code', true )){
                    $is_coupon = true;
                }
            }
          }
          
          if($is_coupon){
            echo json_encode(array('error'=>true,'message'=>'Coupon Code is Matched'),true);
          }else{
            echo json_encode(array('error'=>false,'message'=>'Coupon Code is Not Matched'),true);
          }
        }
        
        die();
    }
}

?>