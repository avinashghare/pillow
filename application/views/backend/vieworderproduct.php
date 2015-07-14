<div id="page-title">
    <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createorderproduct?id=".$order); ?>">Create</a>
    <h1 class="page-header text-overflow">orderproduct Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">
                <?php $this->chintantable->createsearch("orderproduct List");?>
                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="order">Order</th>
                                    <th data-field="product">Product</th>
                                    <th data-field="quantity">Quantity</th>
                                    <th data-field="price">Price</th>
                                    <th data-field="discount">Discount</th>
                                    <th data-field="finalprice">Final Price</th>
                                    <th data-field="View Images">View Images</th>
                                    <th data-field="Action">Action</th>
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
            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.order + "</td><td>" + resultrow.product + "</td><td>" + resultrow.quantity + "</td><td>" + resultrow.price + "</td><td>" + resultrow.discount + "</td><td>" + resultrow.finalprice + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/vieworderproductimage2?id=');?>" + resultrow.order + "&orderproductid="+resultrow.id+"'>View All</a></td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editorderproduct?id=');?>" + resultrow.order + "&orderproductid="+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deleteorderproduct?id='); ?>" + resultrow.id + "&orderproductid="+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
        }
        generatejquery("<?php echo $base_url;?>");
    </script>
</div>
