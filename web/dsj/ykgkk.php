<?php
//优酷公开课代理
//cmp交流群91530683
//论坛	http://www.365ee.cn
header("Content-type:text/xml;charset=utf-8");
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<list>\n";

function m_v($url) {
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
       $a='http://www.youku.com/v_olist/c_87_g__a__sg__mt__lg__q__s_1_r_0_u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_'.$_GET['page'].'.html';
       $b = m_v($a);
	   preg_match_all('|<div class="p-meta-title"><a href="http://www.youku.com/show_page/id_(.*?).html" target="_blank" title="(.*?)">|', $b, $uu);
       $f = count($uu[1]);
       for($m=0;$m<$f;$m++){
       $xml .='<m list_src="' . $fname . '?id=' . $uu[1][$m]  . '" label="' . $uu[2][$m]  . '"/>'."\n";
}}   	      
elseif(isset ($_GET['id'])){
       $url='http://www.youku.com/show_page/id_'.$_GET['id'].'.html';
       $str = m_v($url);
           preg_match('/id="zySeriesTab">(.*)<\/ul>/imsU',$str,$arr);
           preg_match_all('/<li data="(.*)"/imsU',$arr[1],$id);
     if($id[1][0] == ""){$id[1][0] = "reload_1";}
	   foreach ($id[1] as $reload){
       $urll="http://www.youku.com/show_episode/id_".$_GET['id'].".html?dt=json&divid=" . $reload . "&__rt=1&__ro=" . $reload ."";
       $url=m_v($urll);
       preg_match_all('|href="http://v.youku.com/v_show/id_([^"]+).htm(.*?)target="_blank(.*?)>([^"]+)</a></li>|', $url, $b);
       $d = count($b[1]);
       for($m=0;$m<$d;$m++){
       $xml .='<m type="youku" src="' . $b[1][$m] . '" label="' . $b[4][$m] . '" />'."\n";
}}}
else{
       for($i=1; $i<=26;$i++) {
	   $xml .= '<m list_src="' . $fname . '?page=' . $i  . '" label="公开课第' . $i . '页"/>'."\n";
}}
$xml .= '</list>';
echo $xml;
?>