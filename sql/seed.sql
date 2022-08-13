INSERT INTO user (`id`, `cit`, `password`)
VALUES (NULL, 'admin', 'password'); -- admin user
INSERT INTO user (`id`, `cit`, `password`)
VALUES (NULL, '1234', 'password');
INSERT INTO user (`id`, `cit`, `password`)
VALUES (NULL, '2345', 'password');
INSERT INTO user (`id`, `cit`, `password`)
VALUES (NULL, '3456', 'password');
INSERT INTO user (`id`, `cit`, `password`)
VALUES (NULL, '4567', 'password');
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
INSERT INTO `election` (`id`, `name`)
VALUES (NULL, 'National Election 2022');
INSERT INTO `election` (`id`, `name`)
VALUES (
        NULL,
        'Bagmati Regional Election 2022'
    );
