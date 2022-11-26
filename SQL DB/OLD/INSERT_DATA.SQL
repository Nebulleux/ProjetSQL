--DATA groupe
INSERT INTO `groupe` (`id`, `Label`) VALUES
(1, 'Admin'),
(2, 'User');
COMMIT;

--changements a faire
dans rating mettre date à datetime
enlever rating de la table User
ajouter une colonne image pour product
limiter note a un int(5)