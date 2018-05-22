<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */

    // 全局中间件，最先调用
    protected $middleware = [
        // 检测是否应用进入 维护模式
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        // 检测请求的数据是否过大
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // 检测对体检的请求参数进行php函数 trim 处理
        \App\Http\Middleware\TrimStrings::class,
        // 将提交请求参数中空字串转换为null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        // 修正代理服务器后的服务器参数
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */

    // 定义中间件
    protected $middlewareGroups = [
        // web中间件，应用于routes/web.php 路由文件
        'web' => [
            // cookie假面解密
            \App\Http\Middleware\EncryptCookies::class,
            // 将cookie添加到响应中
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // 开启会话
            \Illuminate\Session\Middleware\StartSession::class,
            // 认证用户，次中间件，以后auth类才能生效
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            // 将系统的错误数据注入到视图变量errors
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // 检验crsf 防止跨站请求伪造的安全威胁
            \App\Http\Middleware\VerifyCsrfToken::class,
            // 处理路由绑定
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // 记录用户最后活跃时间
            \App\Http\Middleware\RecordLastActivedTime::class,
        ],

        // api中间件，应用于routes/api.php 路由文件
        'api' => [
            // 使用别名来调用中间件
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    //  中间件别名设置，允许你使用别名来调用中间件
    protected $routeMiddleware = [
        // 只用登录用户才能访问
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        // http auth认证
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        // 处理路由绑定
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // 用户授权功能
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        // 只有游客能访问，在 register 和 login 请求中使用，只有未登录用户才能访问这些页面
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // 访问节流，类似于  一分钟只能请求10次
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
