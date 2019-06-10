<div class="container-fluid">
	<div class="row">
		<!-- Area Chart -->
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Supplier Dashboard</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<!--<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>-->
					</div>
				</div>
				<!-- Card Body -->
				<div class="card-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Supplier Details</td>
                                                    <td>
                                                        
                                                            <?php $supplier = $this->suppliers_model->get_by_id($supplier_id); ?>
                                                            <?php
                                                            echo $supplier->name . '<br/>';
                                                            echo $supplier->address . '<br/>';
                                                            echo $supplier->mobile . '<br/>';
                                                            ?>

                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                Purchase Order No : <?=$purchase_order_supplier_id?>
                                                    </td>
                                                    <td>
                                                    Purchase Order  Date: <?php echo date("d-m-Y", strtotime($created_at)); ?>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Client Details</td>
                                                    <td>
                                                        
                                                            <?php $customer_details = $this->customers_model->get_by_id($customer_id); 
                                                            $client_po_details=$this->purchase_order_model->get_by_id($purchase_order_from_customer_id);?>
                                                            <?php
                                                            echo $customer_details->name . '<br/>';
                                                            echo $customer_details->contact . '<br/>';
                                                            echo $customer_details->address . '<br/>';
                                                            ?>

                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">
                                                Purchase Order No: <?=$purchase_order_from_customer_id?>
                                                    </td>
                                                    <td>
                                                    Purchase Order  Date: <?php echo date("d-m-Y", strtotime($client_po_details->created_at)); ?>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php if ($invoice_status != NULL) {
                                            $invoice_details = $this->invoice_model->get_by_id($invoice_id);
                                            ?>
                                            
                                            MANUFACTURER/SOURCING POINT DETAILS
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="30%">Company Name :</td>
                                                        <td> <?= $invoice_details->company_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Invoice No: </td>
                                                        <td><?= $invoice_details->invoice_no; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Invoice Date :</td>
                                                        <td> <?= date("d-m-Y", strtotime($invoice_details->invoice_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lorry No : </td>
                                                        <td><?= $invoice_details->lorry_no; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date : </td>
                                                        <td><?= date("d-m-Y", strtotime($invoice_details->lorry_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Invoice Document :</td>
                                                        <td> <a href="<?= $invoice_details->invoice_doc ?>" target="_blank" class="btn btn-sm btn-primary">Download</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        <?php } else {
                                        echo '<span class="text-danger">Invoice is not generated.</span>';
                                    } ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <?php
                                    $product_details=array(
                                        "productid"=>$products,
                                        "others"=>$others,
                                        "quantity"=>$quantity,
                                        "product_unit"=>$product_unit,
                                        "tax_rate"=>$tax_rate,
                                        "attributes"=>$attributes,
                                        "product_price"=>$product_price,
                                        "cgst"=>$cgst,
                                        "sgst"=>$sgst,
                                        "igst"=>$igst,
                                        "exyard"=>$exyard,
                                        "frieght"=>$frieght,
                                        "total"=>$total,
                                    );    
                                    $this->load->view("admin/products/product_table_format",array("product"=>(object)$product_details)); ?>
                                
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="<?=base_url("admin/warehouse/dashboard");?>" class="btn btn-primary">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>