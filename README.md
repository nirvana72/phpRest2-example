# 运行 Run

~~~
git clone https://github.com/nirvana72/phpRest2-example.git
cd phpRest2-example
composer install
~~~

# 目录结构
~~~
项目目录
├── apache                         // docker 安装时的依赖
├── App
│   ├── Controller                 // 控制器目录
│   │   ├── IndexController.php    // 控制器
│   │   └── ...
│   ├── Entity                     // 实体类
│   │   └── ...
│   ├── Event                      // 事件目录
│   │   ├── XXXListener.php        // 事件
│   │   └── ...
│   ├── Exception                  // 异常处理目录
│   │   ├── ExceptionHandler.php   // 自定义异常处理文件
│   │   ├── XXXException.php       // 自定义异常
│   │   └── ...
│   └── Hook                       // 中间件
│       ├── Hook1.php 
│       ├── Hook2.php 
│       └── ...
├── config                        // 配置文件目录
├── logs                          // 日志文件目录
├── public
│   ├── client                    // 简易axios 客户端
│   └── index.php                 // 入口文件
└── .env                          // 环境配置文件
~~~

除了以下两个文件必需，其它都可以不存在
~~~
项目目录
├── App
│   └── Controller                 // 控制器目录
│       └── IndexController.php    // 控制器
└── public                     
    └── index.php                  // 入口文件
~~~

# POSTMAN 测试
~~~
// postman 导入
https://github.com/nirvana72/phpRest2-example/blob/main/postman_collection.json

// postman 设置环境变量 {{domain}}
~~~

# 说明直接看代码
[参数绑定](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/ParamsController.php)

[参数绑定实体类](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/EntityController.php)

[中间件hook](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/HookController.php)

[数据库操作](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/DbController.php)

[ORM](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/OrmController.php)

[文件上传](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/FileUploadController.php)

[事件驱动](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/EventController.php)

[路由信息](https://github.com/nirvana72/phpRest2-example/blob/main/App/Controller/IndexController.php)