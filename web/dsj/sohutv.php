<?php
header("content-type:text/html;charset=utf-8");
//禁止缓存
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Cache-Control: no-store, must-revalidate"); 
header("Pragma: no-cache"); 
//判断来路
$url = $_SERVER["HTTP_REFERER"];
$str = str_replace("http://","",$url);
$strdomain = explode("/",$str);
$domain = $strdomain[0]; 
//if($domain =="http://tv.sohu.com"){

$xml = "\n<list>\n";

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

if(isset ($_GET['u'])){

       $u=$_GET['u'];

       $t = explode('-', $u);

       for ($i = 1; $i <= $t[1]; $i++) {

       $y = 'http://so.tv.sohu.com/list_p1101_p2'.$t[0].'_p3_p4-1_p5_p6_p77_p80_p91_p10'.$i.'_p11_p12_p13.html';

       $xml .= '<m list_src="' . $fname . '?p=' . $y . '" label="' . $k . '第' . $i . '页"/>'."\n";
}}

elseif(isset ($_GET['p'])){

       $a=$_GET['p'];

       $b = m_v($a);

       preg_match_all('# <strong><a href="(.*?)" title="(.*?)"#ims', $b, $v);
       preg_match_all('#span class="maskTx">(.*?)</span#ims', $b, $w);
       preg_match_all('# pb-url="(.*?) _s_k="(.*?)"><img src="(.*?)"
			alt="">#ims', $b, $x);

       $f = count($v[1]);

       for($m=0;$m<$f;$m++){

       $xml .='<m list_src="' . $fname . '?r=' . $v[1][$m] . '" image="' . $x[3][$m] . '" label="' . $v[2][$m] . '-' . $w[1][$m] . '"/>'."\n";

}}
elseif(isset ($_GET['r'])){
       $l =''.$_GET['r'].'';
       $r = m_v($l);
       preg_match_all('#<a title="(.*)" href="(.*)" target="_blank"><img (.*) src="(.*)" alt=#',$r,$a);
       $y = count($a[1]);
       for($m=0;$m<$y;$m++){
       $xml .='<m type="merge" src="http://5gtv.aliapp.com/api/cmpjx.php?url=' . $a[2][$m] . '" image="'.$a[4][$m].'" label="'.$a[1][$m].'"/>'."\n";
}}

else{

$tttmv = array (
       '全部' => '-44',
       '偶像剧' => '101100-9',
       '家庭剧' => '101101-9',
       '历史剧' => '101102-9',
       '年代剧' => '101103-9',
       '言情剧' => '101104-9',
       '武侠剧' => '101105-9',
       '古装剧' => '101106-9',
       '都市剧' => '101107-9',
       '农村剧' => '101108-9',
       '军旅剧' => '101109-9',
       '刑侦剧' => '101110-9',
       '喜剧' => '101111-9',
       '悬疑剧' => '101112-9',
       '情景剧' => '101113-9',
       '传记剧' => '101114-9',
       '科幻剧' => '101115-9',
       '动画片' => '101116-9',
       '动作剧' => '101117-9',
       '真人秀' => '101118-9',
       '栏目剧' => '101119-9',
       '谍战剧' => '101120-9',
       '伦理剧' => '101121-9',
       '战争剧' => '101122-9',
       '神话剧' => '101123-9',
       '惊悚剧' => '101124-9',
       '剧情片' => '101127-9',


);

foreach ($tttmv as $k => $v) {

       $xml .= '<m list_src="' . $fname . '?u=' . $v  . '" label="' . $k . '"/>'."\n";

}}

$xml .= '</list>';

echo $xml;

?>