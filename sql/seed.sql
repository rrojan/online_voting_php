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
        'Kukhura Party',
        0,
        'https://picsum.photos/536/354'
    );
INSERT INTO `party` (`id`, `name`, `previous_wincount`, `logo_url`)
VALUES (
        NULL,
        'Bakhra Party',
        0,
        'https://picsum.photos/536/354'
    );
INSERT INTO `party` (`id`, `name`, `previous_wincount`, `logo_url`)
VALUES (
        NULL,
        'Gaibastu Party',
        0,
        'https://picsum.photos/536/354'
    );
INSERT INTO `election` (`id`, `name`)
VALUES (NULL, 'National Election 2022');
INSERT INTO `election` (`id`, `name`)
VALUES (
        NULL,
        'Bagmati Regional Election 2022'
    );
