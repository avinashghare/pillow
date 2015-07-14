<section class="panel">
<header class="panel-heading">
<h3 class="panel-title">order Details </h3>
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editordersubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user',$before->user),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Firstname</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="firstname" value='<?php echo set_value('firstname',$before->firstname);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Lastname</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="Lastname" value='<?php echo set_value('Lastname',$before->Lastname);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Email</label>
<div class="col-sm-4">
<input type="email" id="normal-field" class="form-control" name="email" value='<?php echo set_value('email',$before->email);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Billing Address</label>
<div class="col-sm-8">
<textarea name="billingaddress" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'billingaddress',$before->billingaddress);?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Billing City</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="billingcity" value='<?php echo set_value('billingcity',$before->billingcity);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Billing State</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="billingstate" value='<?php echo set_value('billingstate',$before->billingstate);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Billing Country</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="billingcountry" value='<?php echo set_value('billingcountry',$before->billingcountry);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping Address</label>
<div class="col-sm-8">
<textarea name="shippingaddress" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'shippingaddress',$before->shippingaddress);?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping City</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="shippingcity" value='<?php echo set_value('shippingcity',$before->shippingcity);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping Country</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="shippingcountry" value='<?php echo set_value('shippingcountry',$before->shippingcountry);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping State</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="shippingstate" value='<?php echo set_value('shippingstate',$before->shippingstate);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping Pincode</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="shippingpincode" value='<?php echo set_value('shippingpincode',$before->shippingpincode);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Default Currency</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="defaultcurrency" value='<?php echo set_value('defaultcurrency',$before->defaultcurrency);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Total Amount</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="totalamount" value='<?php echo set_value('totalamount',$before->totalamount);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Discount Amount</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="discountamount" value='<?php echo set_value('discountamount',$before->discountamount);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Final Amount</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="finalamount" value='<?php echo set_value('finalamount',$before->finalamount);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Discount Coupon</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="discountcoupon" value='<?php echo set_value('discountcoupon',$before->discountcoupon);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Payment Method</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="paymentmethod" value='<?php echo set_value('paymentmethod',$before->paymentmethod);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Order Status</label>
<div class="col-sm-4">
<?php echo form_dropdown("orderstatus",$orderstatus,set_value('orderstatus',$before->orderstatus),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Currency</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="currancy" value='<?php echo set_value('currancy',$before->currancy);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Tracking Code</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="trackingcode" value='<?php echo set_value('trackingcode',$before->trackingcode);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Billing Code</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="billingpincode" value='<?php echo set_value('billingpincode',$before->billingpincode);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping Method</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="shippingmethod" value='<?php echo set_value('shippingmethod',$before->shippingmethod);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping Name</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="shippingname" value='<?php echo set_value('shippingname',$before->shippingname);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Shipping Tel</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="shippingtel" value='<?php echo set_value('shippingtel',$before->shippingtel);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Is Cushion</label>
<div class="col-sm-4">
<?php echo form_dropdown("iscushion",$iscushion,set_value('iscushion',$before->iscushion),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/vieworder"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
