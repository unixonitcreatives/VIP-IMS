<?php //session_start();
//if(empty($_SESSION['auth_username'])) { header("Location: ../index.php");} ?>

<div class="site-sidebar">
				<div class="custom-scroll custom-scroll-dark">
					<ul class="sidebar-menu">
						<li class="menu-title">Main</li>
						<li class="with-sub">
							<a href="index.php" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>								
								<span class="s-icon"><i class="ti-anchor"></i></span>
								<span class="s-text"><?php echo $lang['Dashboard'];?></span>
							</a>							
						</li>
                        <?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='1') { ?>    
                          <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-id-badge"></i></span>
								<span class="s-text"><?php echo $lang['Suppliers'];?></span>
							</a>
                            <ul>								
								<li><a href="add-supplier.php"><?php echo $lang['AddSupplier'];?></a></li>
								<li><a href="suppliers.php"><?php echo $lang['ManageSuppliers'];?></a></li>
							</ul>
						</li>						
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-view-grid"></i></span>
								<span class="s-text"><?php echo $lang['Categories'];?></span>
							</a>
                            <ul>
								<li><a href="add-category.php"><?php echo $lang['AddCategories'];?></a></li>
                                <li><a href="categories.php"><?php echo $lang['ManageCategories'];?></a></li>							
							</ul>
						</li>
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-package"></i></span>
								<span class="s-text"><?php echo $lang['Warehouse'];?></span>
							</a>
                            <ul>
								<li><a href="add-warehouse.php"><?php echo $lang['AddWarehouse'];?></a></li>
                                <li><a href="warehouse.php"><?php echo $lang['ManageWarehouse'];?></a></li>							
							</ul>
						</li>
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text"><?php echo $lang['SuppliersInvoice'];?></span>
							</a>
                            <ul>
								<li><a href="add-supplier-invoice.php"><?php echo $lang['AddInvoice'];?></a></li>
                                <li><a href="suppliers-invoices.php"><?php echo $lang['Products'];?></a></li>	                                						
							</ul>
						</li>
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text"><?php echo $lang['Products'];?></span>
							</a>
                            <ul>
								<li><a href="add-product.php"><?php echo $lang['AddProducts'];?></a></li>
                                <li><a href="products.php"><?php echo $lang['ManageProducts'];?></a></li>	                                						
							</ul>
						</li>
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text"><?php echo $lang['ExpiredProducts'];?></span>
							</a>
                            <ul>								
                                <li><a href="expired-products.php"><?php echo $lang['ExpiredProducts'];?></a></li>                                							
							</ul>
						</li>
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-shopping-cart"></i></span>
								<span class="s-text"><?php echo $lang['DeadStock'];?></span>
							</a>
                            <ul>								
                                <li><a href="dead-stock-products.php"><?php echo $lang['DeadStockProduct'];?></a></li>							
							</ul>
						</li>
                          <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-user"></i></span>
								<span class="s-text"><?php echo $lang['Customers'];?></span>
							</a>
                            <ul>
								<li><a href="add-customer.php"><?php echo $lang['AddCustomer'];?></a></li>
                                <li><a href="customers.php"><?php echo $lang['ManageCustomers'];?></a></li>
                                <li><a href="credit-customers.php"><?php echo $lang['CreditCustomers'];?></a></li>
                                <li><a href="paid-customers.php"><?php echo $lang['PaidCustomers'];?></a></li>								
							</ul>
						</li>
                                                                  
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-receipt"></i></span>
								<span class="s-text"><?php echo $lang['Invoice'];?></span>
							</a>
                            <ul>                                                   
                            
                                <li><a href="add-invoice.php"><?php echo $lang['AddInvoice'];?></a></li>
                                <li><a href="invoices.php"><?php echo $lang['ManageInvoice'];?></a></li>
                                <li><a href="paid-invoices.php"><?php echo $lang['PaidInvoices'];?></a></li>
                                <li><a href="unpaid-invoices.php"><?php echo $lang['UnpadInvoices'];?></a></li>                               						
							</ul>
						</li>    
						<!--                    
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-receipt"></i></span>
								<span class="s-text"><?php //echo $lang['Expenses'];?></span>
							</a>
                            <ul>
                            	<li><a href="add-expense-type.php"><?php //echo $lang['AddExpenses'];?></a></li>
                                <li><a href="expense-types.php"><?php //echo $lang['ManageExpensesType'];?></a></li>	
								<li><a href="add-expense.php"><?php //echo $lang['AddExpensesInvoice'];?></a></li>
                                <li><a href="expense-invoices.php"><?php //echo $lang['ManageExpensesInvoice'];?></a></li>	
                                <li><a href="paid-expense-invoices.php"><?php //echo $lang['PaidExpensesInvoice'];?></a></li>
                                <li><a href="unpaid-expense-invoices.php"><?php //echo $lang['UnpaidExpensesInvoice'];?></a></li>						
							</ul>
						</li>
						-->                
                   
						 <!--
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-money"></i></span>
								<span class="s-text"><?php //echo $lang['Loan'];?></span>
							</a>
                            <ul>
								<li><a href="add-loaner.php"><?php //echo $lang['AddLoaner'];?></a></li>
                                <li><a href="loaners.php"><?php //echo $lang['ManageLoaners'];?></a></li>
                                <li><a href="add-loan.php"><?php //echo $lang['AddLoan'];?></a></li>
                                <li><a href="loans.php"><?php //echo $lang['ManageLoan'];?></a></li>							
							</ul>
						</li>
						-->
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-user"></i></span>
								<span class="s-text"><?php echo $lang['Staff'];?></span>
							</a>
                            <ul>
								<li><a href="add-staff.php"><?php echo $lang['AddStaff'];?></a></li>
                                <li><a href="staff.php"><?php echo $lang['ManageStaff'];?></a></li>							
							</ul>
						</li>                        
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">                            								
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-bar-chart"></i></span>
								<span class="s-text"><?php echo $lang['Reports'];?></span>
							</a>
                            <ul>
                            	<li><a href="profit_and_loss_ledger.php"><?php echo $lang['SalesProfit/LossLedger'];?></a></li>
								<li><a href="sales_ledger.php"><?php echo $lang['SalesLedger'];?></a></li>
                                <!-- <li><a href="expense_ledger.php"><?php //echo $lang['ExpensesLedger'];?></a></li> -->						
							</ul>
						</li>                      
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
								<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-settings"></i></span>
								<span class="s-text"><?php echo $lang['Setting'];?></span>
							</a>
							<ul>                            
								<li><a href="company-info.php"><?php echo $lang['CompanyInfo'];?></a></li>                                                                
                               <li> <a href="signout.php"><?php echo $lang['SignOut'];?></a></li>                               								
							</ul>
						</li>																				
						<li class="compact-hide">
							<a href="../Documentation/index.html" target="new" class="waves-effect  waves-light">
								<span class="s-icon"><i class="fa fa-circle-o text-primary"></i></span>
								<span class="s-text"><?php echo $lang['Documentation'];?></span>
							</a>
						</li>
                         <?php } ?>  
                       
                        <?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='3') { ?>                         
                        
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-receipt"></i></span>
								<span class="s-text"><?php echo $lang['Invoice'];?></span>
							</a>
                            <ul>                                                   
                            
                                <li><a href="add-invoice.php"><?php echo $lang['AddInvoice'];?></a></li>
                                <li><a href="invoices.php"><?php echo $lang['ManageInvoice'];?></a></li>
                                <li><a href="paid-invoices.php"><?php echo $lang['PaidInvoices'];?></a></li>
                                <li><a href="unpaid-invoices.php"><?php echo $lang['UnpadInvoices'];?></a></li>                               						
							</ul>
						</li>
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-receipt"></i></span>
								<span class="s-text"><?php echo $lang['Expenses'];?></span>
							</a>
                            <ul>
                            	<li><a href="add-expense-type.php"><?php echo $lang['AddExpenses'];?></a></li>
                                <li><a href="expense-types.php"><?php echo $lang['ManageExpensesType'];?></a></li>	
								<li><a href="add-expense.php"><?php echo $lang['AddExpensesInvoice'];?></a></li>
                                <li><a href="expense-invoices.php"><?php echo $lang['ManageExpensesInvoice'];?></a></li>	
                                <li><a href="paid-expense-invoices.php"><?php echo $lang['PaidExpensesInvoice'];?></a></li>
                                <li><a href="unpaid-expense-invoices.php"><?php echo $lang['UnpaidExpensesInvoice'];?></a></li>						
							</ul>
						</li>   
                                                
                        <?php }                       
                            
					 if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='2') { ?>
                                 
                                                                  
                        <li class="with-sub">
							<a href="#" class="waves-effect  waves-light">
                            	<span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-receipt"></i></span>
								<span class="s-text"><?php echo $lang['Invoice'];?></span>
							</a>
                            <ul>                                                   
                            
                                <li><a href="add-invoice.php"><?php echo $lang['AddInvoice'];?></a></li>
                                <li><a href="invoices.php"><?php echo $lang['ManageInvoice'];?></a></li>
                                <li><a href="paid-invoices.php"><?php echo $lang['PaidInvoices'];?></a></li>
                                <li><a href="unpaid-invoices.php"><?php echo $lang['UnpadInvoices'];?></a></li>                               						
							</ul>
						</li>                           
                        <?php } ?>
					</ul>
				</div>
			</div>