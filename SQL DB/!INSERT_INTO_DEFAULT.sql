INSERT INTO `groupe` (`id`, `Label`) VALUES
(1, 'Admin'),
(2, 'User');

INSERT INTO `utilisateur` (`id`, `email`, `username`, `password`, `image`) VALUES
(1, 'root@gros3d.com', 'root', 'root', 'assets/pp/pp1.jpg'),
(2, 'user1@gros3d.com', 'user1', 'user1', 'assets/pp/pp2.jpg');

INSERT INTO `groupuser` (`idUser`, `idGroup`) VALUES
(1, 1),
(2, 2);

INSERT INTO `follow` (`idFollower`, `idFollowed`) VALUES
(2, 1);

INSERT INTO `filamenttype` (`id`, `name`) VALUES
(1, 'PLA'),
(2, 'Résine'),
(3, 'ABS'),
(4, 'PETG');

INSERT INTO `machinetype` (`id`, `name`) VALUES
(1, 'Résine (SLA)'),
(2, 'Plastique (FDM)'),
(3, 'Fusion de poudre (SLS)');

INSERT INTO `accessorytype` (`id`, `name`) VALUES
(1, 'Tournevis'),
(2, 'Buse'),
(3, 'Ruban adhésif'),
(4, 'Pince');

INSERT INTO `product` (`id`, `image`, `name`, `description`, `price`) VALUES
(1, 'assets/pp/resinerouge.jpg', 'Filament Vert GROS3D', 'Le PLA GROS3D Vert peut être imprimé sur la majorité des imprimantes 3D non propriétaires.', 25),
(2, 'assets/pp/resinerouge.jpg', 'Résine Rouge GROS3D', 'La résine GROS3D Rouge peut être imprimé sur la majorité des imprimantes 3D non propriétaires.', 26),
(3, 'assets/pp/elegoos.png', 'Imprimante SLA ELEGOO SATURN S', 'Digne héritière de la populaire Elegoo Saturn, la première imprimante 3D LCD Elegoo avec écran LCD monochrome, la Saturn S impressionne par des fonctionnalités améliorées et des vitesses et une impression plus rapides.', 300),
(4, 'assets/pp/cr10.png', 'Imprimante PLA CREALITY CR-10', 'De part son grand volume d’impression (300 x 300 x 400 mm), la qualité de ses impressions 3D (jusqu’à 100 microns) et surtout son prix très attractif, l’imprimante 3D Creality CR-10 a rapidement connu un certain succès.', 500),
(5, 'assets/pp/spatule.png', 'Spatule GROS3D', 'La très célèbre spatule GROS3D afin de décoller vos impressions.', 10),
(6, 'assets/pp/scotch.png', 'Ruban adhésif GROS3D', 'Le très célèbre ruban adhésif GROS3D afin de maintenir vos impressions au plateau.', 5);