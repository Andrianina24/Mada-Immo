CREATE DATABASE mada_immo;
USE mada_immo;

CREATE TABLE `Proprietaire`(
    `id_proprietaire` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `numero` INTEGER
);

CREATE TABLE `Client`(
    `id_client` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `mail` VARCHAR(50)
);

CREATE TABLE `Type_bien`(
    `id_type_bien` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom` VARCHAR(50),
    `commission` DOUBLE
);

CREATE TABLE `Bien`(
    `id_bien` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `reference` VARCHAR(50),
    `nom` VARCHAR(50),
    `descri` VARCHAR(500),
    `region` VARCHAR(50),
    `loyer` INTEGER,
    `photos` VARCHAR(50),
    `id_type_bien` INTEGER,
    `id_proprietaire` INTEGER,
    FOREIGN KEY ( `id_proprietaire`) REFERENCES `Proprietaire`( `id_proprietaire`),
    FOREIGN KEY ( `id_type_bien`) REFERENCES `Type_bien`( `id_type_bien`)
);

CREATE TABLE `Location`(
    `id_location` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `reference` VARCHAR(50),
    `id_client` INTEGER,
    `date_deb` DATE,
    `duree` INTEGER,
    FOREIGN KEY ( `id_client`) REFERENCES `client`( `id_client`)
);

CREATE TABLE `Loyer_mois` (
    `id_loyer_mois` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `id_location` INTEGER,
    `reference` VARCHAR(50),
    `loyer` INTEGER,
    `commission` DOUBLE,
    `valeur_commission` DOUBLE,
    `id_client` INTEGER,
    `date` DATE,
    FOREIGN KEY (`id_location`) REFERENCES `Location`(`id_location`),
    FOREIGN KEY ( `id_client`) REFERENCES `client`( `id_client`)
);

INSERT INTO `Proprietaire`(`id_proprietaire`,`numero`) VALUES (NULL,034000000);
INSERT INTO `Proprietaire`(`id_proprietaire`,`numero`) VALUES (NULL,032222222);
INSERT INTO `Proprietaire`(`id_proprietaire`,`numero`) VALUES (NULL,0335555555);

INSERT INTO `Client`(`id_client`,`mail`) VALUES (NULL,'soa@gmail.com');
INSERT INTO `Client`(`id_client`,`mail`) VALUES (NULL,'tiana@gmail.com');
INSERT INTO `Client`(`id_client`,`mail`) VALUES (NULL,'riana@gmail.com');

INSERT INTO `Type_bien`(`id_type_bien`,`nom`,`commission`) VALUES (NULL,'Appartement',25);
INSERT INTO `Type_bien`(`id_type_bien`,`nom`,`commission`) VALUES (NULL,'Maison',12);
INSERT INTO `Type_bien`(`id_type_bien`,`nom`,`commission`) VALUES (NULL,'Studio',50);
INSERT INTO `Type_bien`(`id_type_bien`,`nom`,`commission`) VALUES (NULL,'Villa',5);

INSERT INTO `Bien`(`id_bien`,`reference`,`nom`,`descri`,`region`,`loyer`,`photos`, `id_type_bien`,`id_proprietaire`) VALUES (NULL,'V101','Maison de Campagne', 'Maison ancienne rénovée avec grand terrain', 'Talatamaty', 1500, 'img/maison.jpg', 2,1);
INSERT INTO `Bien`(`id_bien`,`reference`,`nom`,`descri`,`region`,`loyer`,`photos`,`id_type_bien`,`id_proprietaire`) VALUES (NULL,'V200','Studio Moderne', 'Studio rénové, idéal pour étudiant, proche des transports', 'Andoharanofotsy', 400, 'img/studio.jpg',3,2);
INSERT INTO `Bien`(`id_bien`,`reference`,`nom`,`descri`,`region`,`loyer`,`photos`,`id_type_bien`,`id_proprietaire`) VALUES (NULL,'G50','Villa de Luxe', 'Villa 6 chambres avec piscine et vue sur mer', 'Ivato', 5000, 'img/villa.jpg',4,3);
INSERT INTO `Bien`(`id_bien`,`reference`,`nom`,`descri`,`region`,`loyer`,`photos`,`id_type_bien`,`id_proprietaire`) VALUES (NULL,'A003','Appartement Centre-Ville', 'Appartement 1 chambre, très bien situé', 'Analakely', 250, 'img/appartement.jpg',1,2);

INSERT INTO `Location`(`id_location`,`reference`,`id_client`,`date_deb`,`duree`) VALUES (NULL,'V101',1,'2024-06-29',3);
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (1,'V101',1,'2024-06-29');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (1,'V101',1,'2024-07-29');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (1,'V101',1,'2024-08-29');


INSERT INTO `Location`(`id_location`,`reference`,`id_client`,`date_deb`,`duree`) VALUES (NULL,'V200',2,'2024-06-01',4);
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (2,'V200',2,'2024-06-01');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (2,'V200',2,'2024-07-01');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (2,'V200',2,'2024-08-01');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (2,'V200',2,'2024-09-01');

INSERT INTO `Location`(`id_location`,`reference`,`id_client`,`date_deb`,`duree`) VALUES (NULL,'V101',1,'2024-06-29',6);
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (3,'V101',1,'2024-06-29');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (3,'V101',1,'2024-07-29');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (3,'V101',1,'2024-08-29');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (3,'V101',1,'2024-09-29');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (3,'V101',1,'2024-10-29');
INSERT INTO `Loyer_mois`(`id_location`,`reference`,`id_client`,`date`) VALUES (3,'V101',1,'2024-11-29');

--mdp:andrianina
INSERT INTO `users` VALUES(1,'Andrianina','andrianina85@gmail.com',null,'$2y$10$I9nVp7XITGG9H8PHVW3r6uVn12tiFbPARCv/M45UKBkBXGS0gQVda',null,'2024-06-29 11:57:23','2024-06-29 11:57:23');

TIMESTAMPDIFF(MONTH, '2024-01-01', '2024-06-01')

CREATE OR REPLACE view v_loyer_mois as
SELECT lm.id_location,b.id_bien,lm.id_client,DATE_FORMAT(lm.date, "%Y-%m") as month,MONTHNAME(lm.date) as month_name,
    CASE 
        WHEN lm.date = (SELECT MIN(date) FROM Loyer_mois lm2 WHERE lm2.id_location = lm.id_location) 
        THEN 1 
        ELSE 0 
    END AS is_first_month,
    CASE 
        WHEN lm.date = (SELECT MIN(date) FROM Loyer_mois lm2 WHERE lm2.id_location = lm.id_location) 
        THEN b.loyer * 2 
        ELSE b.loyer 
    END AS loyer
    FROM Loyer_mois lm
    JOIN Bien b
    ON lm.reference=b.reference
    ;

select *,sum(loyer) as chiffre 
        from Loyer_mois where DATE_FORMAT(date, "%Y-%m") between DATE_FORMAT('2024-01-01', "%Y-%m") and DATE_FORMAT('2024-12-01', "%Y-%m") group by DATE_FORMAT(date, "%Y-%m");

select *, sum(valeur_commission) as gain 
        from Loyer_mois where DATE_FORMAT(date, "%Y-%m") between DATE_FORMAT('2024-01-01', "%Y-%m") and DATE_FORMAT('2024-12-01', "%Y-%m") group by DATE_FORMAT(date, "%Y-%m");

select id_client,DATE_FORMAT(date, "%Y-%m") as month,MONTHNAME(date) as month_name,sum(loyer) as loyer from Loyer_mois 
            where id_client= 1 and DATE_FORMAT(date, "%Y-%m") between DATE_FORMAT('2024-01-01', "%Y-%m") and DATE_FORMAT('2024-12-01', "%Y-%m") group by month

SELECT (SUM(l.loyer) - SUM(l.valeur_commission)) as chiffre
                from Loyer_mois l JOIN Bien b on l.reference=b.reference 
                where DATE_FORMAT(l.date, "%Y-%m") between DATE_FORMAT('2024-01-01', "%Y-%m") and DATE_FORMAT('2024-12-01', "%Y-%m") and b.id_proprietaire= 1


CREATE TABLE `import_bien`(
    `reference` VARCHAR(50),
    `nom` VARCHAR(50),
    `description` VARCHAR(500),
    `type` VARCHAR(50),
    `region` VARCHAR(50),
    `loyer` INTEGER,
    `proprietaire` INTEGER
);

CREATE TABLE `import_location`(
    `reference` VARCHAR(50),
    `date_debut` DATE,
    `duree_mois` INTEGER,
    `client` VARCHAR(50)
);

CREATE TABLE `import_commission`(
    `type` VARCHAR(50),
    `commission` FLOAT
);

select b.*,MAX(l.date) as disponible
        from Bien b join loyer_mois l on b.reference=l.reference where id_proprietaire=1 group by b.reference;


















create or replace view v_location as 
select *, DATE_ADD(date_deb, INTERVAL duree MONTH) AS date_fin from location;

create or replace view v_loyer_mois as 
WITH monthly_rentals AS (
    SELECT l.id_location, l.id_bien, l.id_client, b.loyer, l.date_deb, l.date_fin, 
           TIMESTAMPDIFF(MONTH, l.date_deb, l.date_fin) + 1 AS month_count
    FROM v_location l
    JOIN Bien b ON l.id_bien = b.id_bien
),
expanded_rentals AS (
    SELECT id_location, id_bien, id_client, loyer, 
           DATE_FORMAT(DATE_ADD(date_deb, INTERVAL seq MONTH), '%Y-%m') AS month, 
           MONTHNAME(DATE_ADD(date_deb, INTERVAL seq MONTH)) AS month_name,
           seq = 0 AS is_first_month
    FROM monthly_rentals,
         (SELECT 0 AS seq UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 
          UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 
          UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) seq
    WHERE seq < month_count
)
SELECT id_location, id_bien, id_client, month, month_name, 
       CASE WHEN is_first_month THEN loyer * 2 ELSE loyer END AS loyer
FROM expanded_rentals
ORDER BY id_location, month;

--chiffre d'affaire par mois
select *,sum(loyer) as chiffre from v_loyer_mois group by month;

create or replace view v_gain_location as 
SELECT v.*, 
       CASE 
           WHEN v.is_first_month THEN v.loyer / 2 
           ELSE (v.loyer * t.commission) / 100 
       END AS gain
FROM v_loyer_mois v
JOIN Bien b ON v.id_bien = b.id_bien
JOIN Type_bien t ON t.id_type_bien = b.id_type_bien;

--gain par mois
select id_location,id_bien,month,loyer,sum(gain) as gain from v_gain_location group by month;

select sum(v.loyer) as chiffre 
        from v_loyer_mois v 
        join Bien b
        on v.id_bien=b.id_bien
        join Proprietaire p
        on b.id_proprietaire=p.id_proprietaire
        where month between '2024-01-01' and '2024-12-01' and b.id_proprietaire=1;


SELECT (SUM(v.loyer)-((v.loyer*t.commission)/100)) AS chiffre 
        FROM v_loyer_mois v 
        JOIN Bien b ON v.id_bien = b.id_bien
        JOIN Type_bien t ON b.id_type_bien = t.id_type_bien
        where month between '2024-01-01' and '2024-12-01' and b.id_proprietaire=1;

select *, sum(gain) as gain 
            from v_gain_location where month between DATE_FORMAT(?, '%Y-%m') and DATE_FORMAT(?, '%Y-%m') group by month
        
        
select *, sum(gain) as gain 
            from v_gain_location where month between DATE_FORMAT('2024-06-01', '%Y-%m') and DATE_FORMAT('2024-12-01', '%Y-%m');
        