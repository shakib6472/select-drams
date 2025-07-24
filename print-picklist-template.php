<?php
// print-picklist-template.php
/** 
 * Template Order Picklist
 * @param $order_id
 * @param $order
 */

function print_if_not_empty($value)
{
	if (!empty($value)) {
		echo esc_html($value) . '<br />';
	}
}


$order = wc_get_order($order_id);
// Customer Name
$customer_name = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
?>

<style>
	.picklist-container {
		max-width: 794px;
		margin: 40px auto;
		font-family: "Helvetica Neue", sans-serif;
		line-height: 18px;
		color: #202020;
		font-size: 13px;
		font-weight: 400;
	}

	.picklist-container .hero-area {
		display: flex;
		flex-direction: column;
		align-items: flex-start;
		text-align: left;
		gap: 0px;
	}

	.picklist-container .hero-area .logo {
		max-width: 80px;
		width: 100%;
		margin-bottom: 10px;
	}

	.picklist-container .hero-area .logo img {
		width: 100%;
	}

	.picklist-container .hero-area .company {
		font-family: "Helvetica Neue", sans-serif;
		font-size: 16px;
		font-weight: 600;
		margin-bottom: 5px;
	}

	.picklist-container .hero-area .address {
		font-size: 14px;
		margin-bottom: 10px;
	}

	.picklist-container .address-area {
		display: flex;
	}

	.picklist-container .address-area .box {
		width: 50%;
	}

	.picklist-container .address-area .box h2 {
		font-size: 16px;
		font-weight: 600;
		margin-bottom: 5px;
		text-decoration: underline;
	}

	.picklist-container .address-area .box p {
		max-width: 70%;
	}

	.picklist-container .receipt-area h2 {
		font-size: 16px;
		font-weight: 600;
		margin-bottom: 5px;
		text-decoration: underline;
	}

	.spacer {
		height: 3px;
		background-color: #2f2f2f;
		width: 100%;
		margin-bottom: 10px;
	}

	.picklist-container .receipt-area .receipt-table {
		width: 100%;
		border-collapse: collapse;
	}

	.picklist-container .receipt-area .receipt-table tr {
		border-bottom: 2px solid #e3e3e3;
	}

	.picklist-container .products-area {
		margin-top: 20px;
	}

	.picklist-container .products-area table {
		width: 100%;
		border-collapse: collapse;
	}

	.picklist-container .products-area table th,
	.picklist-container .products-area table td {
		padding: 5px;
		border-bottom: 1px solid #dedede;
		text-align: left;
	}

	.picklist-container .products-area table th {
		background-color: #f9f9f9;
		font-weight: 600;
	}

	.picklist-container .products-area table tr td .details {
		display: flex;
		flex-direction: row;
		gap: 10px;
		background-color: #f5f5f5;
		padding: 5px;
		width: auto;
	}

	.picklist-container .products-area table tr td .details li {
		list-style: none;
		font-size: 12px;
		color: #333;
	}

	.picklist-container .total-area {
		margin-top: -9px;
	}

	.picklist-container .total-area table {
		width: 100%;
	}

	.picklist-container .total-area table td,
	.picklist-container .total-area table th {
		padding: 5px;
		border-bottom: 1px solid #dedede;
		text-align: left;
	}

	.picklist-container .footer-area {
		margin-top: 40px;
		text-align: center;
		font-size: 12px;
		color: #666;
	}
</style>

<body>
	<div class="picklist-container">
		<section class="hero-area">
			<div class="logo">
				<img src="https://selectdrams.co.uk/wp-content/uploads/2020/07/logo.png" alt="Select Drams Logo" />
			</div>
			<div class="company">Select Drams,</div>
			<div class="address">
				24/26 Langlands Pl,<br />
				East Kilbride,<br />
				Glasgow G75 0YF
			</div>
		</section>

		<section class="address-area">
			<div class="box">
				<h2>Billing Address</h2>
				<p class="address">
					<?php
					print_if_not_empty($customer_name);
					print_if_not_empty($order->get_billing_address_1());
					print_if_not_empty(trim($order->get_billing_address_1() . ' ' . $order->get_billing_address_2()));
					print_if_not_empty($order->get_billing_state());
					print_if_not_empty($order->get_billing_city());
					print_if_not_empty($order->get_billing_postcode());
					print_if_not_empty($order->get_billing_country());
					?>
				</p>
			</div>

			<div class="box">
				<h2>Shipping Address</h2>
				<p class="address">
					<?php
					print_if_not_empty($customer_name);
					print_if_not_empty($order->get_shipping_company());
					print_if_not_empty(trim($order->get_shipping_address_1() . ' ' . $order->get_shipping_address_2()));
					print_if_not_empty($order->get_shipping_state());
					print_if_not_empty($order->get_shipping_city());
					print_if_not_empty($order->get_shipping_postcode());
					print_if_not_empty($order->get_shipping_country());
					?>
				</p>
			</div>
		</section>
		<section class="receipt-area">
			<div class="box">
				<h2>Receipt</h2>
				<div class="spacer"></div>
				<table class="receipt-table">
					<tr>
						<td>Order Number:</td>
						<td>#<?php echo esc_html($order->get_order_number()); ?></td>
					</tr>
					<tr>
						<td>Order Date:</td>
						<td><?php echo esc_html($order->get_date_created()->format('d F Y')); ?></td>
					</tr>
					<tr>
						<td>Payment Method:</td>
						<td><?php echo esc_html($order->get_payment_method_title()); ?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?php echo esc_html($order->get_billing_email()); ?></td>
					</tr>
					<tr>
						<td>Telephone:</td>
						<td><?php echo esc_html($order->get_billing_phone()); ?></td>
					</tr>
				</table>
			</div>
		</section>
		<section class="products-area">
			<table class="products-table">
				<thead> 
					<tr>
						<th width="35%">Product</th>
						<th width="10%">Quantity</th>
						<th width="35%">Locator</th>
						<th width="10%">Price</th>
						<th width="10%">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php

					// making all items an array
					// This is to ensure that we can sort them by aisle and bay later
					$items = array();
					foreach ($order->get_items() as $item_id => $item) {
						$product = $item->get_product();
						$aisle = get_post_meta($item->get_product_id(), '_aisle', true);
						$bay = get_post_meta($item->get_product_id(), '_bay', true);

						$items[] = array(
							'item_id' => $item_id,
							'item' => $item,
							'product' => $product,
							'aisle' => $aisle,
							'bay' => $bay,
						);
					}

					// Now sorting the items by aisle and bay
					usort($items, function ($a, $b) {
						$aisleA = strtolower($a['aisle']);
						$aisleB = strtolower($b['aisle']);
						if ($aisleA === $aisleB) {
							return intval($a['bay']) <=> intval($b['bay']);
						}
						return $aisleA <=> $aisleB;
					});
					foreach ($items as $data):
						$item = $data['item'];
						$product = $data['product']; ?>
						<tr>
							<td><?php echo esc_html($item->get_name()); ?></td>
							<td><?php echo esc_html($item->get_quantity()); ?></td>
							<td>
								<div class="details">
									<li class="light-text">SKU:<strong><?php echo esc_html($product->get_sku()); ?></strong>
									</li>
									<li class="light-text">Aisle:<strong><?php echo esc_html($data['aisle']); ?></strong>
									</li>
									<li class="light-text">Bay:<strong><?php echo esc_html($data['bay']); ?></strong>
									</li>
								</div>
							</td>
							<td><?php echo wc_price($item->get_total() / $item->get_quantity()); ?></td>
							<td><?php echo wc_price($item->get_total()); ?></td>
						</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
			<div class="spacer"></div>
		</section>
		<section class="total-area">
			<table>
				<thead>
					<tr>
						<th width="90%">Subtotal:</th>
						<th width="10%"><?php echo wc_price($order->get_subtotal()); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Shipping:</td>
						<td><?php echo wc_price($order->get_shipping_total()); ?></td>
					</tr>
					<tr>
						<td>Vat:</td>
						<td><?php echo wc_price($order->get_total_tax()); ?></td>
					</tr>
					<tr>
						<th>Total:</th>
						<td><?php echo wc_price($order->get_total()); ?></td>
					</tr>
				</tbody>
			</table>
			<div class="spacer"></div>
		</section>

		<section class="footer-area">
			<div class="footer">Copyright © 2023 Select Drams – registered in Scotland. Company registration SC415772
			</div>
		</section>
	</div>
</body>