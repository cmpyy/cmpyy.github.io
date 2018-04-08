<?php
header("Content-type:text/xml;charset=utf-8");
$fname = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["SCRIPT_NAME"];define("URL","$fname");
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<list>\n";
function t_v($url) {
       $user_agent = $_SERVER['HTTP_USER_AGENT'];
       $ch = curl_init(); 
       $timeout = 30;
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
       @ $file = curl_exec($ch);
       curl_close($ch);
       return $file;
}
$fname = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["SCRIPT_NAME"];
if(isset ($_GET['page'])){
       global $fname;
       $a = 'http://v.pps.tv/v_list/c_tv_o_3_p_'.$_GET['page'].'.html';
       $b = t_v($a);
       preg_match_all('|<div class="t"><a href="http://v.pps.tv/splay_([^"]+).html" title=|ims', $b, $c);
       preg_match_all('|.html" title="([^"]+)" target="_blank">|ims', $b, $d);
       $f = count($c[1]);
for($i=0;$i<$f;$i++){
       $xml .='<m list_src="' . $fname . '?id=' . $c[1][$i] . '" label="' . $d[1][$i] . '" />' . "\n";
}}
elseif(isset ($_GET['id'])){
       $a ='http://v.pps.tv/ugc/ajax/aj_newlongvideo.php?sid='.$_GET['id'].'&type=splay';
       $b = t_v($a);
       preg_match_all('|"url_key":"([^"]+)","cover|', $b, $c);
       preg_match_all('|"order":"([^"]+)","play_nums|', $b, $d);
       $f = count($c[1]);
for($i=0;$i<$f;$i++){
       $xml .='<m type="2" src="http://dp.ugc.pps.tv/get_play_url.php?sid=' . $c[1][$i] . '" label="第' . $d[1][$i]. '集" />' . "\n";
}}
else{
for($i=1;$i<=87;$i++){
       $xml .='<m list_src="' . $fname . '?page=' . $i . '" label="PPS电视剧第' . $i . '页" />' . "\n";
}}
$xml .= '</list>';
echo $xml;
?>