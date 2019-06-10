<?php
$grand_total = 0;
if ($cart = $this->cart->contents()) {
	foreach ($cart as $item) {
		$grand_total = $grand_total + $item['subtotal'];
	}
}
?>
<section class="services">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight:800;">Enquiry Cart</div>
					<div class="panel-body">
						<span id="info_message"></span>
						<div id="cart">
							<div id="text">
								<?php $cart_check = $this->cart->contents();
								if (empty($cart_check)) {
									echo 'To add products to your enquiry list click on "Add to Cart" Button';
								}  ?>
							</div>

							<table class="table table-bordered table-striped">
								<?php
								if ($cart = $this->cart->contents()) { ?>
									<thead class="bg-dark">
										<tr id="main_heading">
											<td>Sl No.</td>
											<td>Product Name</td>
											<td>Quantity</td>
											<td>Specification</td>
											<td>Others</td>
											<td align="center">Action</td>
										</tr>
									</thead>
									<tbody>
										<?php
										$grand_total = 0;
										$i = 1;
										foreach ($cart as $item) {
											//echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
											//echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
											//echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
											//echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
											?>
											<tr>
												<td>
													<?php echo $i++; ?>
												</td>
												<td>
													<?php echo $item['name']; ?>
												</td>
												<td>
													<form class="form-inline" action="#!">
														<div class="form-group">
															<span id="cart_msg"></span>
															<div class="input-group col-md-2">
																<input type="text" class="qty" name="quantity" value="<?php echo intval($item['qty']); ?>" />
																<div class="input-group-addon"><?php echo $item['product_unit']; ?></div>
															</div>
														</div>
														<a href="#!" rowid="<?= $item['rowid'] ?>" class="btn btn-warning update_qty" title="Update Quantity">
														<i class="fa fa-refresh" aria-hidden="true"></i>
													</a>
													</form>

												</td>
												<td>
													<?php $attr_names = $item["attributes"];
													foreach ($item["attr_names"] as $key => $values) {
														echo $attr_names[$key] . ' : ' . $values . "<br>";
													}
													?>
												</td>
												<td><?php echo $item['others']; ?></td>
												<td><a href="<?= base_url(); ?>shopping/remove/<?= $item['rowid'] ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i></a></td>
											<?php } ?>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<?php
							if ($this->session->userdata("email") != NULL) { ?>
								<form name="billing" class="inline" id="billing_form" method="post" action="<?= base_url(); ?>shopping/save_order">
									<h4 align="right">Where is your Billing Address?</h4><br />
									<div class="form-group pull-right">
										<label class="checkbox-inline">
											<input type="radio" name="state" value="assam" checked> Assam
										</label>
										<label class="checkbox-inline">
											<input type="radio" name="state" value="other"> Other States
										</label>
									</div>
									<div class="clearfix"></div>
									<button type="submit" id="enquery_submit" class='btn btn-info pull-right'>Place Enquiry</button>
								</form>

							<?php } else { ?>
								<!--	<div class="col-md-12">
									<form name="billing" id="billing_form" method="post" action="<?= base_url(); ?>shopping/save_order">
										<div class="panel panel-info">
											<div class="panel-heading" style="font-weight:800;">Customer Info</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<label class="col-md-4 form-group">Your Name:</label>
														<div class="col-md-8 form-group"><input class="form-control" type="text" name="name" required="" /></div>
														<label class="col-md-4 form-group">Phone:</label>
														<div class="col-md-8 form-group"><input class="form-control" type="text" name="contact" required="" maxlength="10" /></div>
														<label class="col-md-4 form-group">Email:</label>
														<div class="col-md-8 form-group"><input class="form-control" type="email" name="email" required="" /></div>
														<label class="col-md-4 form-group">Address:</label>
														<div class="col-md-8 form-group"><textarea class="form-control" type="text" name="address" required=""></textarea></div>
													</div>
												</div>
											</div>
											<div class="panel-footer">
												<div>
													<input type="button" class='btn btn-info' value="Continue Shopping" onclick="window.location = '<?= base_url(); ?>/products'">
													<button type="submit" id="enquery_submit" class='btn btn-info'>Place Enquiry</button>
												</div>
											</div>
										</div>
									</form>
								</div>-->
								<div class="container">
									<div class="row">
										<div class="col-md-12">
											<div class="clearx-fix"></div>
											<div class="alert alert-success alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<strong>Warning!</strong> You have to register before sending enquiry
											</div>
											<div class="clearx-fix"></div>
											If you are already registered Please &nbsp;
											<a href="#!" class="btn btn-danger login_modal" id="login_modal_button">Login</a>
											&nbsp;&nbsp; If not Please
											<a href="#!" class="btn btn-primary register_modal" id="register_modal_button">Register<a>
												<?php } ?>
												<div class="form" </div> </div> </div> <!--<div class="panel-footer">
													<div align="right"><input type="button" class='btn btn-info' value="Continue Shopping" onclick="window.location = '<?= base_url(); ?>/home/steel'">
													</div>
												</div>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function() {
		$("#billing_form").validate({
			rules: {
				state: "required",
			},
			messages: {
				state: "Please Select Billing Address",
			},
			submitHandler: function(form) {
				$('#enquery_submit').empty().append("Processing...");
				form.submit();
			}
		});
		$(".update_qty").click(function() {
			var el=$(this);
			el.empty().append("processing...");
			var qty = el.parent().children().find(".qty").val();
			var rowid = $(this).attr("rowid");
			$.ajax({
				url: "<?= base_url("shopping/edit"); ?>",
				method: "post",
				data: {
					qty: qty,
					rowid: rowid
				},
				dataType: "json",
				success: function(jsn) {
					if (jsn) {
						$('#info_message').empty().append('<div class="alert alert-success alert-dismissible" role="alert">\
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
						<strong>Success! Quantity updated.</strong></div>');
					} else {
						$('#info_message').empty().append('<div class="alert alert-success alert-dismissible" role="alert">\
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
						<strong>Warning! Something went wrong.</strong></div>');
					}
					el.empty().append('<i class="fa fa-refresh" aria-hidden="true"></i>');
				}
			});
		});
	});
</script>