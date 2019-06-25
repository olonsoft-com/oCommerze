<style>
.inv-title {
    font-weight: bold;
    font-size: 16px;
    margin-bottom:3px;
}
.inv-desc {
    font-size: 16px;
    margin-bottom:3px;
}

</style>

<?php 
   function numberTowords($num)
{

$ones = array(
0 =>"ZERO",
1 => "ONE",
2 => "TWO",
3 => "THREE",
4 => "FOUR",
5 => "FIVE",
6 => "SIX",
7 => "SEVEN",
8 => "EIGHT",
9 => "NINE",
10 => "TEN",
11 => "ELEVEN",
12 => "TWELVE",
13 => "THIRTEEN",
14 => "FOURTEEN",
15 => "FIFTEEN",
16 => "SIXTEEN",
17 => "SEVENTEEN",
18 => "EIGHTEEN",
19 => "NINETEEN",
"014" => "FOURTEEN"
);
$tens = array(
0 => "ZERO",
1 => "TEN",
2 => "TWENTY",
3 => "THIRTY",
4 => "FORTY",
5 => "FIFTY",
6 => "SIXTY",
7 => "SEVENTY",
8 => "EIGHTY",
9 => "NINETY"
);
$hundreds = array(
"HUNDRED",
"THOUSAND",
"MILLION",
"BILLION",
"TRILLION",
"QUARDRILLION"
); /*limit t quadrillion */
$num = number_format($num,2,".",",");
$num_arr = explode(".",$num);
$wholenum = $num_arr[0];
$decnum = $num_arr[1];
$whole_arr = array_reverse(explode(",",$wholenum));
krsort($whole_arr,1);
$rettxt = "";
foreach($whole_arr as $key => $i){

while(substr($i,0,1)=="0")
		$i=substr($i,1,5);
if($i < 20){
/* echo "getting:".$i; */
  if(isset($ones[$i])){
    $rettxt .= $ones[$i];
  }
}elseif($i < 100){
if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)];
if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)];
}else{
if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)];
if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)];
}
if($key > 0){
$rettxt .= " ".$hundreds[$key]." ";
}
}
if($decnum > 0){
$rettxt .= " and ";
if($decnum < 20){
$rettxt .= $ones[$decnum];
}elseif($decnum < 100){
$rettxt .= $tens[substr($decnum,0,1)];
$rettxt .= " ".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}
?>



<div id="ember9139" class="ember-view card fly-from-right">
   <form>
      <div class="row order-header">
        <div class="col-md-8">
         <h3 class="pull-left display-name">
            Invoice #<?php echo getOption('order_prefix', 'INV') . str_pad($order->id, 8, '0', STR_PAD_LEFT); ?>
            <?php if( $order->status == 0 ) : ?>
            <span>
              <a href="<?php echo site_url('dashboard/invoice/edit/' . $order->id ); ?>"><i class="fa fa-edit"></i></a>
            </span>
          <?php endif; ?>
         </h3>
       </div>
       <div class="col-md-4 pull-right text-right">
            <div class="btn-group pull-right text-right">
              <!-- <a href="product/edit" class="btn btn-sm btn-outline-secondary"><i data-feather="edit"></i> Email</a> -->
              <a href="<?php echo site_url('dashboard/invoice/print/' . $order->id ); ?>" class="btn btn-sm btn-outline-secondary" target="ext"><i class="fa fa-print"></i> Print Invoice</a>
              <?php
              $dueAmount = floatval( $order->total - ( $order->paid + $order->discount ) );
              if( $dueAmount > 0 && $order->type != 'purchase' ) :
              ?>
                <a href="<?php echo site_url('dashboard/order/payment/' . $order->id ); ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-money-bill-alt"></i> Pay</a>
              <?php endif; ?>
            </div>
        </div>
         <div class="clearfix"></div>
      </div>
      <!--<hr class="mhl">-->
      
        <div class="col-md-12">
              <h4 class="text-center" style="background: #f0f0f0;padding: 3px 0px;">Invoice/ Bill</h4>
        </div>
        <div style="width:100%;height:10px;"></div>  
        <div class="clearfix"></div>    
        <div class="col-md-12">
              <div class="row">
                 <div class="col-md-8">
                      <div class="row">
              				 <div class="col-md-2 text-left" style="padding-right:0px;">
                               <p class="inv-title">Invoice No.</p> 
                             </div>
                             <div class="col-md-10 text-left" style="padding-left:0px;">
								<p class="inv-desc"><?php echo getOption('order_prefix', 'INV') . str_pad($order->id, 8, '0', STR_PAD_LEFT); ?></p>
                             </div>
                               
                             <div class="col-md-2 text-left" style="padding-right:0px;">
                               <p class="inv-title">Bill To</p> 
                             </div>
                             <div class="col-md-10 text-left" style="padding-left:0px;">
								<p class="inv-desc"><?php echo ucwords( $order->retailerName ); ?></p>
                             </div>
              
              				<div class="col-md-2 text-left" style="padding-right:0px;">
                               <p class="inv-title">Ship To</p> 
                             </div>
                             <div class="col-md-10 text-left" style="padding-left:0px;">
								<p class="inv-desc">
              						<?php echo ucwords( $order->tradeName ); ?><br />
                					<?php echo ucwords( $order->address ); ?>
                                </p>
                             </div>
                               
                      </div>
                  </div>
                 <div class="col-md-4">
                       <div class="row">
                		    <div class="col-md-3 text-left" style="padding-right:0px;">
                               <p class="inv-title">Issued</p> 
                             </div>
                             <div class="col-md-9 text-left" style="padding-left:0px;">
								<p class="inv-desc"><?php echo date( 'd M, Y H:i A', $order->issueDate ); ?></p>
                             </div>
              
              				<div class="col-md-3 text-left"  style="padding-right:0px;">
                               <p class="inv-title">Due Date</p> 
                             </div>
                             <div class="col-md-9 text-left" style="padding-left:0px;">
								<p class="inv-desc"><?php echo date( 'd M, Y', $order->dueDate ); ?></p>
                             </div>
                       </div>
                 </div>
              </div>
        </div>
        <div class="clearfix"></div>         
              
              
      <section class="row dl-horizontal small phl truncate">
        <?php /*  <dl class="col-md-4 mln">
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
         <dl class="col-md-4">
            <!-- <dt>Terms</dt>
            <dd>NET30</dd> -->
            <dt>Issued</dt>
            <dd><?php echo date( 'd M, Y H:i A', $order->issueDate ); ?></dd>
            <dt>Payment Due</dt>
            <dd><?php echo date( 'd M, Y', $order->dueDate ); ?></dd>
         </dl>*/ ?>
         <dl class="col-md-4 mln">
          <?php /* if( $order->type != 'purchase' ) : ?>
            <dt>Total Bill</dt>
            <dd><?php echo number_format( $order->total, 2 ); ?> TK.</dd>
            <dt>Total Paid</dt>
            <dd><?php echo number_format( $order->paid, 2 ); ?> TK.</dd>
            <dt>Total Discount</dt>
            <dd><?php echo number_format( $order->discount, 2 ); ?> TK.</dd>
            <dt>Total Dues</dt>
            <dd><?php echo number_format( $dueAmount, 2 ); ?> TK.</dd>
          <?php endif; */ ?>
          </dl>
         <div class="clearfix"></div>
      </section>
      <section class="tableish form-table mtn">
       <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-bordered table-sm">
            <thead>
              <tr>
                <th width="20">Sl. No.</th>
                <th width="20"><i class="fa fa-image"></i></th>
                <th width="20">Products</th>
                <th width="20" class="text-center">Unit</th>
                <th width="20" class="text-center">Price</th>
                <th width="20" class="text-center">Qty</th>
                <th width="20" class="text-center">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter = 1;
              if( !empty( $products ) && is_array( $products ) ) :
                foreach( $products as $product ) :
                  $thumbnail = ( !empty( $product->attachment ) ) ? get_uploaddirectory_uri('products/' . $product->attachment[0] ) : get_uploaddirectory_uri('default/placeholder.png');
              ?>
              <tr>
                <td><?php echo $counter; ?></td>
                <td><img src="<?php echo $thumbnail; ?>" style="width:40px;"></td>
                <td><?php echo ucwords( $product->productName ); ?></td>
                <td class="text-center"><?php echo ucfirst( $product->unit ); ?></td>
                <td class="text-center"><?php echo $product->price; ?></td>
                <td class="text-center"><?php echo $product->qty; ?></td>
                <td class="text-right"><?php echo $product->total; ?></td>
              </tr>
              <?php
                  $totalAmount[] = $product->total.", ";
                  $counter ++;
                endforeach;
              ?>
               
              <tr>
                <td colspan="6" class="text-right" style="border: none;"><p class="inv-title">Total Amount</p></td>
                <td  style="border: none;"  class="text-right">
                  <?php 
                     $invtotal = array_sum( $totalAmount );
                     echo number_format( $invtotal, 2 ); 
                   ?>
                  </td>
              </tr>
              
              

              <?php
                $total = array_sum( $totalAmount ) + $previousDue;
              endif;
              ?>
              <?php /*<tr>
                <td colspan="4" style="border:0;">
                  <p>Note: <?php echo $order->remarks; ?></p>
                </td>
                <td colspan="3" class="pull-right" style="border:0;padding:0;">
                  <table class="table">
                    <tr>
                      <th class="text-right">Total</th>
                      <td class="col-md-4"><?php echo $total; ?></td>
                    </tr>
                    <tr>
                      <th class="text-right">Paid</th>
                      <td><?php echo number_format( $order->paid, 2 ); ?></td>
                    </tr>
                    <tr>
                      <th class="text-right">Dues</th>
                      <td><?php echo number_format( $dueAmount, 2 ); ?></td>
                    </tr>
                  </table>
                </td>
              </tr> */?>
            </tbody>
          </table>
            
               
           
        </div>
       </div>
      </section>
       <div style="width:100%;height:30px;"></div>      
       <div class="row">
              <div class="col-md-4" style="padding-left: 30px;">
                   <table class="table table-borderless table-sm" style="border: 1px solid #dee2e6;">
                    <tr>
                      <th class="text-left" style="width:40%;">Previous Dues</th>
                      <td class="text-right" style="border-left: none;"><?php echo number_format( $previousDue, 2 ); ?></td>
                    </tr>
                    <tr>
                      <th class="text-left">Sales Amount</th>
                      <td class="text-right"><?php echo number_format( $invtotal, 2 ); ?></td>
                    </tr>
                     <tr>
                      <th class="text-left">Paid</th>
                      <td class="text-right"><?php echo number_format( $order->paid, 2 ); ?></td>
                    </tr>
                     <tr>
                      <th class="text-left">Paid</th>
                      <td class="text-right"><?php echo number_format( $order->discount, 2 ); ?></td>
                    </tr>
                    <tr>
                      <th class="text-left" style="border-top: 1px solid #dee2e6;">Net Outstanding</th>
                      <td class="text-right"  style="border-top: 1px solid #dee2e6;">
                        <?php
                          $outstanding = $total - ( $order->paid + $order->discount );
                          echo number_format( $outstanding, 2 ); ?></td>
                    </tr>
                  </table>
               </div>
               <div class="col-md-4">&nbsp;</div>
              <div class="col-md-4" style="padding-right: 30px;">
                <p><span class="inv-title">Note:</span> <?php echo $order->remarks; ?></p>
              </div> 
               <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
                   <?php if( $outstanding > 0) {?>
                   <p class="inv-title">IN WORD: <?php echo numberTowords($outstanding); ?> TAKA</p>
                   <?php } ?>
                </div> 
                
                <div style="width:100%;height:50px;"></div>
       </div>          
                
       <div class="row">
               <div class="col-md-6"  style="padding-left: 30px;">
                  <p class="inv-title">
                    ----------------------- <br>
                    Receivers Signature
                  </p>
               </div>  
                <div class="col-md-6"  style="padding-right: 30px;">
                  <p class="inv-title text-right">
                    ------------------------<br>
                    Authorized Signature
                  </p>
               </div>  
                    
       </div>
              
      <div class="invoice-footer text-center" style="margin-top: 25px;">
        <p>Invoice Generated by : <em><?php echo ucwords( $order->adminName ); ?></em></p>
      </div>
   </form>
</div>
