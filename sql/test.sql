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


-- score_record
INSERT INTO `score_record` (`team_name`, `team_token`, `score_a`, `score_b`, `score_c`, `score_d`, `score_e`, `total_score`) VALUES
  ('team', '6d052931f952bca7a195b417c4871f0a', '0', '50', '100', '200', '300', '600'),
  ('PPP', 'c9c3d446625390fa20a54d99237c403b', '0', '100', '200', '500', '800', '1300'),
  ('LC↯BC', '909f3ce9daaffabfa7da39991f517640', '0', '150', '200', '400', '800', '1200'),
  ('Cykorkinesis', 'cbea5c320302bff7a6e0fa5301602e07', '0', '250', '400', '600', '900', '1100');