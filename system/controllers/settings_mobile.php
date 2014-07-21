<?php
	/*
	ALTER TABLE `users` ADD `mobile_sms` VARCHAR( 255 ) NOT NULL AFTER `is_network_admin` ,
ADD `mobile_actived` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `mobile_sms` ,
ADD `mobile_active_code` INT( 10 ) NOT NULL AFTER `mobile_actived` ,
ADD `mobile_active_time` VARCHAR( 255 ) NOT NULL AFTER `mobile_active_code`

	*/
	
	
	
/*
	
	MADE BY ARASH TAVANAEI 09130246374 - http://forum.bolur.ir
	
	ONLY FOR novinpayamak.com 
	
	
	
	*/
	if( !$this->network->id ) {
		$this->redirect('home');
	}
		if( !$this->user->is_logged ) {
		$this->redirect('signup');
	}
$u = $D->u = $this->network->get_user_by_id($this->user->id,true);
	$this->load_langfile('inside/global.php');
	$this->load_langfile('inside/user.php');
	$D->error=false;
	$D->error_message = "";
	$D->submit = false;
    $D->ok_message = "";
//////////////////////////////////////	
$D->ACTIVATION_PLUGIN_INSTALLED = true;
////////////////////////////////////////

if(isset($_POST['SBM'])){

$num = isset($_POST['MOBILE']) ? trim($_POST['MOBILE']) : '';

if(!valid_mobile_num($num)){
	$D->error=TRUE;
	$D->error_message .= "شماره موبایل فرمت صحیحی ندارد <br>";

	}
	$num = encode_mobile_num($num);
if($D->u->mobile_sms <> $num && $db2->fetch_field('SELECT COUNT(id) FROM users WHERE mobile_sms="'.($num).'" LIMIT 1')>0){
	$D->error=TRUE;
	$D->error_message .= "شماره موبایل وارد شده قابل ذخیره سازی نیست <br>";
	
	
	}
if(!$D->error){


$db2->query("UPDATE users SET   mobile_sms='".$num."'  WHERE id='".$u->id."' LIMIT 1");

if($D->ACTIVATION_PLUGIN_INSTALLED && $D->u->mobile_sms <> $num){
	$db2->query("UPDATE users SET mobile_actived='0' ,  mobile_active_code='',mobile_active_time='' WHERE id='".$u->id."' LIMIT 1");
}

$D->submit = true;
$D->ok_message = "ذخیره شد";
	




}


}	
	
	
	
	
	
	$this->load_template('settings_mobile.php');
	
?>