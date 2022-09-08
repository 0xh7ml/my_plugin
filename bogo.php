<?php
/*
Buy Item and Auto add gift Item in cart


*/


add_action('template_redirect' , 'bogo');
function bogo(){
	global $woocommerce;
    	$coupon = '3GCFN2DG';
	$gift_product_id = 17; // declare gift item product ID
	$cart_product = array('16','18' ,'19','20');
    	$found = false;
	//check if cart item is cart_product
			if ( sizeof($woocommerce->cart->get_cart()) > 0 ) {
				foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
					$_product = $values['data'];
                    	$cart_product_id = $_product->get_id(); //get cart product id
			if(in_array($cart_product_id,$cart_product)){
                        	foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
                            	$_product = $values['data'];
                        if ($_product->get_id() == $gift_product_id)
                                $found = true;
				$woocommerce->cart->remove_cart_item($gift_product_id);
                        }
                        if(!$found){
                            $woocommerce->cart->add_to_cart($gift_product_id);
                            $woocommerce->cart->add_discount(sanitize_text_field($coupon));
                        }
                    }
                    else{
                        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
                            if ($cart_item['product_id'] == $gift_product_id) {
                                $woocommerce->cart->remove_cart_item($gift_product_id);
                            }
                       }
                    }
		}
	    }
?>
