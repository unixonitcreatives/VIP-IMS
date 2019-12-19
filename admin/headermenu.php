<div class="site-header">
				<nav class="navbar navbar-light">
					<div class="navbar-left">
						<a class="navbar-brand" href="index.php">
							<img src="img/logo/<?php if(isset($setting_logo1)){ echo $setting_logo1;}?>" class="logo" >
						</a>
						<div class="toggle-button light sidebar-toggle-first float-xs-left hidden-md-up">
							<span class="hamburger"></span>
						</div>
						<div class="toggle-button-second dark float-xs-right hidden-md-up">
							<i class="ti-arrow-left"></i>
						</div>
						<div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
							<span class="more"></span>
						</div>
					</div>
					<div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
                    
						<div class="toggle-button sidebar-toggle-second float-xs-left hidden-sm-down light">
							<span class="hamburger"></span>
						</div>
						<!--<div class="toggle-button-second dark float-xs-right hidden-sm-down">
							<i class="ti-arrow-left"></i>
						</div>-->
                        
						<ul class="nav navbar-nav float-md-right">						
							<?php if(!empty($_SESSION['user_type_id']) && $_SESSION['user_type_id']=='1') { ?> 
                            <li class="nav-item dropdown">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
									<?php echo $lang['Languages'];?>	
                                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>															
								</a>
								<div class="dropdown-menu dropdown-menu-right animated fadeInUp">								
									
									<a class="dropdown-item" href="language.php?lang=en">English</a>
                                    <a class="dropdown-item" href="language.php?lang=fr">French</a>
                                    <a class="dropdown-item" href="language.php?lang=es">Spanish</a>
                                    <a class="dropdown-item" href="language.php?lang=in">Indonesian</a>
                                    <a class="dropdown-item" href="language.php?lang=nig">Nigerian</a>								
								</div>
							</li>
                            <?php } ?>
							<li class="nav-item dropdown hidden-sm-down">
								<a href="#" data-toggle="dropdown" aria-expanded="false">
									<span class="avatar box-32">
										<img src="img/avatars/default.jpg" alt="">
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right animated fadeInUp">								
									
                                    <a class="dropdown-item" href="profile.php">
										<i class="ti-user mr-0-5"></i> <?php echo $lang['Profile'];?>
									</a>									
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-help mr-0-5"></i> Help</a>
									<a class="dropdown-item" href="signout.php"><i class="ti-power-off mr-0-5"></i> <?php echo $lang['SignOut'];?></a>
								</div>
							</li>
						</ul>
						<ul class="nav navbar-nav">
							<li class="nav-item hidden-sm-down light">
								<a class="nav-link toggle-fullscreen" href="#">
									<i class="ti-fullscreen"></i>
								</a>
							</li>							
						</ul>
                        
                        
						<div class="header-form float-md-left ml-md-2">
							<form name="quick_search" method="get" action="invoice.php">
								<input type="text" class="form-control b-a quick_invoice_search" placeholder="<?php echo $lang['Searchforinvoice'];?>...">
                                <input id="i" name="i" class="hidden_value_invoice" type="hidden" >
								<button type="submit" class="btn bg-white b-a-0">
									<i class="ti-search"></i>
								</button>
							</form>
                           
						</div>
					</div>
				</nav>
			</div>