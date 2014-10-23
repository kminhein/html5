<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<?php if($this->config->item('google_verification')){ echo stripslashes($this->config->item('google_verification')); }
if ($heading == ''){?>
<title><?php echo $title;?></title>
<?php }else {?>
<title><?php echo $heading;?></title>
<?php }?>
<meta name="Title" content="<?php echo $meta_title;?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />
<meta name="description" content="<?php echo $meta_description; ?>" />
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/logo/<?php echo $fevicon;?>"/>

<!-- Loading Css Files -->
<?php $this->load->view('site/templates/css_files');?>

<!-- Loading Script Files -->
<?php $this->load->view('site/templates/script_files');?>

<!-- Loading Theme Settings-->
<?php $this->load->view('site/templates/theme_settings');?>

<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Ultra::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>

<link type="text/css" rel="stylesheet" href="css/mobilemenu-25.css" />
<link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>
 
<script type="text/javascript">
	$(function() {
		$('nav#mobileresmenu').mmenu(); 
	});
</script>

</head>
<body>

<!-- header_start -->
<header>
	<div class="header_top">
		<?php  $pricesval = $pricefulllist->result_array(); $ColorsListVal = $mainColorLists->result_array(); ?>
		<?php if (is_file('google-login-mats/index.php')) { require_once 'google-login-mats/index.php'; } ?>  
		<?php $by_creating_accnt = str_replace("{SITENAME}",$siteTitle,$this->lang->line('header_create_acc')); ?>
		<div class="logo">
			<div class="main">
				<h1 class="logo"><a href="<?php echo base_url();?>" alt="<?php echo $siteTitle;?>" title="<?php echo $siteTitle;?>"><img src="images/logo/<?php echo $logo;?>"/></a></h1>
			</div>
		</div>
		<div class="main navigation">
			<?php $this->load->view('site/templates/desktopmenu');?>			
		</div>
    </div>
</header>
<!-- header_end -->
<!-- Loading Popup Templates -->
<?php $this->load->view('site/templates/popup_templates');?>
		  
<?php if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));} ?>