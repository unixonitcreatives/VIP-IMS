<?php
// From Last year to Date
$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " - 1 year"));
 $sql = "SELECT COUNT(ipd.invoice_payment_id) as total_orders, SUM(ipd.grand_total_price) AS revenue,SUM(ipd.total_discount) as total_discount,SUM(ipd.paid_amount) AS paid_amount,SUM(ipd.due_amount) AS receivable FROM invoice_payment_detail as ipd where `ipd`.`payment_detail_date` <='".date("Y-m-d")."' and `ipd`.`payment_detail_date` >= '$newEndingDate'";

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
	// output data of each row
	
	while($row = $result->fetch_assoc()) 
	{ 
		$total_orders=$row['total_orders'];
		$revenue=$row['revenue'];
		$total_discount=$row['total_discount'];
		$paid_amount=$row['paid_amount'];
		$receivable=$row['receivable'];
			
	}
	
@$sale=$total_discount+$paid_amount+$receivable;  //Total Sales data
	
@$receivableper=round((($receivable/$revenue)*100),2);  //Total Receivable data
@$total_discountper=round((($total_discount/$revenue)*100),2); //Total Discount data
@$paid_amountper=round((($paid_amount/$revenue)*100),2);   //Total Paid amount data

// get total customer query
$result2 = $conn->query("SELECT COUNT(`cus_id`) as total_customer from `customers`");
$row2 = $result2->fetch_assoc();
$total_customer=$row2['total_customer'];
// get total suppliers query
$result3 = $conn->query("SELECT COUNT(`supplier_id`) as total_suppliers from `suppliers`");
$row3 = $result3->fetch_assoc();
$total_suppliers=$row3['total_suppliers'];
// get total product query
$result4 = $conn->query("SELECT COUNT(`product_id`) as total_products from `product`");
$row4 = $result4->fetch_assoc();
$total_products=$row4['total_products'];
// get total product categories query
$result5 = $conn->query("SELECT COUNT(`cat_id`) as total_categories from `categories`");
$row5 = $result5->fetch_assoc();
$total_categories=$row5['total_categories'];

}

// get total discount,sold product quantity,sold products types, product rate query
$sql1 = "SELECT SUM(product_quantity * discount) as totaldiscount,SUM(product_quantity * product_rate) as acutle_rate, SUM(`product_quantity`) as total_sold_product_quantity,COUNT(`product_id`)  AS total_sold_products FROM `invoice_line_items` INNER JOIN invoice_payment_detail ON invoice_line_items.order_id=invoice_payment_detail.order_id and `invoice_payment_detail`.`payment_detail_date` <='".date("Y-m-d")."' and `invoice_payment_detail`.`payment_detail_date` >= '$newEndingDate' ";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) 
{
		
	while($row1 = $result1->fetch_assoc()) 
	{ 
		$totaldiscount=$row1['totaldiscount'];
		$acutle_rate=$row1['acutle_rate'];
		$total_sold_product_quantity=$row1['total_sold_product_quantity'];	
		$total_sold_products=$row1['total_sold_products'];	
	}
}

?>