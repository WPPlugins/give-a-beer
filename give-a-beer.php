<?php 
/*
 
Plugin Name: Give a Beer
Plugin URI: http://www.appchain.com/give-a-beer/
Description: Give a virtual beer to the website/blogger
Author: Turcu Ciprian
License: GPL
Version: 1.0.5
Author URI: http://www.appchain.com

*/

// This prints the widget
function xGABWidgetShow($args) {
    extract( $args );
    $xArrValues = unserialize(get_option('xGABValues'));

    $xGABTitle = $xArrValues[0];
    $xGABBeers = $xArrValues[1];
    $xPPLink = $xArrValues[2];
    ?>
    <?php echo $before_widget;?>
    <?php echo $before_title.$xGABTitle.$after_title;?>
<div align="center">
    <img style="cursor:pointer;" onClick="xGABSend('<?php bloginfo("url"); ?>/wp-content/plugins/give-a-beer/give.php','<?php echo $xPPLink;?>');" src="<?php bloginfo('url'); ?>/wp-content/plugins/give-a-beer/transpbeer.png" alt="Image of a beer - if this shows instead of the picture, you did not install the plugin corectly"/><br/>
    <div id="xGABReturn"><b><?php echo $xGABBeers;?></b> Beers Received</div>
</div>
    <?php echo $after_widget;?>
<?php


}
function xGABWidgetInit() {
// Tell Dynamic Sidebar about our new widget and its control
    register_sidebar_widget(array('Give a Beer', 'widgets'), 'xGABWidgetShow');
    register_widget_control(array('Give a Beer', 'widgets'), 'xGABform');

}
function xGABform() {
    $xArrValues = unserialize(get_option('xGABValues'));
    if($_POST['xGABTitle']) {
        $xArrValues[0] = $_POST['xGABTitle'];
        $xArrValues[2] = $_POST['xGABPPLink'];
        update_option('xGABValues', serialize($xArrValues));
    }
    $title = $xArrValues[0];
    $xPPLink = $xArrValues[2];

    if($title=="") {
        $title = "Give Me a Beer!";
    }
    ?>
	   Title:
<input type="text" name="xGABTitle" value="<?php echo $title;?>" /><br/>
Paypal Link:<input type="text" name="xGABPPLink" value="<?php echo $xPPLink;?>" /> (for donations when people click) - leave empty if you don't want it to redirect once clicked<br/>
<p align="center"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/give-a-beer/transpbeer.png" alt="Image of a beer - if this shows instead of the picture, you did not install the plugin corectly"/></p>
<?php 
}
function xGABAddStyle() {
    ?>
<script type="text/javascript" src="<?php echo bloginfo('url'); ?>/wp-content/plugins/give-a-beer/script.js"></script>
<link rel="stylesheet" href="<?php echo bloginfo('url'); ?>/wp-content/plugins/give-a-beer/style.css" type="text/css" media="screen" />
<?php
}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'xGABWidgetInit');
add_action('wp_print_styles', 'xGABAddStyle');



?>