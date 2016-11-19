# API接口文档

后台由CI框架编写, 整合了geetest极验验证码功能(`防D`).

## Register/Login Page:

### 注册接口(含geetest)[http://test.com:8000/hctf2016/index/geetest/register_check]
type: `post` <br>
Parameters:
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

### 注册激活接口[http://115.159.26.130:8000/hctf2016/index/active/mail_check]
type: `post` <br>
Parameters:
```json
{
  "query":"428f3f11602cfeeaaa91dbf514a3a65f"  //  邮件激活checksum
}
```
Response-success:
```json
{
  "status" : "success",
  "message" : "Welcome to HCTF: a1exlism"
}
```
Response-error:
```json
{
    "status": "error_0",
    "message": "No such team"
}
```
**checksum说明**
checksum来自激活邮件, 例如: [http://test.com:8000/hctf2016/index/active/mail/428f3f1e602cfbe1aa91dbf514a3a65f]
最后一段就是`checksum`, 所以需要对url进行解析之后ajax调用这段checksum进行校验

### 登录接口(含geetest)[http://test.com:8000/hctf2016/index/geetest/verifyLogin]

type: `post` <br>
Parameters:
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
Response-success:
```json
{
    "status": "success",
    "message": "Login success"
}
```
Response-error:
```json
```json
{
    "status": "error",
    "message": "The sign-in feature is not active yet."
}
```

## Password-forget[http://test.com:8000/hctf2016/index/geetest/mail_check]
type: `post` <br>
Parameters:
```json
{
  "email": "a1exlism@gmail.com",
  //  geetest 第三方
  "geetest_challenge": "",
  "geetest_validate": "",
  "geetest_seccode": ""
}
```
Response-success:
```json
{
    "status": "success",
    "checksum": "579ee5552681bbb6b85d9c995c67533e"  //校验码 成功之后发送check邮件(前端无需再写逻辑)
}
```
Response-error1:
```json
{
  "status" : "error",
  "message" : "No such team"
}
```
Response-error2:
```json
{
  "status" : "error",
  "message" : "Email empty || Invalid email"
}
```

## Team-dashboard

### Logout[http://test.com:8000/hctf2016/index/team/logout]
Session: Destoried

### self-team's challenges-solved[http://test.com:8000/hctf2016/index/team_ajax/get_solved]

type: `get` <br>
refresh: 60s更新一次 <br>
Response:
```json
[{
    "chaName": "test",
    "chaType": "pwn",
    "chaScore": "381",
    "chaLevel": "1",
    "solvedNum": "12",
    "solvedTime": "11:19:15 11-19-2016"
}, {
    "chaName": "test2",
    "chaType": "misc",
    "chaScore": "400",
    "chaLevel": "1",
    "solvedNum": "2",
    "solvedTime": "11:30:15 11-19-2016"
}]
```

### team-name[http://test.com:8000/hctf2016/index/team_ajax/get_teamname]
type: `get` <br>
Response:
```json
'a1exlism'  //  队伍名
```

###  team-info[http://test.com:8000/hctf2016/index/team_ajax/get_team_info]
type: `get` <br>
refresh: 60s更新一次 <br>
Response:
```json
{
    "level": "1", //  所在层数
    "score": "381", //  总分
    "ranking": 5, //  当前排名(算上作弊人数)
    "token": "ae92c0f32cfab7aadbe31ecf57e2996d" //  team唯一token
}
```

### pass-change[http://test.com:8000/hctf2016/index/team_ajax/pass_change]
type: `post` <br>
Parameters:
```json
{
    "ori_pass": "oriPass",
    "new_pass": "newPass"
}
```
Redirect-to: hctf2016/index/login <br>
Session: destoried. <br>
Response-success:
```json
{
  "status": "success"
}
```
Response-fail:
```json
{
  "status": "fail"
}
```

### 公告栏bulletin[http://test.com:8000/hctf2016/index/team_ajax/get_bulletin]
type: `post` <br>
refresh: 60s更新一次 <br>
Parameters:
```json
{
  "num" : 3 //  num为空则获取全部
}
```
Response:
```json
[{
    "bulletin_id": "2",
    "bulletin_message": "\u516c\u544a2",
    "create_time": "2016-11-19 12:03:47",
    "update_time": "2016-11-19 12:03:47"
}, {
    "bulletin_id": "1",
    "bulletin_message": "\u516c\u544a1",
    "create_time": "2016-11-19 12:03:43",
    "update_time": "2016-11-19 12:03:43"
}]
```

## Challenge-Page
### get-top-10[http://test.com:8000/hctf2016/index/team_ajax/get_ranks/参数num]
type: `get` <br>
refresh: 60s更新一次 <br>
Parameters:
```js
获取`num`条排名
参数请看url, num为空则`获取所有`
```
Response:
```json
[{
    "team_name": "hax",
    "total_score": "699"
}, {
    "team_name": "9s",
    "total_score": "417"
}, {
    "team_name": "xian",
    "total_score": "417"
}, {
    "team_name": "team",
    "total_score": "417"
}, {
    "team_name": "asz",
    "total_score": "417"
}, {
    "team_name": "a1exlism",
    "total_score": "381"
}, {
    "team_name": "a1exl",
    "total_score": "381"
}, {
    "team_name": "liux",
    "total_score": "381"
}, {
    "team_name": "sj12",
    "total_score": "381"
}, {
    "team_name": "lwnx",
    "total_score": "366"
}]
```

### get-solved-public[http://test.com:8000/hctf2016/index/team_ajax/get_solved_public]
type: `get` <br>
refresh: 60s更新一次 <br>
Response;
```json
[{
    "chaName": "test",
    "solvedTime": "11:19:15 11-19-2016",
    "teamName": "sj12"
}, {
    "chaName": "test",
    "solvedTime": "11:19:15 11-19-2016",
    "teamName": "a1exl"
}, {
    "chaName": "test",
    "solvedTime": "11:19:15 11-19-2016",
    "teamName": "liux"
}, {
    "chaName": "test",
    "solvedTime": "11:19:15 11-19-2016",
    "teamName": "a1exlism"
}]
```

### get-solved[http://test.com:8000/hctf2016/index/Team_ajax/get_solved]
type: `get` <br>
refresh: 每次flag提交进行刷新 <br>
Response:
```json
[{
    "chaName": "test2",
    "chaType": "misc",
    "chaScore": "600",
    "chaLevel": "1",
    "solvedNum": "1",
    "solvedTime": "12:16:51 11-19-2016"
}, {
    "chaName": "test",
    "chaType": "pwn",
    "chaScore": "381",
    "chaLevel": "1",
    "solvedNum": "12",
    "solvedTime": "11:19:15 11-19-2016"
}]
```

### get-challenge[http://test.com:8000/hctf2016/index/team_ajax/get_challenges]
type: `get` <br>
refresh: 每次flag提交进行刷新 <br>
`URL`: 需要从challenge_description中提取出来组合成url
Response:
```json
[{
    "challenge_id": "1",
    "challenge_name": "test",
    "challenge_type": "pwn",
    "challenge_score": "381",
    "challenge_description": "\u9898\u76ee\u8bf7\u5728\u8fd9\u8fb9\u4e0b\u8f7d:[http:\/\/www.google.com]",  //题目描述
    "challenge_hit": "hint_pwn",  //  是hit字段作为提示
    "challenge_level": "1", //  题目level
    "challenge_solves": "12", //  题目解决队伍数量
    "challenge_api": null,  //  多flag API
    "challenge_threshold": "0", //  时间阈值
    "multi_file": "1" //  多文件状态
}, {
    "challenge_id": "2",
    "challenge_name": "test2",
    "challenge_type": "misc",
    "challenge_score": "600",
    "challenge_description": "\u9898\u76ee\u8bf7\u5728\u8fd9\u8fb9\u4e0b\u8f7d:[http:\/\/www.baidu.com]",
    "challenge_hit": "hint_misc",
    "challenge_level": "1",
    "challenge_solves": "1",
    "challenge_api": null,
    "challenge_threshold": "0",
    "multi_file": "0"
}, {
    "challenge_id": "3",
    "challenge_name": "test3",
    "challenge_type": "pwn",
    "challenge_score": "100",
    "challenge_description": "Click Here [http:\/\/baidu.com]",
    "challenge_hit": "",
    "challenge_level": "1",
    "challenge_solves": "0",
    "challenge_api": null,
    "challenge_threshold": "0",
    "multi_file": "0"
}]
```

#### **注意** 针对于multi_file类型的challenge
获取多文件的文件名[http://test.com:8000/hctf2016/index/team_ajax/get_filename/参数chaID] <br>
type: `get` <br>
Response:
```json
{
    "file_name": "FILE1"
}
```
从而生成文件下载地址: 前面的URL+这边的file_name

## Ranking-Page

### Ranking-Graph
原前端采用的Echart

### gete-top10[http://test.com:8000/hctf2016/index/Team_ajax/get_top10]
type: `get` <br>
Response:
```json
[{
    "team_name": "a1exlism",
    "score_a": "0",
    "score_b": "0",
    "score_c": "0",
    "score_d": "0",
    "score_e": "981",
    "total_score": "981"
    //  所有score均会在提交flag之后进行数据前移, total_score取得是当前队伍分数
},{

	....省略8组
},{
    "team_name": "hex",
    "score_a": "0",
    "score_b": "0",
    "score_c": "0",
    "score_d": "0",
    "score_e": "0",
    "total_score": "0"
}]
```
### Pagenation

#### **用的前端分页**

#### 获取非作弊队伍数[http://test.com:8000/hctf2016/index/Team_ajax/get_ranks_nums]
type: `get` <br>
Response:
```json
{
    "nums": 22
}
```

#### 获取10个非作弊队伍的降序排名数据[http://test.com:8000/hctf2016/index/Team_ajax/get_ranks10/参数num]
type: `get` <br>
Parameter: num默认写0, 表示获取前10名队伍数据<br>
例如: num为10, 则获取11-20名的队伍信息  <br>
OrderBy: total_score 降序 score_update 升序
Response:
```json
[{
    "team_name": "a1exlism",
    "total_score": "981"
},{
    //  省略8组
},{
    "team_name": "lwnx",
    "total_score": "366"
}]
```
