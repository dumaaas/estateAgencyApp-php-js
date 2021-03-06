-- real_estate_agency.sifarnik_gradova definition

CREATE TABLE `sifarnik_gradova` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ime_grada` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sifarnik_gradova` (`id`,`ime_grada`) VALUES
	 (1,'Niksic'),
	 (2,'Podgorica'),
	 (3,'Cetinje'),
	 (4,'Pljevlja'),
	 (5,'Kotor'),
	 (6,'Herceg Novi'),
	 (7,'Tivat'),
	 (8,'Budva'),
	 (9,'Bar'),
	 (10,'Ulcinj'),
	 (11,'Petrovac'),
	 (12,'Danilovgrad'),
	 (13,'Zabljak'),
	 (14,'Pluzine'),
	 (15,'Savnik'),
	 (16,'Bijelo Polje'),
	 (17,'Mojkovac'),
	 (18,'Andrijevica'),
	 (19,'Plav'),
	 (20,'Kolasin'),
	 (21,'Berane');

-- real_estate_agency.sifarnik_oglasa definition

CREATE TABLE `sifarnik_oglasa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `oglas` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sifarnik_oglasa` (`id`,`oglas`) VALUES
	 (1,'Prodaja'),
	 (2,'Iznajmljivanje'),
	 (3,'Kompenzacija');

-- real_estate_agency.sifarnik_tipova definition

CREATE TABLE `sifarnik_tipova` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO `sifarnik_tipova` (`id`,`tip`) VALUES
	 (1,'Stan'),
	 (2,'Kuca'),
	 (3,'Garaza'),
	 (4,'Poslovni prostor');

-- real_estate_agency.nekretnina definition

CREATE TABLE `nekretnina` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `povrsina` double DEFAULT NULL,
  `cijena` double DEFAULT NULL,
  `godina_izgradnje` int(11) DEFAULT NULL,
  `opis` varchar(250) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Dostupno',
  `datum_prodaje` date DEFAULT NULL,
  `grad_id` bigint(20) DEFAULT NULL,
  `tip_id` bigint(20) DEFAULT NULL,
  `oglas_id` bigint(20) DEFAULT NULL,
  `datum_objavljivanja` date DEFAULT current_timestamp(),
  `adresa` varchar(40) DEFAULT NULL,
  `slika` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nekretnina_FK` (`grad_id`),
  KEY `nekretnina_FK_2` (`tip_id`),
  KEY `nekretnina_FK_1` (`oglas_id`),
  CONSTRAINT `nekretnina_FK` FOREIGN KEY (`grad_id`) REFERENCES `sifarnik_gradova` (`id`),
  CONSTRAINT `nekretnina_FK_1` FOREIGN KEY (`oglas_id`) REFERENCES `sifarnik_oglasa` (`id`),
  CONSTRAINT `nekretnina_FK_2` FOREIGN KEY (`tip_id`) REFERENCES `sifarnik_tipova` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

INSERT INTO `nekretnina` (`povrsina`,`cijena`,`godina_izgradnje`,`opis`,`status`,`datum_prodaje`,`grad_id`,`tip_id`,`oglas_id`,`datum_objavljivanja`,`adresa`,`slika`) VALUES
	 (55.0,40000.0,1990,'Trosoban stan u izgradnji. Nalazi se na idealnom lokaciji za porodicni zivot. Osnovna skola na 50 metara, srednja skola na 500 metara. Centar grada udaljen na 3 minuta. Idealno mjesto za djecu jer sadrzi ogromno dvoriste sa igralistem.','Dostupno',NULL,1,1,1,'2021-03-01','Serdara Scepana 5','stan1.jpg,stan2.jpg,stan3.jpg'),
	 (23.0,31999.0,1990,'Trospratna kuca u izgradnji. Nalazi se na idealnom lokaciji za porodicni zivot. Osnovna skola na 50 metara, srednja skola na 500 metara. Centar grada udaljen na 3 minuta. Idealno mjesto za djecu jer sadrzi ogromno dvoriste sa igralistem              ','Dostupno',NULL,2,2,2,'2021-03-01','Serdara Scepana 5','stan4.jpg,stan5.jpg,stan6.jpg'),
	 (15.0,10000.0,1995,'Garaza u izgradnji. Nalazi se na idealnom lokaciji za porodicni zivot. Osnovna skola na 50 metara, srednja skola na 500 metara. Centar grada udaljen na 3 minuta. Idealno mjesto za djecu jer sadrzi ogromno dvoriste sa igralistem                 ','Dostupno',NULL,3,3,3,'2021-03-01','Serdara Scepana 5','stan7.jpg,stan8.jpg,stan9.jpg'),
	 (44.0,60000.0,2015,'Trosoban stan u izgradnji. Nalazi se na idealnom lokaciji za porodicni zivot. Osnovna skola na 50 metara, srednja skola na 500 metara. Centar grada udaljen na 3 minuta. Idealno mjesto za djecu jer sadrzi ogromno dvoriste sa igralistem              ','Nedostupno','2021-03-01',4,4,3,'2021-03-01','Serdara Scepana 5','stan10.jpg,stan11.jpg,stan12.jpg'),
	 (121.0,232323.0,2015,'Trospratna kuca u izgradnji. Nalazi se na idealnom lokaciji za porodicni zivot. Osnovna skola na 50 metara, srednja skola na 500 metara. Centar grada udaljen na 3 minuta. Idealno mjesto za djecu jer sadrzi ogromno dvoriste sa igralistem          ','Nedostupno','2021-03-01',1,2,2,'2021-03-01','Serdara Scepana 5','stan2.jpg,stan4.jpg,stan10.jpg'),
	 (15.0,25000.0,1990,'Trosoban stan u izgradnji. Nalazi se na idealnom lokaciji za porodicni zivot. Osnovna skola na 50 metara, srednja skola na 500 metara. Centar grada udaljen na 3 minuta. Idealno mjesto za djecu jer sadrzi ogromno dvoriste sa igralistem             ','Nedostupno','2021-03-01',10,1,1,'2021-03-01','Serdara Scepana 5','stan5.jpg,stan7.jpg,stan11.jpg');