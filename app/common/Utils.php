<?php
namespace app\common;

use think\facade\Cache;

class Utils{

    /**
     * 获得用户的真实IP
     * @return bool|mixed
     */
    function get_real_ip(){
        $ip = FALSE;
        //客户端IP 或 NONE
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = FALSE;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi("^(10│172.16│192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        //客户端IP 或 (最后一个)代理服务器 IP
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    /**
     * 发起http post请求(REST API), 并获取REST请求的结果
     * @param string $url
     * @param string $param
     * @return - http response body if succeeds, else false.
     */
    function request_post($url = '', $param = '')
    {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        // 初始化curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $postUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // post提交方式
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        // 运行curl
        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    function CheckText($text){
        if(!Cache::get("BaiduToken",false)){
            $tokenurl = 'https://aip.baidubce.com/oauth/2.0/token';
            $post_data['grant_type']       = 'client_credentials';
            $post_data['client_id']      = 'Mzbm6AVLE192mvR7HQzyfMt9';
            $post_data['client_secret'] = 'QW6zAvPthGX7fM7MUG9l8TZGVDdASRE1';
            $o = "";
            foreach ( $post_data as $k => $v ){
                $o.= "$k=" . urlencode( $v ). "&" ;
            }
            $post_data = substr($o,0,-1);
            $auth = json_decode($this -> request_post($tokenurl, $post_data));
            $token = $auth -> access_token;
            Cache::set("BaiduToken",$token,2160000);
        }else{
            $token = Cache::get("BaiduToken");
        }
        $url = 'https://aip.baidubce.com/rest/2.0/solution/v1/text_censor/v2/user_defined?access_token=' . $token;
        $bodys = array(
            'text' => $text
        );
        $res = $this -> request_post($url, $bodys);
        return json_decode($res);
    }

}
