# hctf_platform_2016
CI framework


## Controller命名规范
### -controller
首字母必须大写
用户界面以`I_`为前缀
管理员界面以`A_`为前缀

### .htaccess重写规则
```bash
RewriteRule ^i_(.*)$ /hctf2016/index.php/$1 [L] 
RewriteRule ^a_(.*)$ /hctf2016/adm1n.php/$1 [L] 
```

### 类名
和文件名相同(大小写一致)
