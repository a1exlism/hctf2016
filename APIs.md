# API接口文档

后台由CI框架编写, 整合了geetest极验验证码功能(防D).

## Register/Login Page:

1. Register Check(结合geetest)
Request:
Request URL:http://test.com:8000/hctf2016/index/geetest/register_check
Request Method:POST
表单数据:
Teamname:
school:
email:
password:
phone:
(下面是geetest API)
geetest_challenge:a83d26599e8d88bda3ea07f0893e7e18e2
geetest_validate:92b5eef0fd80e968caa0889b3c243af4
geetest_seccode:92b5eef0fd80e968caa0889b3c243af4|jordan


Response:
{
"status": "success",
	"message": "Register success",
	"checksum": "5f64d257d1bcff732ada25ad14c7aef0",
	"to_active": 1
}


2.
