<?php
namespace app\middleware;

class CheckLogin{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next){
        if (!session('?login')) {
            //  未登录重定向到登陆页面
            $res = array(
                "msg"   =>  "Do not have permission"
            );
            return json($res,401);
        }
        // 已登录继续执行请求
        return $next($request);
    }
}
