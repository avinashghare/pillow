<section class="panel">
    <div class="panel-body">
        <ul class="nav nav-stacked">
            <li><a href="<?php echo site_url('site/vieworderproduct?id=').$before->order; ?>">Order Products</a>
            </li>
            <li><a href="<?php echo site_url('site/editorderproduct?id=').$before->order.'&orderproductid='.$before->id; ?>">Order Product Details</a>
            </li>
            <li><a href="<?php echo site_url('site/vieworderproductimage?id=').$before->order.'&orderproductid='.$before->id; ?>">Order Product Images</a>
            </li>
<!--
            <li><a href="<?php echo site_url('site/viewuserinterestevents?id=').$before->id; ?>">User Interest Events</a>
            </li>
-->
        </ul>
    </div>
</section>