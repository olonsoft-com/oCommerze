<div id="ember9139" class="ember-view card fly-from-right">
   <?php echo form_open(); ?>
      <div class="row order-header">
        <div class="col-md-8">
         <h3 class="pull-left display-name">
            Edit Invoice <a href="<?php echo site_url('dashboard/invoice/view/' . $order->id ); ?>">#<?php echo getOption('order_prefix', 'INV') . str_pad($order->id, 8, '0', STR_PAD_LEFT);; ?> </a>
         </h3>
       </div>
       <div class="col-md-4 pull-right">
            <div class="btn-group pull-right text-right">
            </div>
            <?php if( $order->status == 0 ) : ?>
            <button class="btn btn-sm btn-info" type="submit">
              Update Invoice
            </button>
            <?php else : ?>
              <div class="alert alert-warning"> Sorry! You cannot edit completed invoice.</div>
          <?php endif; ?>
        </div>
         <div class="clearfix"></div>
      </div>
      <hr class="mhl">
      <section class="row dl-horizontal small phl truncate">
         <dl class="col-md-4 mln">
            <dt>Bill To</dt>
            <dd>
               <span class="underlined ember-view hoverable"><?php echo ucwords( $order->retailerName ); ?></span>
            </dd>
            <dt>Ship To</dt>
            <dd>
              <span class="underlined ember-view hoverable">
                <?php echo ucwords( $order->tradeName ); ?><br />
                <?php echo ucwords( $order->address ); ?>
              </span>  
            </dd>
            <dt>Phone</dt>
            <dd>
               <span class="underlined ember-view hoverable"><?php echo $order->phone; ?></span>  
            </dd>
         </dl>
         <dl class="col-md-4 mln">
            <dt>Issued </dt>
            <dd><?php echo date( 'd M, Y H:i A', $order->issueDate ); ?></dd>
            <dt>Payment Due</dt>
            <dd><?php echo date( 'd M, Y', $order->dueDate ); ?></dd>
         </dl>
         <dl class="col-md-4 mln">
            <dt>Total Bill</dt>
            <dd><?php echo number_format( $order->total, 2 ); ?> TK.</dd>
            <dt>Total Paid</dt>
            <dd><?php echo number_format( $order->paid, 2 ); ?> TK.</dd>
            <dt>Total Discount</dt>
            <dd><?php echo number_format( $order->discount, 2 ); ?> TK.</dd>     
          </dl>
         <div class="clearfix"></div>
      </section>
      <section class="tableish form-table mtn">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="col-md-1"><i class="fa fa-image"></i></th>
                <th class="col-md-7">Products</th>
                <th class="col-md-1">Unit</th>
                <th class="col-md-1">Price</th>
                <th class="col-md-1">Qty</th>
                <th class="col-md-1">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if( !empty( $products ) && is_array( $products ) ) :
                foreach( $products as $product ) :
                  $thumbnail = ( !empty( $product->attachment ) ) ? get_uploaddirectory_uri('products/' . $product->attachment[0] ) : get_uploaddirectory_uri('default/placeholder.png');
              ?>
              <tr>
                <td><img src="<?php echo $thumbnail; ?>" style="width:40px;"></td>
                <td>
                  <input type="hidden" name="order[<?php echo $product->id; ?>][productId]" value="<?php echo $product->productId; ?>">
                  <?php echo ucwords( $product->productName ); ?>
                </td>
                <td><?php echo ucfirst( $product->unit ); ?></td>
                <td>
                  <input type="text" class="form-control" name="order[<?php echo $product->id; ?>][price]" value="<?php echo $product->price; ?>" id="itemPrice">
                </td>
                <td>
                    <input type="number" value="<?php echo $product->qty; ?>" name="order[<?php echo $product->id; ?>][qty]" class="form-control" id="itemQty">
                </td>
                <td><span class="updateSubTotal"><?php echo $product->total; ?></span></td>
              </tr>
              <?php
                endforeach;
              endif;
              ?>
              <tr>
                <td colspan="3" style="border:0;">
                  <div>
                    <?php echo form_label('Remarks for Retailers', 'remarks'); ?>
                    <textarea name="remarks" id="remarks" rows="5" class="form-control"><?php echo $order->remarks; ?></textarea>
                  </div>
                </td>
                <td colspan="3" class="pull-right" style="border:0;padding:0;">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
   </form>
</div>
<script type="text/javascript">
  jQuery( function( $ ) {
    $(":input").bind('keyup change', function () {
      var parent = $(this).parents('tr');
      var qty = $(parent).find('#itemQty').val();
      var price = $(parent).find('#itemPrice').val();
      var subtotal = (qty * price).toFixed(2);
      $(parent).find('.updateSubTotal').text(subtotal);
      // $(parent).find('.input-group-append').show();
    });

    $('.updateCartItem').click( function(e) {
      var parent = $(this).parents('tr');
      var input = $(parent).find('#productUpdateQty');
      var qty = $(input).val();
      var id = $(input).attr('data-rowid');
      var price = $(input).attr('data-price');
      $.ajax({
        type: "post",
        dataType: "json",
        url: "../cart/uptodate",
        data: { id: id, qty: qty, price: price, type: 'sale' },
        success: function( data ) {
          if( data.status == 'success' && data.code == 200 ) {
            $(parent).find('.input-group-append').hide();
          }
        }
      });
    });

  });
</script>