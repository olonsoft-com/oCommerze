<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo get_admindirectory_uri('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo get_admindirectory_uri('assets/css/custom.css'); ?>">
  <style>
  @media print {
    /* borderless table */
.table.table-borderless td, .table.table-borderless th {
    border: 0 ;
    padding:2px;
}
.no-border{border:none;border:0;}
.table.table-borderless {
    margin-bottom: 0px;
}  
  
   .table.table-borderless2 td, .table.table-borderless2 th {
    border: 0 ;
    padding:8px;
}

.table.table-borderless2 {
    margin-bottom: 0px;
}
  
  .card {
    border: 1px solid #000;
   }
  .inv-title {
       font-weight: bold;
       font-size: 16px;
       margin-bottom:3px;
      }
     .inv-desc {
       font-size: 16px;
       margin-bottom:3px;
     }
  .inv-h-p{background: #f0f0f0;padding: 3px 0px;margin: 0;}
           
    
              
           
}/*End Media Query*/
  /* borderless table */
.table.table-borderless td, .table.table-borderless th {
    border: 0 ;
    padding:2px;
}

.table.table-borderless {
    margin-bottom: 0px;
}
  
  .table.table-borderless2 td, .table.table-borderless2 th {
    border: 0;
    padding:8px;
}

.table.table-borderless2 {
    margin-bottom: 0px;
}
  
.inv-h-p{background:#f0f0f0;padding: 3px 0px;margin: 0;} 
 .inv-title {
       font-weight: bold;
       font-size: 16px;
       margin-bottom:3px;
      }
     .inv-desc {
       font-size: 16px;
       margin-bottom:3px;
     }
     .card {
    border: 1px solid #000;
   }
   </style>
  <script type="text/javascript">
 window.onload = function() {
   window.print();
 }
</script>
</head>
<body>


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
  <section class="row dl-horizontal small phl truncate text-center" style="margin-bottom: 0;">
           <h3><?php echo getOption('company_name'); ?></h3>
           <h5><strong><?php echo getOption('company_address'); ?></strong></h5>
           <p><b><?php echo 'Email: ' . getOption('contact_email') . ', Phone: ' . getOption('contact_number'); ?></b></p>
        </section>

        <div class="col-md-12">
              <h4 class="text-center inv-h-p">Invoice/ Bill</h4>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-12">

           <table class="table table-borderless table-sm">
             <tr>
               <td style="width:50%">
                 <table class="table table-borderless table-sm">
                      <tr>
 							<td><p class="inv-title">Invoice No.</p><td>
                            <td><p class="inv-desc"><?php echo getOption('order_prefix', 'INV') . str_pad($order->id, 8, '0', STR_PAD_LEFT); ?></p><td>
                      </tr>
					    <tr>
 							<td><p class="inv-title">Bill To</p><td>
                            <td><p class="inv-desc"><?php echo ucwords( $order->retailerName ); ?></p><td>
                      </tr>
                      <tr>
 							<td><p class="inv-title">Ship To</p><td>
                            <td><p class="inv-desc">
              						<?php echo ucwords( $order->tradeName ); ?><br />
                					<?php echo ucwords( $order->address ); ?>
                                </p><td>
                      </tr>
                 </table>
               </td>
				<td style="width:10%">&nbsp;</td>
               <td style="width:40%" align="right">
					<table  class="table table-borderless table-sm">
 						<tr>
 							<td><p class="inv-title">Issued</p><td>
                            <td<p class="inv-desc"><?php echo date( 'd M, Y H:i A', $order->issueDate ); ?></p><td>
                        </tr>
						<tr>
 							<td><p class="inv-title">Due Date</p><td>
                            <td<p class="inv-desc"><?php echo date( 'd M, Y', $order->dueDate ); ?></p><td>
                        </tr>
 					</table>
               </td>
             </tr>

           </table>

        
              
        </div>
        <div class="clearfix"></div>

      <section class="tableish form-table mtn">
       <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-borderless2 table-sm" style="border: 1px solid #000;margin-bottom:10px;">
            <thead>
              <tr>
                <th width="20"  style="border-bottom: 1px solid #000;">Sl. No.</th>
                <th width="20"  style="border-bottom: 1px solid #000;">Products</th>
                <th width="20" class="text-center"  style="border-bottom: 1px solid #000;">Unit</th>
                <th width="20" class="text-center"  style="border-bottom: 1px solid #000;">Price</th>
                <th width="20" class="text-center"  style="border-bottom: 1px solid #000;">Qty</th>
                <th width="20" class="text-center"  style="border-bottom: 1px solid #000;">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter = 1;
              if( !empty( $products ) && is_array( $products ) ) :
                foreach( $products as $product ) :
              ?>
              <tr>
                <td  style="border-right: 1px solid #000;"><?php echo $counter; ?></td>
                <td  style="border-right: 1px solid #000;"><?php echo ucwords( $product->productName ); ?></td>
                <td  style="border-right: 1px solid #000;" class="text-center"><?php echo ucfirst( $product->unit ); ?></td>
                <td  style="border-right: 1px solid #000;" class="text-center"><?php echo $product->price; ?></td>
                <td  style="border-right: 1px solid #000;" class="text-center"><?php echo $product->qty; ?></td>
                <td  style="border-right: 1px solid #000;" class="text-right"><?php echo $product->total; ?></td>
              </tr>
              <?php
                  $totalAmount[] = $product->total.", ";
                  $counter ++;
                endforeach;
              $total = array_sum( $totalAmount ) + $previousDue;
              $invtotal = array_sum( $totalAmount );
              ?>

              <tr>
                <td colspan="3" class="text-right" style="padding: 0;border-right: 1px solid #000 !important;">
                   <table class="table table-borderless table-sm" style="border: 1px solid #000;border-left:0;border-bottom:0;border-right:0;">
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
                      <th class="text-left">Discount</th>
                      <td class="text-right"><?php echo number_format( $order->discount, 2 ); ?></td>
                    </tr>
                    <tr>
                      <th class="text-left" style="border-top: 1px solid #000;">Net Outstanding</th>
                      <td class="text-right"  style="border-top: 1px solid #000;">
                        <?php 
                        $outstanding = $total - ( $order->paid + $order->discount ); 
                        echo number_format( $outstanding, 2 ); 
                        ?></td>
                    </tr>
                  </table>
              
                </td>
                <td colspan="2" class="text-right" style="border: none;border-top: 1px solid #000;"><p class="inv-title">Total Amount</p></td>
                <td  style="border: none;border-top: 1px solid #000;"  class="text-right">
                  <?php
                     
                     echo number_format( $invtotal, 2 );
                   ?>
                  </td>
              </tr>
             <?php endif; ?>
            </tbody>
          </table>
        </div>
       </div>
      </section>
             
       <div class="row">
              <div class="col-md-12" style="padding-right: 30px;padding-left: 30px;">
                <p><span class="inv-title">Note:</span> <?php echo $order->remarks; ?></p>
              </div>
               <div class="col-md-12" style="padding-left: 30px;padding-right: 30px;">
                   <?php if( $outstanding > 0) {?>
                   <p class="inv-title">IN WORD: <?php echo numberTowords($outstanding); ?> TAKA</p>
                   <?php } ?>
                </div>

                <div style="width:100%;height:30px;"></div>
       </div>

          <table class="table table-borderless table-sm">
                 <tr>  
                    <td align="left">
                       <p class="inv-title" style="padding-left: 15px;">
                          ----------------------- <br>
                       Receivers Signature
                       </p>
                     </td>
                     <td align="right">
                       <p class="inv-title text-right" style="padding-right: 15px;">
                        ------------------------<br>
                       Authorized Signature
                      </p>
                     </td>
                 </tr>
          </table>
                   
       

      <div class="invoice-footer text-center" style="margin-top: 25px;">
        <p>Invoice Generated by : <em><?php echo ucwords( $order->adminName ); ?></em></p>
      </div>
</div>
</body>
</html>