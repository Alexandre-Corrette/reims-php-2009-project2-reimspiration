-- Base de données :  `reimspiration`
--

DROP DATABASE IF EXISTS reimspiration;
CREATE DATABASE reimspiration;

USE reimspiration;


CREATE TABLE categories (
    id INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

INSERT INTO categories (name) VALUES ('MUSEE'), ('CONCERT'), ('THEATRE'), ('CINEMA'), ('EXPOSITION'), ('ARCHITECTURE'), ('LECTURE'), ('ART');

CREATE TABLE ages (
    id INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ranges VARCHAR(50) NOT NULL
);

INSERT INTO ages (ranges) VALUES ('3 à 5 ans'), ('5 à 10 ans'), ('10 à 13 ans'), ('Adolescents'), ('Adultes'), ('Tout public') ;

CREATE TABLE activities (
    id INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    markdown VARCHAR(50) NOT NULL,
    description VARCHAR(250) NOT NULL,
    date_start VARCHAR(10) NOT NULL,
    date_end VARCHAR(10) NOT NULL,
    price TEXT NOT NULL,
    img TEXT NOT NULL,
    link TEXT NOT NULL
);

INSERT INTO activities (markdown, description, date_start, date_end, price, img, link) VALUES (
        'Lorem ipsum dolor sit amet, consectetur efficitur.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vestibulum libero id velit interdum lacinia. Cras rhoncus sapien tellus, eget efficitur turpis vestibulum sed. Aenean consequat elit nunc, et porttitor arcu sagittis at. Nam dictum justo.', '2020-11-24', '2020-11-24', 'Gratuit', '/assets/images/activity-test1.jpg', 'https://www.link1.fr/'), (
        'Activité 2', 'description 2', '2020-11-24', '2020-11-24', 'Payant', '/assets/images/activity-test2.jpg', 'https://www.link2.fr/'), (
        'Activité 3', 'description 3', '2020-11-24', '2020-11-24', 'Gratuit', '/assets/images/activity-test3.jpg', 'https://www.link3.fr/'), (
        'Activité 4', 'description 4', '2020-11-24', '2020-11-24', 'Gratuit', '/assets/images/activity-test4.jpg', 'https://www.link4.fr/'), (
        'Activité 5', 'description 5', '2020-11-24', '2020-11-24', 'Payant', '/assets/images/activity-test5.jpg', 'https://www.link5.fr/'), (
        'Activité 6', 'description 6', '2020-11-24', '2020-11-24', 'Gratuit', '/assets/images/activity-test6.png', 'https://www.link6.fr/'), (
        'Activité 7', 'description 7', '2020-11-24', '2020-11-24', 'Payant', '/assets/images/activity-test7.jpg', 'https://www.link7.fr/'
    );

CREATE TABLE activities_ages (
    activity_id INT unsigned NOT NULL,
    age_id INT unsigned NOT NULL,
    PRIMARY KEY (activity_id, age_id),
    CONSTRAINT FK_ActivitiesAges FOREIGN KEY (activity_id) REFERENCES activities(id) ON DELETE CASCADE,
    CONSTRAINT FK_AgesActivities FOREIGN KEY (age_id) REFERENCES ages(id) ON DELETE CASCADE
);

CREATE TABLE activities_categories (
    activity_id INT unsigned NOT NULL,
    category_id INT unsigned NOT NULL,
    PRIMARY KEY (activity_id, category_id),
    CONSTRAINT FK_ActivitiesCategories FOREIGN KEY (activity_id) REFERENCES activities(id) ON DELETE CASCADE,
    CONSTRAINT FK_CategoriesActivities FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Activité 1--

INSERT INTO activities_categories (activity_id, category_id) VALUES (1, 2);
INSERT INTO activities_categories (activity_id, category_id) VALUES (1, 3);
INSERT INTO activities_ages (activity_id, age_id) VALUES (1, 1);
INSERT INTO activities_ages (activity_id, age_id) VALUES (1, 2);
INSERT INTO activities_ages (activity_id, age_id) VALUES (1, 3);
INSERT INTO activities_ages (activity_id, age_id) VALUES (1, 4);

-- Activité 2--

INSERT INTO activities_categories (activity_id, category_id) VALUES (2, 5);
INSERT INTO activities_ages (activity_id, age_id) VALUES (2, 4);
INSERT INTO activities_ages (activity_id, age_id) VALUES (2, 5);

-- Activité 3--

INSERT INTO activities_categories (activity_id, category_id) VALUES (3, 4);
INSERT INTO activities_ages (activity_id, age_id) VALUES (3, 5);
INSERT INTO activities_ages (activity_id, age_id) VALUES (3, 3);

-- Activité 4--

INSERT INTO activities_categories (activity_id, category_id) VALUES (4, 7);
INSERT INTO activities_ages (activity_id, age_id) VALUES (4, 6);

-- Activité 5--

INSERT INTO activities_categories (activity_id, category_id) VALUES (5, 4);
INSERT INTO activities_categories (activity_id, category_id) VALUES (5, 6);
INSERT INTO activities_categories (activity_id, category_id) VALUES (5, 8);
INSERT INTO activities_ages (activity_id, age_id) VALUES (5, 3);
INSERT INTO activities_ages (activity_id, age_id) VALUES (5, 4);

-- Activité 6--

INSERT INTO activities_categories (activity_id, category_id) VALUES (6, 7);
INSERT INTO activities_ages (activity_id, age_id) VALUES (6, 6);

-- Activité 7--

INSERT INTO activities_categories (activity_id, category_id) VALUES (7, 6);
INSERT INTO activities_categories (activity_id, category_id) VALUES (7, 5);
INSERT INTO activities_ages (activity_id, age_id) VALUES (7, 2);
INSERT INTO activities_ages (activity_id, age_id) VALUES (7, 3);
INSERT INTO activities_ages (activity_id, age_id) VALUES (7, 4);
