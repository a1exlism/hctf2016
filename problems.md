1. 静态资源问题 https://segmentfault.com/q/1010000000409427
2. Message: Call to undefined function base_url()
  http://blog.vini123.com/1921.html 
  http://stackoverflow.com/questions/7503302/how-to-get-base-url-in-codeigniter-2
3. class的类名bixu大写开头. 而且类名称必须和php文件名称相同才有效果
 文件名也需要大写 
4. 
类名 class: pages
THEN
静态页面模板位于 application/views/pages/

5. URL:
http://example.com/[controller-class]/[controller-method]/[arguments]

5. URL去除index.php
  1. [apache2开启rewrite](https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite-for-apache-on-ubuntu-14-04)
  2. [urls-codeigniter.org.cn](http://codeigniter.org.cn/user_guide/general/urls.html)
  [A梦](http://ju.outofmemory.cn/entry/221071)

  ```bash
  # sudo vi /etc/apache2/apache2.conf
  <Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride All                                                         
    Require all granted
  </Directory> 
  ```

  ```bash
  # index.php 同目录下 .htaccess
  # 目录结构:
  # /hctf2016
  # -/index.php
  # -/.htaccess
  # -/assets
  #   -/imgs
  #   -/css
  #   -/js
  # -/application/
  # -/system/
  RewriteEngine on
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond $1 !^(index\.php|images|assets|robots\.txt|$)
  RewriteRule ^(.*)$ /hctf2016/index.php/$1 [L] 
  ```

6. [php双入口重写规则(apache2)](https://segmentfault.com/q/1010000002491453)
嗯... 发现.htaccess规则理解错误, 左边应该是origin.
>[Apache Rewrite规则详解](http://lijichao.blog.51cto.com/67487/157731)
RewriteRule ^/(.*) http://www.xxx.com/ [L]
// 含义是如果Client请求的主机中的前缀符合上述条件，则直接进行跳转到http://www.xxx.com/,
[L]意味着立即停止重写操作，并不再应用其他重写规则.

7. github 远程版本回退:
[一介布衣](http://yijiebuyi.com/blog/8f985d539566d0bf3b804df6be4e0c90.html)
[小胡子哥](http://www.barretlee.com/blog/2014/04/28/git-roll-back/)

8. 多入口按照需求重新改了, refer: https://segmentfault.com/q/1010000002491453