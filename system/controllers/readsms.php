<?php
	
	if( !$this->network->id ) {
		echo 'ERROR';
		return;
	}
	//if( $this->user->is_logged ) {
	////	echo 'ERROR';
		//return;
	//}
	ini_set( 'error_reporting', E_ALL | E_STRICT	);
	ini_set( 'display_errors',			1	);
	$network = $this->network;
$my_g = '30006320001111';
 //$ip =$_SERVER['REMOTE_ADDR'];
//mail('arash.tavanaei@yahoo.com',$ip,$ip);
if( isset($_SERVER['REMOTE_ADDR']) && isset($_GET['Gateway'],$_GET['Sender'],$_GET['Text']) && $_GET['Gateway'] == $my_g){
	
$r = $_SERVER['REQUEST_URI'];
	 $message = 	urldecode($_GET['Text']);
	// $to = ($this->param('to'));
	 $from = $_GET['Sender'];

	
if(preg_match_all('/\+98/iu', $from, $matches, PREG_PATTERN_ORDER) ) {
  $from = str_replace($matches[0][0],'0',$from)	 ;
				}
$from = ($from);

print_r($from);
 $uid = get_user_sms($from);
	if(!$inu = $this->network->get_user_by_id($uid)){
		return;
		exit;
	}else{
	
	$inu->is_logged= true;
	$inu->info= $inu;
	
	
	
	
	if(preg_match_all('/\#del\:(.*?)\#/iu', $message, $matches, PREG_PATTERN_ORDER) ) {
$D->is_get_set = TRUE;

 if(($matches[1][0])>0){

 
$nums = intval($matches[1][0]);
	
$r = $db2->query('SELECT id FROM posts WHERE user_id="'.intval($uid).'" ORDER BY id DESC LIMIT '.$nums.'');	
	while($tmp = $db2->fetch_object($r)) {
		$posts[]	= intval($tmp->id);
	}
$user	= (object) array (
		'is_logged'	=> TRUE,
		'id'		=> 0,
		'info'	=> (object) array('is_network_admin' => 1),
	);
	foreach($posts as $tmp) {
		$p	= new post('public', $tmp);
		$p->delete_this_post();
	}



}
echo "DEL:".$nums;
	continue;
}

/////////////////////////////////DEL HA//////////////////////////////////////	
	
	
	

	////////////////////////////////////////////////////////////////////////////////////////////
	$p	= new newpost();


$p->set_user_advanced( $network, ($inu) );
if(preg_match_all('/\#g\:(.*?)\#/iu', $message, $matches, PREG_PATTERN_ORDER) ) {
  if(trim($matches[1][0])){
 $to_group = $network->get_group_by_name(trim($matches[1][0]),FALSE,TRUE);
 $message =	str_replace($matches[0][0],"",$message);
  $p->set_group_id(intval($to_group)); ; 
  }
				}
if(!preg_match_all('/\#g\:(.*?)\#/iu', $message, $matches, PREG_PATTERN_ORDER) && preg_match_all('/\#pv\:(.*?)\#/iu', $message, $matches, PREG_PATTERN_ORDER) ) {
 
 
 if(trim($matches[1][0])){

 $to_user = $network->get_user_by_username(trim($matches[1][0]),FALSE,TRUE);
  

		$message =	str_replace($matches[0][0],"",$message);

  $p->set_to_user(intval($to_user)); ; 
  }
				}
				
				
			/*if(substr($message,0,6) == "#poll#"){
			$in = array('#poll#','*');
			$ba = array('',"\r\n");
		$message =	str_replace($in,$ba,$message);
			$p->set_poll(1);
			}*/
				
				
				$p->set_api_id(7);
			$p->set_message($message);

			
			
			echo 'SAVED';
$res = $p->save();
	} 
	 
exit;
}
	
	echo 'ERROR';
	return;
	
?>