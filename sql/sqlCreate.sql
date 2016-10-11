/* -- Create DataBase -- */
CREATE DATABASE hctf2016;
-- USE hctf2016;

/* -- Team Info -- */
CREATE TABLE hctf2016.team_info (
	team_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  team_email VARCHAR (40) NOT NULL ,
  team_name VARCHAR(40) NOT NULL ,
  team_pass VARCHAR(40) NOT NULL,
	team_school VARCHAR(20) NOT NULL ,
	team_phone INT(12) UNSIGNED NOT NULL ,
	team_token VARCHAR(40) NOT NULL ,
  is_expand BOOL NOT NULL ,
  -- 是否可以开题
  total_score INT NOT NULL ,
  compet_level INT UNSIGNED NOT NULL ,
  -- 可挑战层数
  is_cheat BOOL NOT NULL
);

/* -- Challenge Info -- */
CREATE TABLE hctf2016.challenge_info (
  challenge_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  challenge_score INT UNSIGNED NOT NULL ,
  challenge_description VARCHAR(200) NOT NULL ,
  challenge_hit VARCHAR(100) ,
  challenge_level INT UNSIGNED NOT NULL ,
  -- 开题层数
  challenge_api VARCHAR(40),
  challenge_threshold INT(12) UNSIGNED NOT NULL
  -- api 为多flag接口
);

/* -- Dynamic Notify -- */
CREATE TABLE hctf2016.dynamic_notify (
  notify_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  team_token VARCHAR(40) NOT NULL ,
  challenge_id INT UNSIGNED NOT NULL ,
  challenge_open_time INT NOT NULL ,
  challenge_solved_time INT ,
  -- 解题时间
  challenge_flag VARCHAR(50)
  -- flag 和 team_token 验重
);

/* -- Bulletin 公告 -- */
CREATE TABLE hctf2016.bulletin (
  bulletin_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  bulletin_message VARCHAR(200) NOT NULL
);


/* -- Card Info 道具卡 -- */
CREATE TABLE hctf2016.card_info (
  card_id INT NOT NULL AUTO_INCREMENT ,
  team_token VARCHAR(40) NOT NULL
);

/*管理员*/
CREATE TABLE hctf2016.admin_qwe(
  user VARCHAR(40) NOT NULL  PRIMARY KEY,
  pass VARCHAR(40) NOT NULL,
  `key`  VARCHAR(40) NOT NULL
);
