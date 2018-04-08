<?php
header("content-type:text/xml;charset=utf-8");
$url = $_SERVER["HTTP_REFERER"];
$str = str_replace("http://","",$url);
$strdomain = explode("/",$str);
$domain = $strdomain[0]; 
//if($domain =="http://www.youku.com"){
$xml = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<list>\n";
function m_v($url) {
       $user_agent = $_SERVER['HTTP_USER_AGENT'];
       $ch = curl_init(); 
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
       @ $file = curl_exec($ch);
       curl_close($ch);
       return $file;
}
$fname = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["SCRIPT_NAME"];
if(isset ($_GET['id'])){
       $urll ='http://www.youku.com/show_episode/id_'.$_GET['id'].'.html';
       $url = m_v($urll);
       preg_match_all('#<a href="http://v.youku.com/v_show/id_([^>]+).html([^>]+)title="([^>]+)" charset=#',$url,$b);
       $d = count($b[1]);
       for($m=0;$m<$d;$m++){
       $xml .='<m type="youku" src="' . $b[1][$m] . '"    label="'.$b[3][$m].'"/>'."\n";
}}
$xml .= '</list>';
echo $xml;

?>