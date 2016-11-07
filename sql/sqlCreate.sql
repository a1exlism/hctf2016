/* -- Create DataBase -- */
-- CREATE DATABASE hctf2016;
SET NAMES "utf8";

-- USE hctf2016;

/* -- Team Info -- */
CREATE TABLE hctf2016.team_info (
  team_id      INT UNSIGNED     NOT NULL AUTO_INCREMENT PRIMARY KEY,
  team_email   VARCHAR(40)      NOT NULL,
  team_name    VARCHAR(40)      NOT NULL,
  team_pass    VARCHAR(40)      NOT NULL,
  team_school  VARCHAR(20)      NOT NULL,
  team_phone   INT(12) UNSIGNED NOT NULL,
  team_token   VARCHAR(40)      NOT NULL,
  is_expand    BOOL             NOT NULL DEFAULT 0,
  -- 是否可以开题
  total_score  INT              NOT NULL DEFAULT 0,
  compet_level INT UNSIGNED     NOT NULL DEFAULT 1,
  -- 可挑战层数
  is_cheat     BOOL             NOT NULL DEFAULT 0
)
  CHARACTER SET = utf8;

/* -- Challenge Info -- */
CREATE TABLE hctf2016.challenge_info (
  challenge_id          INT UNSIGNED     NOT NULL AUTO_INCREMENT PRIMARY KEY,
  challenge_name        VARCHAR(40)      NOT NULL,
  challenge_type        VARCHAR(20)      NOT NULL,
  challenge_score       INT UNSIGNED     NOT NULL,
  challenge_description VARCHAR(300)     NOT NULL,
  challenge_hit         VARCHAR(100),
  challenge_level       INT UNSIGNED     NOT NULL,
  -- 开题层数
  challenge_solves      INT UNSIGNED              DEFAULT 0,
  challenge_api         VARCHAR(40),
  challenge_threshold   INT(12) UNSIGNED NOT NULL
  -- api 为多flag接口
)
  CHARACTER SET = utf8;

/* -- Dynamic Notify -- */
CREATE TABLE hctf2016.dynamic_notify (
  notify_id             INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  team_token            VARCHAR(40)  NOT NULL,
  challenge_id          INT UNSIGNED NOT NULL,
  challenge_open_time   INT          NOT NULL,
  challenge_solved_time INT,
  -- 解题时间
  challenge_flag        VARCHAR(50)
  -- flag 和 team_token 验重
)
  CHARACTER SET = utf8;

/* -- Scores Record -- */
CREATE TABLE hctf2016.score_record (
  team_name   VARCHAR(40) NOT NULL,
  team_token  VARCHAR(40) NOT NULL,
  score_a     INT         NOT NULL DEFAULT 0,
  time_a      VARCHAR(40) ,
  score_b     INT         NOT NULL DEFAULT 0,
  time_b      VARCHAR(40) ,
  score_c     INT         NOT NULL DEFAULT 0,
  time_c      VARCHAR(40) ,
  score_d     INT         NOT NULL DEFAULT 0,
  time_d      VARCHAR(40) ,
  score_e     INT         NOT NULL DEFAULT 0,
  time_e      VARCHAR(40) ,
  score_f     INT         NOT NULL DEFAULT 0,
  time_f      VARCHAR(40) ,
  total_score INT         NOT NULL DEFAULT 0
)
 CHARACTER SET = utf8;

/* -- Bulletin 公告 -- */
CREATE TABLE hctf2016.bulletin (
  bulletin_id      INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
  bulletin_message VARCHAR(200) NOT NULL,
  create_time      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  update_time      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  --  5.6.5 or higher
)
  CHARACTER SET = utf8;


/* -- Card Info 道具卡 -- */
CREATE TABLE hctf2016.card_info (
  card_id    INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
  team_token VARCHAR(40) NOT NULL
)
  CHARACTER SET = utf8;

/*管理员*/
CREATE TABLE hctf2016.admin_qwe (
  user  VARCHAR(40) NOT NULL  PRIMARY KEY,
  pass  VARCHAR(40) NOT NULL,
  `key` VARCHAR(40) NOT NULL
)
  CHARACTER SET = utf8;

