-- teams.sql
-- Team name lists organized by tier, now including team statistics

-- Tier1
CREATE TABLE IF NOT EXISTS `tier1` (
  `team_name` TEXT NOT NULL,
  `wins` INT NOT NULL,
  `losses` INT NOT NULL,
  `win_rate` TEXT NOT NULL,
  `round_diff` INT NOT NULL,
  `division_rank` INT NOT NULL,
  `overall_rank` INT NOT NULL
);

INSERT INTO `tier1` (`team_name`, `wins`, `losses`, `win_rate`, `round_diff`, `division_rank`, `overall_rank`) VALUES
('BŰNVADÁSZOK', 0, 0, '0%', 0, 0, 0),
('Fogatlan5', 0, 0, '0%', 0, 0, 0),
('Team Bloodline', 0, 0, '0%', 0, 0, 0),
('Team Scout', 0, 0, '0%', 0, 0, 0);

-- Tier2
CREATE TABLE IF NOT EXISTS `tier2` (
  `team_name` TEXT NOT NULL,
  `wins` INT NOT NULL,
  `losses` INT NOT NULL,
  `win_rate` TEXT NOT NULL,
  `round_diff` INT NOT NULL,
  `division_rank` INT NOT NULL,
  `overall_rank` INT NOT NULL
);

INSERT INTO `tier2` (`team_name`, `wins`, `losses`, `win_rate`, `round_diff`, `division_rank`, `overall_rank`) VALUES
('veremfekve', 0, 0, '0%', 0, 0, 0),
('woltfutarosok', 0, 0, '0%', 0, 0, 0),
('Zsebkendo', 0, 0, '0%', 0, 0, 0),
('1WIN', 0, 0, '0%', 0, 0, 0),
('CYBER', 0, 0, '0%', 0, 0, 0),
('Marielitos Crew', 0, 0, '0%', 0, 0, 0),
('Thors', 0, 0, '0%', 0, 0, 0),
('amir', 0, 0, '0%', 0, 0, 0),
('NS GAMING', 0, 0, '0%', 0, 0, 0),
('Eclipse', 0, 0, '0%', 0, 0, 0),
('BREVEK', 0, 0, '0%', 0, 0, 0),
('woltfutarosacademy', 0, 0, '0%', 0, 0, 0);

-- Tier3
CREATE TABLE IF NOT EXISTS `tier3` (
  `team_name` TEXT NOT NULL,
  `wins` INT NOT NULL,
  `losses` INT NOT NULL,
  `win_rate` TEXT NOT NULL,
  `round_diff` INT NOT NULL,
  `division_rank` INT NOT NULL,
  `overall_rank` INT NOT NULL
);

INSERT INTO `tier3` (`team_name`, `wins`, `losses`, `win_rate`, `round_diff`, `division_rank`, `overall_rank`) VALUES
('1312', 0, 0, '0%', 0, 0, 0),
('nacsumi', 0, 0, '0%', 0, 0, 0),
('Weszelyes Elemek', 0, 0, '0%', 0, 0, 0),
('Botality', 0, 0, '0%', 0, 0, 0),
('Csikiak', 0, 0, '0%', 0, 0, 0),
('LFI', 0, 0, '0%', 0, 0, 0),
('Taktikai Pörkölt', 0, 0, '0%', 0, 0, 0),
('NYZO', 0, 0, '0%', 0, 0, 0),
('FrozenZ', 0, 0, '0%', 0, 0, 0),
('KREKK', 0, 0, '0%', 0, 0, 0),
('Bojler Eladó Esport', 0, 0, '0%', 0, 0, 0),
('szolnok motor utca 8', 0, 0, '0%', 0, 0, 0),
('overlocked', 0, 0, '0%', 0, 0, 0),
('The Serial Killer''s', 0, 0, '0%', 0, 0, 0),
('KVfőzők', 0, 0, '0%', 0, 0, 0),
('Team Falgoats', 0, 0, '0%', 0, 0, 0),
('Turul Vihar', 0, 0, '0%', 0, 0, 0),
('LÉLEKVADÁSZ', 0, 0, '0%', 0, 0, 0),
('nakmcs', 0, 0, '0%', 0, 0, 0),
('Team Nyíregyháza', 0, 0, '0%', 0, 0, 0),
('Demonic Roosters', 0, 0, '0%', 0, 0, 0),
('Temus S1mple', 0, 0, '0%', 0, 0, 0),
('CPOT', 0, 0, '0%', 0, 0, 0),
('Suttogos MM', 0, 0, '0%', 0, 0, 0),
('1000-7', 0, 0, '0%', 0, 0, 0),
('WWTeam', 0, 0, '0%', 0, 0, 0),
('HMT', 0, 0, '0%', 0, 0, 0),
('Danube Turul eSport', 0, 0, '0%', 0, 0, 0),
('whystopnow', 0, 0, '0%', 0, 0, 0),
('Relic Alpha', 0, 0, '0%', 0, 0, 0),
('Bundáskenyerek', 0, 0, '0%', 0, 0, 0),
('Vertex Elite', 0, 0, '0%', 0, 0, 0),
('NFBC', 0, 0, '0%', 0, 0, 0),
('fektsz', 0, 0, '0%', 0, 0, 0);
