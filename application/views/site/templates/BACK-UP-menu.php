 <ul class="gnb-wrap">
            <li class="gnb">
              <!-- <a href="/gifts" class="mn-gifts">Gifts</a> -->
              <a class="mn-gifts" href="shop"><?php if($this->lang->line('header_shop') != '') { echo stripslashes($this->lang->line('header_shop')); } else echo "Shop"; ?></a>
              <div class="menu-contain-gift">
                <ul>
<?php 
if ($fancyBoxCount>0){
?>                
                  <li><a href="fancybox"><?php if($this->lang->line('header_fancybox') != '') { echo stripslashes($this->lang->line('header_fancybox')); } else echo "Fancy Box"; ?></a></li>
<?php 
}
if ($this->config->item('giftcard_status') == 'Enable'){
?>  
                  <li><a href="gift-cards"><?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></a></li>
<?php 
}
if($loginCheck != ''){
?>                  
                   <li><a href="bookmarklets"><?php if($this->lang->line('bookmarklets') != '') { echo stripslashes($this->lang->line('bookmarklets')); } else echo "Bookmarklets"; ?></a></li>
<?php }?>                 
                </ul>
                <ul>
                  <li><a href="shopby/all?p=<?php echo url_title($pricesval[0]['price_range']); ?>"><i class="arrow"></i><?php if($this->lang->line('header_by_price') != '') { echo stripslashes($this->lang->line('header_by_price')); } else echo "By Price"; ?></a>
                    <div class="submenu-contain">
                      <ul> <?php foreach ($pricefulllist->result() as $priceRangeRow){ ?>
                        <li><a href="shopby/all?p=<?php echo url_title($priceRangeRow->price_range); ?>"><?php echo $currencySymbol;?> <?php echo ucfirst($priceRangeRow->price_range);  ?></a></li>
                       <?php } ?>
                      </ul>
                    </div>
                  </li>
                  <?php if ($mainColorLists->num_rows()>0){?>
                  <li><a class="color-red" href="shopby/all?c=<?php echo $ColorsListVal[0]['list_value'];?>"><i class="arrow"></i><?php if($this->lang->line('header_by_color') != '') { echo stripslashes($this->lang->line('header_by_color')); } else echo "By Color"; ?></a>
                    <div class="submenu-contain">
                      <ul class="palette">
                      <?php 
                      foreach ($mainColorLists->result() as $colorRow){
                      	if ($colorRow->list_value != ''){
                      ?>
                        <li><a href="shopby/all?c=<?php echo strtolower($colorRow->list_value);?>"><i class="color <?php echo strtolower($colorRow->list_value);?>"></i> <?php echo ucfirst($colorRow->list_value);?></a></li>
                      <?php 
                      	}
                      }
                      ?>  
                      </ul>
                    </div>
                  </li>
                  <?php }?>
                  <?php if ($mainCategories->num_rows()>0){?>
                  <li><a href="shopby/all"><i class="arrow"></i><?php if($this->lang->line('header_by_category') != '') { echo stripslashes($this->lang->line('header_by_category')); } else echo "By Category"; ?></a>
                    <div class="submenu-contain">
                      <ul>
                      <?php 
                      foreach ($mainCategories->result() as $row){
                      	if ($row->cat_name != ''){
                      ?>
                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>"><?php echo $row->cat_name;?></a>
                        <?php if (in_array($row->id, $root_id_arr)){?>
	                    <div class="submenu-contain1" style="top:0;">
	                      <ul>
	                      <?php 
	                      foreach ($all_categories->result() as $row1){
	                      	if ($row1->cat_name != '' && $row->id==$row1->rootID){
	                      ?>
	                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>"><?php echo $row1->cat_name;?></a>
	                        	 <?php if (in_array($row1->id, $root_id_arr)){?>
			                    <div class="submenu-contain2" style="top:0;">
			                      <ul>
			                      <?php 
			                      foreach ($all_categories->result() as $row2){
			                      	if ($row2->cat_name != '' && $row1->id==$row2->rootID){
			                      ?>
			                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>"><?php echo $row2->cat_name;?></a>
			                        	<?php if (in_array($row2->id, $root_id_arr)){?>
					                    <div class="submenu-contain3" style="top:0;">
					                      <ul>
					                      <?php 
					                      foreach ($all_categories->result() as $row3){
					                      	if ($row3->cat_name != '' && $row2->id==$row3->rootID){
					                      ?>
					                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>/<?php echo $row3->seourl;?>"><?php echo $row3->cat_name;?></a>
					                        	<?php if (in_array($row3->id, $root_id_arr)){?>
							                    <div class="submenu-contain4" style="top:0;">
							                      <ul>
							                      <?php 
							                      foreach ($all_categories->result() as $row4){
							                      	if ($row4->cat_name != '' && $row3->id==$row4->rootID){
							                      ?>
							                        <li style="position: relative;"><a href="shopby/<?php echo $row->seourl;?>/<?php echo $row1->seourl;?>/<?php echo $row2->seourl;?>/<?php echo $row3->seourl;?>/<?php echo $row4->seourl;?>"><?php echo $row4->cat_name;?></a>
							                        
							                        </li>
							                      	<?php 
							                      	}
							                      }
							                      	?>
						                          </ul>
						                        </div>  
						                        <?php }?>
					                        </li>
					                      	<?php 
					                      	}
					                      }
					                      	?>
				                          </ul>
				                        </div>  
				                        <?php }?>
			                        </li>
			                      	<?php 
			                      	}
			                      }
			                      	?>
		                          </ul>
		                        </div>  
		                        <?php }?>
	                        </li>
	                      	<?php 
	                      	}
	                      }
	                      	?>
                          </ul>
                        </div>  
                        <?php }?>
                        </li>
                      <?php 
                      	}
                      }
                      ?>
                      </ul>
                    </div>
                  </li>
                  <?php }?>
                </ul>
              </div>
            </li>
             <li class="gnb"><a class="mn-stores" href="stores"><?php if($this->lang->line('stores') != '') { echo stripslashes($this->lang->line('stores')); } else echo "Stores";?></a></li>
            <?php if ($loginCheck != ''){?>
            <li class="gnb"><a href="add" class="mn-add"><?php if($this->lang->line('header_add') != '') { echo stripslashes($this->lang->line('header_add')); } else echo "Add"; ?></a></li>
            <?php }?>
            <?php 
            if (count($cmsPages)>0){
            	$cmsLimit = 0;
            	$parentIdArr = array();
            	foreach ($cmsPages as $cmsArrRow){
            		array_push($parentIdArr, $cmsArrRow['parent']);
            	}
            	foreach ($cmsPages as $cmsRow){
            		if ($cmsLimit==1)break;
            		if ($cmsRow['category'] == 'Main'){
            			$cmsLimit++;
            			
            ?>
            <li class="gnb"><a class="mn-help" href="pages/<?php echo $cmsRow['seourl'];?>"><?php echo $cmsRow['page_name'];?></a>
            <?php if (in_array($cmsRow['id'], $parentIdArr)){?>
            <div class="menu-contain-help">
            <?php 
            foreach ($cmsPages as $cmsSubRow){
            	if ($cmsSubRow['category'] == 'Sub' && $cmsSubRow['parent'] == $cmsRow['id']){
            ?>
            	<ul>
                  <li><a href="pages/<?php echo $cmsSubRow['seourl'];?>"><?php echo $cmsSubRow['page_name'];?></a></li>
                </ul>
            <?php 
            	}
            }
            ?>
            </div>
            <?php }?>
            </li>
            <?php 
            		}
            	}
            }
            ?>
            <?php if ($loginCheck == ''){?>
            <li class="gnb"><a class="mn-signup popup-signup-ajax" href="#"><i class="ic-sign"></i> <?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Sign up"; ?></a></li>
            <?php }?>
          </ul>
		  
		  
		  <?php if ($loginCheck == ''){?>
  <ul class="gnb-wrap">
	<li class="gnb"><a href="login" class="mn-signin"><?php if($this->lang->line('signup_sign_in') != '') { echo stripslashes($this->lang->line('signup_sign_in')); } else echo "Sign in"; ?></a></li>
    <li id="lang_popup" class="gnb">
            <a class="mn-lang"><?php if($this->lang->line('prference_language') != '') { echo stripslashes($this->lang->line('prference_language')); } else echo "Language"; ?> <i></i></a>
            <div class="menu-contain-lang">
                <ul>	
                <?php 
                $selectedLangCode = $this->session->userdata('language_code');
                if ($selectedLangCode == ''){
                	$selectedLangCode = $defaultLg[0]['lang_code'];
                }
                if (count($activeLgs)>0){
                	foreach ($activeLgs as $activeLgsRow){
                ?>							
                    <li><a href="lang/<?php echo $activeLgsRow['lang_code'];?>" <?php if ($selectedLangCode == $activeLgsRow['lang_code']){echo 'class="selected"';}?>><?php echo $activeLgsRow['name'];?></a></li>
                <?php 
                	}
                }
                ?>    	
                </ul>        
            </div>
    </li>
    
</ul>    
<?php }else{ ?>
<div id="MiniCartViewDisp" style="float:left;">
<ul class="gnb-wrap">
	<li class="gnb none gnb-notification">
		<a href="notifications" class="mn-notification">
			<span class="hide"><?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></span> 
			<em class="ic-notification">
<!-- 				<i class="count">5</i>
 -->			</em>
		</a>
		<div class="feed-notification">
			<i class="arrow"></i>
			<h4><?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></h4>
			<div class="loading"><i></i></div>
			<ul>
				<li>
					<a href="">
					<img src="" class="photo"/>
					</a>
					
					<a href="">
					<img src="" class="thing"/>
					</a>
				</li>
			</ul>
			<a href="notifications" class="moreFeed"><?php if($this->lang->line('see_all_noty') != '') { echo stripslashes($this->lang->line('see_all_noty')); } else echo "See all notifications"; ?></a>
		</div>
	</li>
</ul>
<?php echo $MiniCartViewSet; ?>
</div>
 <?php } ?>
        
          <?php if ($loginCheck != ''){
          	if ($userDetails->row()->thumbnail == ''){
          		$thumbImg = 'user-thumb1.png';
          	}else {
          		$thumbImg = $userDetails->row()->thumbnail;
          	}
          ?>
            <ul class="gnb-wrap">
            <li class="gnb">
            	<a href="<?php echo 'user/'.$userDetails->row()->user_name;?>" class="mn-you"><img alt="vinumsc" class="default" src="images/site/blank.gif" /><?php if($this->lang->line('header_you') != '') { echo stripslashes($this->lang->line('header_you')); } else echo "You"; ?></a>
            	<style>.mn-you img.default {background-image:url(images/users/<?php echo $thumbImg;?>);} </style>
            	<div class="menu-contain-you">
            	<ul>
                  <li><a href="invite-friends"><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends";?></a></li>
                </ul>
                <ul>
                  <li><a href="settings"><?php if($this->lang->line('header_settings') != '') { echo stripslashes($this->lang->line('header_settings')); } else echo "Settings"; ?></a></li>
                  <li><a href="logout"><?php if($this->lang->line('header_signout') != '') { echo stripslashes($this->lang->line('header_signout')); } else echo "Sign out"; ?></a></li>
                </ul>
              </div>
             </li>
             </ul>
		  <?php }?>
		  <?php // }?> 