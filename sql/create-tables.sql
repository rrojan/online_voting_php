CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `cit` varchar(32) NOT NULL,
    `password` varchar(32) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4;
CREATE TABLE `party` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(64) NOT NULL,
    `previous_wincount` int(11) NOT NULL DEFAULT 0,
    `logo_url` varchar(447) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `election` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `votes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `party_id` int(11) NOT NULL,
    `election_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (party_id) REFERENCES party(id),
    FOREIGN KEY (election_id) REFERENCES election(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `published_elections` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `election_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (election_id) REFERENCES election(id)
);
