# API接口文档

后台由CI框架编写, 整合了geetest极验验证码功能(`防D`).

## Register/Login Page:

### 注册接口(含geetest)[http://test.com:8000/hctf2016/index/geetest/register_check]

Parameters(post):
```json
{
    "teamname": "",
    "school": "",
    "email": "",
    "password": "",
    "phone": "",
        //    下面是geetest接口
    "geetest_challenge": "",
    "geetest_validate": "",
    "geetest_seccode": ""
}
```
Response-success:
```json
{
    "status": "success",	//状态码
    "message": "Register success",	// 前端提示信息
		"checksum": "5f64d257d1bcff732ada25ad14c7aef0",	//	后端二次验证参数
    "to_active": 1	//	是否发送邮件
}
```
Response-error:
```json
{
    "status": "error",	//状态码
    "message": "The email has been taken."	// 前端提示信息
}
```

### 登录接口(含geetest)[http://test.com:8000/hctf2016/index/geetest/verifyLogin]

Parameters(post):
```json
{
    "teamname": "",
    "email": "",
    "password": "",
			//	geetest
    "geetest_challenge": "",
    "geetest_validate": "",
    "geetest_seccode": ""
}
```
Response:
```json
{
    "status": "error",	//	验证结果
    /*"status": "success",*/
    "message": "The sign-in feature is not active yet."
}
```
