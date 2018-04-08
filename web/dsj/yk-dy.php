<?php

//   #### 优酷电影采集代码由 Ahua自由科技原程序####



//   "<!--"
//   "//                            _ooOoo_  "
//   "//                           o8888888o  "
//   "//                           88\" . \"88  "
//   "//                           (| -_- |)  "
//   "//                            O\\ = /O  "
//    "//                        ____/`---'\\____  "
//   "//                      .   ' \\\\| |// `.  "
//   "//                       / \\\\||| : |||// \\  "
//   "//                     / _||||| -:- |||||- \\  "
//   "//                       | | \\\\\\ - /// | |  "
//   "//                    | \\_| ''\\---/'' | |  "
//   "//                     \\ .-\\__ `-` ___/-. /  "
//   "//                  ___`. .' /--.--\\ `. . __  "
//   "//               .\"\" '< `.___\\_<|>_/___.' >'\"\".  "
//   "//              | | : `- \\`.;`\\ _ /`;.`/ - ` : | |  "
//   "//                \\ \\ `-. \\_ __\\ /__ _/ .-` / /  "
//   "//        ======`-.____`-.___\\_____/___.-`____.-'======  "
//   "//                           `=---='  "
//   "//                Ahua自由科技版本_www.ahuazykj.com"
//   "//        .............................................  "
//   "//                 佛祖保佑             永无BUG "
//   "//         佛曰:  "
//   "//                 写字楼里写字间，写字间里程序员；  "
//   "//                 程序人员写程序，又拿程序换酒钱。  "
//   "//                 酒醒只在网上坐，酒醉还来网下眠；  "
//   "//                 酒醉酒醒日复日，网上网下年复年。  "
//   "//                 但愿老死电脑间，不愿鞠躬老板前；  "
//   "//                 奔驰宝马贵者趣，公交自行程序员。  "
//   "//                 别人笑我忒疯癫，我笑自己命太贱；  "
//   "//                 不见满街漂亮妹，哪个归得程序员？"
//   "-->"
//禁止缓存
 
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
 
if(isset ($_GET['page'])){
 
       $urll ='http://movie.youku.com/search/index/_page63561_2_page40487_'.$_GET['page'].'_cmodid_40487?__rt=1&__ro=m13055109992';
 
       $url = m_v($urll);
 
       preg_match_all('#class="p_link"><a title="(.*)" href="http://v.youku.com/v_show/id_(.*).html#',$url,$b);
 
           preg_match_all('#<li class="p_thumb"><img src="(.*)" alt=#',$url,$g);
 
       $d = count($b[1]);
 
       for($m=0;$m<$d;$m++){
 
       $xml .='<m type="youku" image="'.$g[1][$m].'" src="' . $b[2][$m] . '" label="'.$b[1][$m].'"/>'."\n";
 
}}else{
 
       for($i=1;$i<=34;$i++){
 
       $xml .='<m list_src="' . $fname . '?page=' . $i . '" label="优酷第' . $i . '章电影"/>' . "\n";
 
}}
 
$xml .= '</list>';
 
echo $xml;
 
?>