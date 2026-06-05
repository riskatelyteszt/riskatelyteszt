-- points.sql
-- Random points for each team, organized by tier

-- Tier1
CREATE TABLE IF NOT EXISTS `tier1` (
  `team_name` TEXT NOT NULL,
  `points` INT NOT NULL,
  `form` TEXT NOT NULL
);

INSERT INTO `tier1` (`team_name`, `points`, `form`) VALUES
('BŰNVADÁSZOK', 0, '- - - - -'),
('Fogatlan5', 0, '- - - - -'),
('Team Bloodline', 0, '- - - - -'),
('Team Scout', 0, '- - - - -');

-- Tier2
CREATE TABLE IF NOT EXISTS `tier2` (
  `team_name` TEXT NOT NULL,
  `points` INT NOT NULL,
  `form` TEXT NOT NULL
);

INSERT INTO `tier2` (`team_name`, `points`, `form`) VALUES
('veremfekve', 0, '- - - - -'),
('woltfutarosok', 0, '- - - - -'),
('Zsebkendo', 0, '- - - - -'),
('1WIN', 0, '- - - - -'),
('CYBER', 0, '- - - - -'),
('Marielitos Crew', 0, '- - - - -'),
('Thors', 0, '- - - - -'),
('amir', 0, '- - - - -'),
('NS GAMING', 0, '- - - - -'),
('Eclipse', 0, '- - - - -'),
('BREVEK', 0, '- - - - -'),
('woltfutarosacademy', 0, '- - - - -');

-- Tier3
CREATE TABLE IF NOT EXISTS `tier3` (
  `team_name` TEXT NOT NULL,
  `points` INT NOT NULL,
  `form` TEXT NOT NULL
);

INSERT INTO `tier3` (`team_name`, `points`, `form`) VALUES
('1312', 0, '- - - - -'),
('nacsumi', 0, '- - - - -'),
('Weszelyes Elemek', 0, '- - - - -'),
('Botality', 0, '- - - - -'),
('Csikiak', 0, '- - - - -'),
('LFI', 0, '- - - - -'),
('Taktikai Pörkölt', 0, '- - - - -'),
('NYZO', 0, '- - - - -'),
('FrozenZ', 0, '- - - - -'),
('KREKK', 0, '- - - - -'),
('Bojler Eladó Esport', 0, '- - - - -'),
('szolnok motor utca 8', 0, '- - - - -'),
('overlocked', 0, '- - - - -'),
('The Serial Killer''s', 0, '- - - - -'),
('KVfőzők', 0, '- - - - -'),
('Team Falgoats', 0, '- - - - -'),
('Turul Vihar', 0, '- - - - -'),
('LÉLEKVADÁSZ', 0, '- - - - -'),
('nakmcs', 0, '- - - - -'),
('Team Nyíregyháza', 0, '- - - - -'),
('Demonic Roosters', 0, '- - - - -'),
('Temus S1mple', 0, '- - - - -'),
('CPOT', 0, '- - - - -'),
('Suttogos MM', 0, '- - - - -'),
('1000-7', 0, '- - - - -'),
('WWTeam', 0, '- - - - -'),
('HMT', 0, '- - - - -'),
('Danube Turul eSport', 0, '- - - - -'),
('whystopnow', 0, '- - - - -'),
('Relic Alpha', 0, '- - - - -'),
('Bundáskenyerek', 0, '- - - - -'),
('Vertex Elite', 0, '- - - - -'),
('NFBC', 0, '- - - - -'),
('fektsz', 0, '- - - - -');
