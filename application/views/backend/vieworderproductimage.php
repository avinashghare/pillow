<div id="page-title">
    <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url("site/createorderproductimage?id=".$order."&orderproductid=".$orderproductid); ?>">Create</a>
    <h1 class="page-header text-overflow">orderproductimage Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">
                <?php $this->chintantable->createsearch("orderproductimage List");?>
                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
<!--                                    <th data-field="productimage">Product Image</th>-->
                                    <th data-field="image">Image</th>
                                    <th data-field="order">Order</th>
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
            
            var image="<a href='<?php echo base_url('uploads').'/'; ?>"+resultrow.image+"' target='_blank'><img src='<?php echo base_url('uploads').'/'; ?>"+resultrow.image+"' width='80px' height='80px'></a>";
//            var orderid="";
            return "<tr><td>" + resultrow.id + "</td><td>" + image + "</td><td>" + resultrow.order + "</td><td><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deleteorderproductimage?orderproductimageid='); ?>" + resultrow.id + "&orderproductid="+resultrow.orderproduct+"&id=<?php echo $order;?>'><i class='icon-trash '></i></a></td></tr>";
//            return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.orderproduct + "</td><td>" + resultrow.image + "</td><td>" + resultrow.order + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editorderproductimage?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deleteorderproductimage?orderproductimageid='); ?>" + resultrow.id + "&orderproductid="+resultrow.orderproduct+"&id=<?php echo $order;?>'><i class='icon-trash '></i></a></td></tr>";
        }
        generatejquery("<?php echo $base_url;?>");
    </script>
</div>
