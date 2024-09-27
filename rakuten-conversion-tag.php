<!-- START of Rakuten Advertising Conversion Tag -->
<?php
if ( $order ) {
    $order_id = $order->get_id(); // Order ID
} else {
    // Handle the error or log it
    error_log('Order object is not valid on the order-received page.');
}
$currency = get_woocommerce_currency(); // Currency
$customer_status = $order->get_user() ? 'Returning' : 'Guest'; // Customer status
$customer_id = $order->get_customer_id(); // Customer ID
$discount_code = ''; // Custom logic needed to fetch discount code
$discount_amount = $order->get_total_discount(); // Discount amount
$tax_amount = $order->get_total_tax(); // Tax amount
$line_items = $order->get_items(); // Order line items
?>
<script type="text/javascript">
	var rm_trans = {
			affiliateConfig: {ranMID: "*Add your ranMID here*", discountType: "item", includeStatus: "false"},			
			
		orderid : "<?php echo $order_id; ?>",
		currency: "<?php echo $currency; ?>",
		customerStatus: "<?php echo $customer_status; ?>",
		conversionType: "Sale",
		customerID: "<?php if ($customer_id === 0) {
		echo "Guest customer";
		} else {
		// Handle registered customer
		echo $customer_id;
		} ?>",
		discountCode: "<?php echo $discount_code; ?>",
		discountAmount: <?php echo $discount_amount; ?>,
		taxAmount: <?php echo $tax_amount; ?>,
		optionalData: {},  /*THIS IS OPTIONAL*/
		lineitems : [
			<?php foreach ($line_items as $item_id => $item): 
            $product = $item->get_product(); 
            $quantity = $item->get_quantity();
            $unit_price = $item->get_subtotal() / $quantity;
            $sku = $product->get_sku();
            $product_name = $item->get_name();
            $brand = $product->get_attribute('brand'); // Assuming you have a 'brand' attribute
            $cat = wc_get_product_category_list($product->get_id()); // Get product categories
            $cat_id = implode(',', $product->get_category_ids()); // Get product category IDs
            $is_sale = $product->is_on_sale() ? 'Y' : 'N'; // Check if product is on sale
            $is_clearance = ''; // Custom logic needed if you have clearance items
            $coupon = ''; // Custom logic needed to get item-specific coupon
        ?>{
			quantity : <?php echo $quantity; ?>,
			unitPrice : <?php echo $unit_price; ?>,
			
			SKU: "<?php echo $sku; ?>",
		 	productName: '<?php echo $product_name; ?>',
	        optionalData: {                          /*THIS IS OPTIONAL*/
              brand: "<?php echo $brand; ?>",                /*THIS IS OPTIONAL*/
              cat: "",               /*THIS IS OPTIONAL*/
              catid: "",          /*THIS IS OPTIONAL*/
              issale: "<?php echo $is_sale; ?>",        /*THIS IS OPTIONAL*/
              isclearance: "<?php echo $is_clearance; ?>", /*THIS IS OPTIONAL*/
              coupon: "<?php echo $coupon; ?>"               /*THIS IS OPTIONAL*/        
          }
	    },

		<?php endforeach; ?>
	]
		
	};
  
	</script>
<!-- END of Rakuten Advertising Conversion Tag -->
