
README.MD
===============
## 新建数据库，运行 projectDemo.sql,对应修改 config/database.php 数据库配置

## 内置管理员管理模块
   
   + 管理员列表
        
        + 管理员增加
        + 管理员修改
        + 管理员删除
        
   + 角色管理
        
        + 角色增加
        + 角色修改
        + 角色权限分配
        + 角色删除
        
   + 权限管理
        
        + 增加顶级权限
        + 增加子权限
        + 编辑权限
        + 删除权限
        
## 环境要求配置 thinkphp5.1 

## nginx配置

    server {
        listen       80;
        server_name  ###;
        root   #项目路径\vueadmin\public#;
        location / {
            if (!-e $request_filename) {
                rewrite ^/(.*)$ /index.php/$1;
            }
            index  index.html index.htm index.php;
            #autoindex  on;
        }
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
    }
    
## 新增表  php think bean 表名
    
    生成  application
         ├─common
         │  ├─bean
         │  │  ├─表名Bean.php
         │  ├─enum
         │  │  ├─ 字段名Enum.php 
         │  ├─manage
         │  │  ├─ 表名Manage.php
         │  ├─model
         │  │  ├─ 表名Model.php
         │  ├─validate
         │  │  ├─ 表名Validate.php
         ├─......
         

## 目录结构
    
    projectDemo
    ├─application
    │  ├─common
    │  │  ├─bean                    数据表字段对应bean
    │  │  ├─controller              基础控制器，被继承于各个模块
    │  │  ├─enum                    枚举类，数据表字段tinyint
    │  │  ├─exception               异常统一处理
    │  │  ├─manage                  业务逻辑
    │  │  ├─model                   数据表交互
    │  │  ├─util                    工具类
    │  │  ├─validate                验证类
    │  │  ├─view                    公用视图模板
    │  │  │  ├─layout               公用布局
    │  │  │  ├─widget               公用组件
    │  │  ├─widget                  组件渲染
    │  ├─admin                      示例admin模块
    │  │  ├─controller              控制器
    │  │  ├─view                    视图
    │  ├─......
    ├─config
    │  ├─project.php                系统配置
    │  ├─......
    ├─projectDemo.sql               基础sql
    ├─......
    
    