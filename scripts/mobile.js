function mobile_device_detect(url)
{ 
    var thisOS=navigator.platform; 
    var os=new Array("iPhone","iPod","iPad","android","Nokia","SymbianOS","Symbian","Windows Phone","Phone","Linux armv71","MAUI","UNTRUSTED/1.0","Windows CE","BlackBerry","IEMobile");
 for(var i=0;i<os.length;i++)
    { 
 if(thisOS.match(os[i]))
    {  
 window.location=url;
 } 
 }
 
 //��Ϊ�൱���ֵ��ֻ�ϵͳ��֪����Ϣ,����������ʱ���������
 if(navigator.platform.indexOf('iPad') != -1)
    {
 window.location=url;
 }
 
 //����һ��������ΪAndroid�ֻ����ں�Ҳ��Linux
 //����navigator.platform��ʾ��Ϣ������ͬ�������,��˴���������֣�����navigator.appVersion��Ϣ���ж�
 var check = navigator.appVersion;
 
 if( check.match(/linux/i) )
     {
  //X11��UC�������ƽ̨ ��������������������Ҳ���Ը���������
  if(check.match(/mobile/i) || check.match(/X11/i))
         {
  window.location=url;
  } 
 }
 
 //��in_array����
 Array.prototype.in_array = function(e)
 {
 for(i=0;i<this.length;i++)
 {
  if(this[i] == e)
  return true;
 }
 return false;
 }
} 
mobile_device_detect("http://m.cmpyy.com/");