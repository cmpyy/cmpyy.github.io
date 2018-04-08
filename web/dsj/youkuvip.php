<?php
header("content-type:text/xml;charset=utf-8");
//禁止缓存
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Cache-Control: no-store, must-revalidate"); 
header("Pragma: no-cache"); 
//判断来路
$url = $_SERVER["HTTP_REFERER"];
$str = str_replace("http://","",$url);
$strdomain = explode("/",$str);
$domain = $strdomain[0]; 
//if($domain =="http://www.youku.com"){
//优酷VIP电影 代理 
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
if(isset ($_GET['u'])){
       $l ='http://www.youku.com/show_page/id_'.$_GET['u'].'.html';
       $r = m_v($l);
       preg_match_all('#class="btnShow btnfreesee" charset="(.*)" href="http://v.youku.com/v_show/id_(.*).html(.*)" target="_blank" data-from="(.*)"><em>(.*)</em>#',$r,$a);
	   preg_match_all('#<span class="name">(.*)</span>#',$r,$a1);
	   //preg_match_all("#<img src='(.*)' alt='(.*)'></li>#",$r,$a2);
       $y = count($a[2]);
       for($m=0;$m<$y;$m++){
       $xml .='<m type="youku" src="' . $a[2][$m] . '" image="'.$b2[1][$m].'" label="'.$a1[1][$m].'" />'."\n";
}}
elseif(isset ($_GET['p'])){
       $urll ='http://www.youku.com/v_load/c__pt_1_r__mg__a__o_1_pn_'.$_GET['p'].'.html';
       $url = m_v($urll);
       preg_match_all('#<div class="meta_info-title"><a target="video" href="http://www.youku.com/show_page/id_(.*).html">(.*)</a>#',$url,$b);
preg_match_all("#background-image:url\('(.*)'\);#",$url,$b2);
       $d = count($b[1]);
       for($m=0;$m<$d;$m++){
       $xml .='<m list_src="' . $fname . '?u=' . $b[1][$m] . '" image="'.$b2[1][$m].'"   label="'.$b[2][$m].'" />'."\n";
}}else{
       for($i=1;$i<=29;$i++){
    $xml .='<m list_src="' . $fname . '?p=' . $i . '"  label="优酷VIP会员电影 第' . $i . '页" />' . "\n";
}}
$xml .= '</list>';
echo $xml;

?>