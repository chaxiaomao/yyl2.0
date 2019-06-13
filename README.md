- php.ini开启intl.ddl

- 导入pdm/common_base_table.sql

- 配置图片上传路径app_image/uploads下面

- 初始化配置文件：win下执行init，linux下执行php yii init

- apache配置rewrite规则，如：
```
# yyl be
<VirtualHost *:80>
    ServerName be-yyl.tunnel.echomod.cn
    DocumentRoot F:\xampp\htdocs\SC\sc_yyl\backend\web
    <Directory "F:\xampp\htdocs\SC\sc_yyl\backend\web">
        Require all granted
        Allow from all
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
    </Directory>
</VirtualHost>
```
6.nginx配置：
```
server
    {
        listen 80;
        #listen [::]:80;
        server_name fe-api.otmk.club ;
        index index.html index.htm index.php default.html default.htm default.php;
        root  /home/wwwroot/ds-dance.otmk.club/frontend/web;

        include other.conf;
        #error_page   404   /404.html;

        # Deny access to PHP files in specific directory
        #location ~ /(wp-content|uploads|wp-includes|images)/.*\.php$ { deny all; }

        include enable-php.conf;

        location / {
        # Redirect everything that isn't a real file to index.php
            if (!-e $request_filename){
              rewrite ^/(.*) /index.php last;
            }
           try_files $uri $uri/ /index.php?$args;
        }

        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
        {
            expires      30d;
        }

        location ~ .*\.(js|css)?$
        {
            expires      12h;
        }

        location ~ /.well-known {
            allow all;
        }

        location ~ /\.
        {
            deny all;
        }

        access_log  /home/wwwlogs/fe-ds.otmk.club.log;
    }
```

- redis用户投票key，缓存一天，格式:vote:{user_id}{player_id}{Y-m-d}