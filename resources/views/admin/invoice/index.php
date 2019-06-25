<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3">
  <h1 class="h2"><?php echo $title; ?></h1>
  <div class="btn-toolbar mb-2 mb-md-0 dropdown pull-right">
    <div class="btn-group mr-2">
      <form action="<?php echo site_url('dashboard/invoice/index/' . $type ); ?>">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control" value="<?php echo ( isset( $_GET['q'] ) ) ? $_GET['q'] : ''; ?>" name="q" placeholder="Search Invoice....">
        <div class="input-group-btn">
          <button class="btn btn-sm btn-secondary"><i class="fa fa-search"></i></button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<ul class="nav nav-tabs menuTab" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link <?php echo ( $type =='sale' ) ? 'active' : ''; ?>" href="<?php echo site_url('dashboard/invoice/'); ?>" role="tab">Sales</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ( $type =='purchase' ) ? 'active' : ''; ?>" href="<?php echo site_url('dashboard/invoice/index/purchase'); ?>" role="tab">Purchases</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="table-responsive">   
      <table class="table table-striped table-bordered table-sm">
        <thead>
          <tr>
            <th>Invoice ID</th>
            <th>Type</th>
            <th>Shop/Trade Name</th>
            <th>Payment</th>
            <th>Total</th>
            <th>Issued</th>
            <th>Due Date</th>
            <th>By</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if( !empty( $orders ) && is_array( $orders ) ) :
            foreach( $orders as $order ) :
          ?>
          <tr>
            <td>
              <a href="<?php echo site_url('dashboard/invoice/view/' . $order->id ); ?>">
                <?php echo getOption('order_prefix', 'INV') . str_pad($order->id, 8, '0', STR_PAD_LEFT); ?>
              </a>
            </td>
            <td><?php echo ucfirst( $order->type ); ?></td>
            <td><?php echo ucwords( $order->tradeName ); ?></td>
            <td>
              <?php
                $dueAmount = $order->total - ( $order->paid + $order->discount );
                if( $dueAmount < $order->total && $dueAmount > 0 )
                  echo '<span class="alert-info">Pertial</span>';
                if( $dueAmount == 0 )
                  echo '<span class="alert-success">Paid</span>';
                if( $order->paid == 0 )
                  echo '<span class="alert-warning">Unpaid</span>';
              ?>
            </td>
            <td><?php echo $order->total; ?></td>
            <td><?php echo date( 'Y-m-d H:i A', $order->issueDate ); ?></td>
            <td><?php echo date( 'Y-m-d', $order->dueDate ); ?></td>
            <td><?php echo ucwords( $order->adminName ); ?></td>
        </tr>
        <?php
          endforeach;
        endif;
        ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation example">
        <?php if( $pagination ) echo $pagination; ?>
      </nav>
    </div>

  </div>
</div>