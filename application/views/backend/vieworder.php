<div id="page-title">
    <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createorder"); ?>">Create</a>
    <h1 class="page-header text-overflow">order Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">
                <?php $this->chintantable->createsearch("order List");?>
                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="user">User</th>
                                    <th data-field="firstname">Firstname</th>
                                    <th data-field="Lastname">Lastname</th>
                                    <th data-field="email">Email</th>
                                    <th data-field="billingaddress">Billing Address</th>
<!--
                                    <th data-field="billingcity">Billing City</th>
                                    <th data-field="billingstate">Billing State</th>
                                    <th data-field="billingcountry">Billing Country</th>
                                    <th data-field="shippingaddress">Shipping Address</th>
                                    <th data-field="shippingcity">Shipping City</th>
                                    <th data-field="shippingcountry">Shipping Country</th>
                                    <th data-field="shippingstate">Shipping State</th>
                                    <th data-field="shippingpincode">Shipping Pincode</th>
                                    <th data-field="defaultcurrency">Default Currency</th>
                                    <th data-field="totalamount">Total Amount</th>
                                    <th data-field="discountamount">Discount Amount</th>
                                    <th data-field="finalamount">Final Amount</th>
                                    <th data-field="discountcoupon">Discount Coupon</th>
                                    <th data-field="paymentmethod">Payment Method</th>
                                    <th data-field="orderstatus">Order Status</th>
                                    <th data-field="currancy">Currency</th>
                                    <th data-field="trackingcode">Tracking Code</th>
                                    <th data-field="billingpincode">Billing Code</th>
                                    <th data-field="shippingmethod">Shipping Method</th>
                                    <th data-field="shippingname">Shipping Name</th>
                                    <th data-field="shippingtel">Shipping Tel</th>
                                    <th data-field="iscushion">Is Cushion</th>
-->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left pagination-detail">
                            <?php $this->chintantable->createpagination();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function drawtable(resultrow) {
            
            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.user + "</td><td>" + resultrow.firstname + "</td><td>" + resultrow.Lastname + "</td><td>" + resultrow.email + "</td><td>" + resultrow.billingaddress + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editorder?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deleteorder?id='); ?>" + resultrow.id + "'><i class='icon-trash '></i></a></td></tr>";
            
//            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.user + "</td><td>" + resultrow.firstname + "</td><td>" + resultrow.Lastname + "</td><td>" + resultrow.email + "</td><td>" + resultrow.billingaddress + "</td><td>" + resultrow.billingcity + "</td><td>" + resultrow.billingstate + "</td><td>" + resultrow.billingcountry + "</td><td>" + resultrow.shippingaddress + "</td><td>" + resultrow.shippingcity + "</td><td>" + resultrow.shippingcountry + "</td><td>" + resultrow.shippingstate + "</td><td>" + resultrow.shippingpincode + "</td><td>" + resultrow.defaultcurrency + "</td><td>" + resultrow.totalamount + "</td><td>" + resultrow.discountamount + "</td><td>" + resultrow.finalamount + "</td><td>" + resultrow.discountcoupon + "</td><td>" + resultrow.paymentmethod + "</td><td>" + resultrow.orderstatus + "</td><td>" + resultrow.currancy + "</td><td>" + resultrow.trackingcode + "</td><td>" + resultrow.billingpincode + "</td><td>" + resultrow.shippingmethod + "</td><td>" + resultrow.shippingname + "</td><td>" + resultrow.shippingtel + "</td><td>" + resultrow.iscushion + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editorder?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deleteorder?id='); ?>" + resultrow.id + "'><i class='icon-trash '></i></a></td></tr>";
            
        }
        generatejquery("<?php echo $base_url;?>");
    </script>
</div>
</div>
