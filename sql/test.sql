USE hctf2016;
INSERT INTO dynamic_notify VALUES
  (NULL , '6d052931f952bca7a195b417c4871f0a', 1, 1477532142, 1477532166, '{hctf:wlecome}'),
  (NULL , '6d052931f952bca7a195b417c4871f0a', 2, 1477532000, 1477532144, '{hctf:prob2}'),
  (NULL , 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 3, 1477532088, 1477542122, '{hctf:prob3}');

INSERT INTO `challenge_info` (`challenge_id`, `challenge_name`, `challenge_type`, `challenge_score`, `challenge_description`, `challenge_hit`, `challenge_level`, `challenge_solves`, `challenge_api`, `challenge_threshold`) VALUES
  (1, 'welcome', 'reverse', 100, 'challenge_1', 'hit1', 1, 0, 'api', 1),
  (2, 'hello', 'web', 200, 'challenge_2', 'hit2', 1, 0, 'api2', 1),
  (3, 'copy', 'misc', 100, 'challenge_1', 'hit1', 1, 0, 'api', 1),
  (4, 'getMe', 'pwn', 200, 'challenge_2', 'hit2', 1, 0, 'api2', 1);