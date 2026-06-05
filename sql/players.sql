-- players.sql
-- Team rosters and roles for teams listed in teams/csapatok.php

-- Tier1
CREATE TABLE IF NOT EXISTS `tier1` (
  `team_name` TEXT NOT NULL,
  `player1` TEXT NOT NULL,
  `role1` TEXT NOT NULL,
  `player2` TEXT NOT NULL,
  `role2` TEXT NOT NULL,
  `player3` TEXT NOT NULL,
  `role3` TEXT NOT NULL,
  `player4` TEXT NOT NULL,
  `role4` TEXT NOT NULL,
  `player5` TEXT NOT NULL,
  `role5` TEXT NOT NULL,
  `sub1` TEXT NOT NULL,
  `sub1_role` TEXT NOT NULL,
  `sub2` TEXT NOT NULL,
  `sub2_role` TEXT NOT NULL
);

INSERT INTO `tier1` (`team_name`, `player1`, `role1`, `player2`, `role2`, `player3`, `role3`, `player4`, `role4`, `player5`, `role5`, `sub1`, `sub1_role`, `sub2`, `sub2_role`) VALUES
('BŰNVADÁSZOK', 'RISKATELY', 'IGL', 'skeet', 'AWP', 'mkay', 'Rifler', 'FuveZeq', 'Rifler', 'MinimaxFan', 'Entry', 'kaczur', 'Sub', 'peppi', 'Bottomfragger')
('Fogatlan5', 'Cola', 'IGL', 'ValyiX', 'AWP', 'oiblud', 'Rifler', 'sakiryy', 'Rifler', 'hinoni', 'Entry', 'Sub1', 'Sub', 'Sub2', 'Sub'),
('Team Bloodline', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Sub1', 'Sub', 'Sub2', 'Sub'),
('Team Scout', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Sub1', 'Sub', 'Sub2', 'Sub');

-- Tier2
CREATE TABLE IF NOT EXISTS `tier2` (
  `team_name` TEXT NOT NULL,
  `player1` TEXT NOT NULL,
  `role1` TEXT NOT NULL,
  `player2` TEXT NOT NULL,
  `role2` TEXT NOT NULL,
  `player3` TEXT NOT NULL,
  `role3` TEXT NOT NULL,
  `player4` TEXT NOT NULL,
  `role4` TEXT NOT NULL,
  `player5` TEXT NOT NULL,
  `role5` TEXT NOT NULL,
  `sub1` TEXT NOT NULL,
  `sub1_role` TEXT NOT NULL,
  `sub2` TEXT NOT NULL,
  `sub2_role` TEXT NOT NULL
);

INSERT INTO `tier2` (`team_name`, `player1`, `role1`, `player2`, `role2`, `player3`, `role3`, `player4`, `role4`, `player5`, `role5`, `sub1`, `sub1_role`, `sub2`, `sub2_role`) VALUES
('Thor''s', 'V1tya', 'IGL', '?', 'AWP', '?', 'Rifler', '?', 'Lurker', '?', 'Rifler', '?', 'Sub', '?', 'Sub');

-- Tier3
CREATE TABLE IF NOT EXISTS `tier3` (
  `team_name` TEXT NOT NULL,
  `player1` TEXT NOT NULL,
  `role1` TEXT NOT NULL,
  `player2` TEXT NOT NULL,
  `role2` TEXT NOT NULL,
  `player3` TEXT NOT NULL,
  `role3` TEXT NOT NULL,
  `player4` TEXT NOT NULL,
  `role4` TEXT NOT NULL,
  `player5` TEXT NOT NULL,
  `role5` TEXT NOT NULL,
  `sub1` TEXT NOT NULL,
  `sub1_role` TEXT NOT NULL,
  `sub2` TEXT NOT NULL,
  `sub2_role` TEXT NOT NULL
);

INSERT INTO `tier3` (`team_name`, `player1`, `role1`, `player2`, `role2`, `player3`, `role3`, `player4`, `role4`, `player5`, `role5`, `sub1`, `sub1_role`, `sub2`, `sub2_role`) VALUES
('1312', 'Ahmed', '?', 'daraizoli', '?', 'Dominik', '?', 'kolRRR', '?', '?', '?', '?', 'Sub', '?', 'Sub'),
('nacsumi', 'Amartonakoss', '?', 'Messyhat', '?', 'mrkrumpli', '?', 'kendey', '?', 'matyi', '?', 'abell', 'Sub', '?', 'Sub'),
('Weszelyes Elemek', 'Aronka7', '?', 'Botondurr', '?', 'Kovacs', '?', 'arpii.blgh', '?', 'PMatesz', '?', '?', 'Sub', '?', 'Sub'),
('botality', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Sub', '?', 'Sub'),
('csikiak', 'Norbi HUN', '?', 'Dark_Man', '?', 'Fonyo Norbert', '?', 'Lorenzo', '?', 'NemOnline', '?', 'Chill guy', 'Sub', '?', 'Sub'),
('LFI', 'WiktoR', '?', 'awcs', '?', 'bencewow', '?', 'Somorak', '?', 'Larionthebear', '?', 'Z0|!', 'Sub', 'gidoisti', 'Sub'),
('Taktikai Pörkölt', 'Ferdinandosz', '?', 'HunPro', '?', 'MAttix', '?', 'Milán', '?', 'Wonex', '?', '?', 'Sub', '?', 'Sub'),
('NYZO', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Sub', '?', 'Sub'),
('FrozenZ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Sub', '?', 'Sub'),
('KREKK', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Sub', '?', 'Sub'),
('Bojler Eladó Esport', 'Csibusz', '?', 'Zsombor', '?', 'alma90', '?', 'fabian_balazs2013', '?', '?', '?', '?', 'Sub', '?', 'Sub'),
('overlocked', 'Medve', '?', 'Roland', '?', 'Szip of Kola', '?', 'Tiktok_SeNs', '?', '?', '?', '?', 'Sub', '?', 'Sub'),
('The Serial Killer''S', 'Csazo', '?', 'Lavesz', '?', 'owner', '?', 'Dr.Mexiko', '?', 'BLÉVISZ', '?', 'KnightDRK', 'Sub', '?', 'Sub'),
('NAKMCS', 'Bendejuice', '?', 'Zs0Ltt', '?', 'boby', '?', 'sm!le', '?', 'slw.666', '?', '?', 'Sub', '?', 'Sub')
('szolnok motor utca 8', 'akna', 'IGL', 'giroszlan', 'Rifler', 'kMan', 'Support', 'm4tt', 'Rifler', 'kulbasz', 'Lurker', '?', 'Sub', '?', 'Sub');
