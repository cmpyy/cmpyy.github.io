<?php
error_reporting(0);
header("Content-type:text/xml;charset=utf-8");
//优酷电视剧代理 作者落寞  QQ7419838 QQ群 91530683 bbs.365ee.cn
//插件youku.swf  

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
if(isset ($_GET['t'])){
       $c ='http://v.youku.com/v_show/id_'.$_GET['t'].'.html';
       $d = m_v($c);
       preg_match('|&pics=http://([^>]+)&site=|', $d, $s);
       $j = 'http://'.$s[1].'';
       header("location:$j");
}
if(isset ($_GET['w'])){
       $c ='http://www.youku.com/show_page/id_'.$_GET['w'].'.html';
       $d = m_v($c);
       preg_match('|&pics=http://([^>]+)&title=|', $d, $s);
       $j = 'http://'.$s[1].'';
       header("location:$j");
}

if(isset ($_GET['u'])){

       $u=$_GET['u'];

       $t = explode('-', $u);

       for ($i = 1; $i <= $t[1]; $i++) {

       $y = 'http://www.youku.com/v_olist/v_olist/c_97_g_'.$t[0].'_a__sg__mt__lg__q__s_1_r__u_0_pt_0_av_0_ag_0_sg__pr__h__d_1_p_'.$i.'.html';

       $xml .= '<m list_src="' . $fname . '?p='.urlencode($y).'"  label="电视剧-第' . $i . '页" />'."\n";

}}

elseif(isset ($_GET['p'])){

       $a=$_GET['p'];

       $b = m_v($a);

       preg_match_all('# <div class="p-meta-title"><a href="http://www.youku.com/show_page/id_(.*?).html" target="_blank" title="(.*?)">#ims', $b, $v);

       $f = count($v[1]);

       for($m=0;$m<$f;$m++){

       $xml .='<m list_src="' . $fname . '?id=' . $v[1][$m] . '"   label="' . $v[2][$m] . '" />'."\n";

}}
elseif(isset ($_GET['id'])){
       $l ='http://www.youku.com/show_episode/id_'.$_GET['id'].'.html';
       $r = m_v($l);
       preg_match_all('#<a href="http://v.youku.com/v_show/id_(.*).html(.*)title="(.*)" charset=#',$r,$a);
       $y = count($a[1]);
       for($m=0;$m<$y;$m++){
       $xml .='<m type="merge"  src="{lhkj}' . $a[1][$m] . '.youku"   label="'.$a[3][$m].'" />'."\n";
}}

else{

$tttmv = array (
       '神话电视剧' => '%E7%A5%9E%E8%AF%9D-5',
       '古装电视剧' => '%E5%8F%A4%E8%A3%85-29',
	   '武侠电视剧' => '%E6%AD%A6%E4%BE%A0-12',
	   '警匪电视剧' => '%E8%AD%A6%E5%8C%AA-29',
	   '军事电视剧' => '%E5%86%9B%E4%BA%8B-22',
	   '科幻电视剧' => '%E7%A7%91%E5%B9%BB-13',
	   '悬疑电视剧' => '%E6%82%AC%E7%96%91-29',
	   '历史电视剧' => '%E5%8E%86%E5%8F%B2-27',	 
	   '儿童电视剧' => '%E5%84%BF%E7%AB%A5-3',	
	   '农村电视剧' => '%E5%86%9C%E6%9D%91-8',
	   '时装电视剧' => '%E6%97%B6%E8%A3%85-29',
	   '都市电视剧' => '%E9%83%BD%E5%B8%82-29',	
	   '家庭电视剧' => '%E5%AE%B6%E5%BA%AD-29',	
	   '搞笑电视剧' => '%E6%90%9E%E7%AC%91-29',	
	   '偶像电视剧' => '%E5%81%B6%E5%83%8F-29',
	   '言情电视剧' => '%E8%A8%80%E6%83%85-29',


);

foreach ($tttmv as $k => $v) {

       $xml .= '<m list_src="' . $fname . '?u=' . $v  . '"  label="' . $k . '" />'."\n";

}}

$xml .= '</list>';

echo $xml;

?>