CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cit` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO user (`id`, `cit`, `password`) VALUES (NULL, 'admin', 'password');
INSERT INTO user (`id`, `cit`, `password`) VALUES (NULL, '1234', 'password');
INSERT INTO user (`id`, `cit`, `password`) VALUES (NULL, '2345', 'password');
INSERT INTO user (`id`, `cit`, `password`) VALUES (NULL, '3456', 'password');
INSERT INTO user (`id`, `cit`, `password`) VALUES (NULL, '4567', 'password');


CREATE TABLE `party` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `previous_wincount` int(11) NOT NULL DEFAULT 0,
  `logo_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `party` (`id`, `name`, `previous_wincount`, `logo_url`) 
VALUES (
    NULL, 
    'Nepali Congress (NC)',
    0,
    'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Nepali_Congress_flag.svg/1200px-Nepali_Congress_flag.svg.png'
);
INSERT INTO `party` (`id`, `name`, `previous_wincount`, `logo_url`) 
VALUES (
    NULL, 
    'CPN United Marxist Lenninist(UML)',
    0,
    'https://scontent.fktm3-1.fna.fbcdn.net/v/t39.30808-6/278565224_531880808301148_2759272606035147234_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=W-1phBQETB0AX-mRTk6&_nc_ht=scontent.fktm3-1.fna&oh=00_AT8UqCp_4ZFG0pejI1zUnAcwFJt9rCz5Ch6_IAkaQTgccQ&oe=62FCA9E0'
);
INSERT INTO `party` (`id`, `name`, `previous_wincount`, `logo_url`) 
VALUES (
    NULL, 
    'CPN Unified Socialist',
    0,
    'https://web.nepalnews.com/storage/story/1200/CPN1629801402_1200.jpg'
);


CREATE TABLE `election` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `election` (`id`, `name`) 
VALUES (
    NULL, 
    'National Election 2022'
);
INSERT INTO `election` (`id`, `name`) 
VALUES (
    NULL, 
    'Bagmati Regional Election 2022'
);


CREATE TABLE `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `party_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (party_id) REFERENCES party(id),
  FOREIGN KEY (election_id) REFERENCES election(id),
  FOREIGN KEY (user_id) REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `votes` (`id`, `party_id`, `election_id`, `user_id`) 
VALUES (
    NULL, 
    1,
    1,
    11
);
INSERT INTO `votes` (`id`, `party_id`, `election_id`, `user_id`) 
VALUES (
    NULL, 
    1,
    1,
    12
);
INSERT INTO `votes` (`id`, `party_id`, `election_id`, `user_id`) 
VALUES (
    NULL, 
    2,
    1,
    13
);
INSERT INTO `votes` (`id`, `party_id`, `election_id`, `user_id`) 
VALUES (
    NULL, 
    1,
    2,
    11
);
INSERT INTO `votes` (`id`, `party_id`, `election_id`, `user_id`) 
VALUES (
    NULL, 
    1,
    2,
    12
);
INSERT INTO `votes` (`id`, `party_id`, `election_id`, `user_id`) 
VALUES (
    NULL, 
    2,
    2,
    13
);