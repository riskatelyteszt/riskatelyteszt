<?php
$playersSql = __DIR__ . '/../sql/players.sql';
$teamsSql = __DIR__ . '/../sql/teams.sql';
$players = loadSQLFile($playersSql);
$teams = loadTeamsFromSQL($teamsSql);

function loadTeamsFromSQL(string $path): array
{
    return loadSQLFile($path);
}

function loadSQLFile(string $path): array
{
    if (!is_readable($path)) {
        return [];
    }

    $sql = file_get_contents($path);
    if ($sql === false) {
        return [];
    }

    return parseSQLFile($sql);
}

function parseSQLFile(string $sql): array
{
    $result = [];
    if (preg_match_all('/INSERT INTO\s+`([^`]+)`\s*\(([^)]+)\)\s*VALUES\s*(.+?);/is', $sql, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $table = strtolower($match[1]);
            $columns = parseSQLIdentifierList($match[2]);
            $rows = parseSQLValueRows($match[3]);
            foreach ($rows as $row) {
                $teamName = $row[0] ?? null;
                if ($teamName === null) {
                    continue;
                }
                $rowData = [];
                foreach ($columns as $index => $column) {
                    $rowData[$column] = $row[$index] ?? null;
                }
                $result[$table][$teamName] = $rowData;
            }
        }
    }

    return $result;
}

function parseSQLIdentifierList(string $input): array
{
    if (preg_match_all('/`([^`]+)`/', $input, $matches)) {
        return $matches[1];
    }

    return [];
}

function parseSQLValueRows(string $input): array
{
    $rows = [];
    $buffer = '';
    $inString = false;
    $escaped = false;
    $depth = 0;
    $chars = preg_split('//u', trim($input), -1, PREG_SPLIT_NO_EMPTY);

    foreach ($chars as $char) {
        if ($inString) {
            $buffer .= $char;
            if ($escaped) {
                $escaped = false;
            } elseif ($char === '\\') {
                $escaped = true;
            } elseif ($char === "'") {
                $inString = false;
            }
            continue;
        }

        if ($char === "'") {
            $inString = true;
            $buffer .= $char;
            continue;
        }

        if ($char === '(') {
            $depth++;
            $buffer .= $char;
            continue;
        }

        if ($char === ')') {
            $depth--;
            $buffer .= $char;
            if ($depth === 0) {
                $rows[] = trim($buffer);
                $buffer = '';
            }
            continue;
        }

        if ($depth === 0 && ($char === ',' || trim($char) === '')) {
            continue;
        }

        $buffer .= $char;
    }

    $result = [];
    foreach ($rows as $row) {
        $row = trim($row);
        if (str_starts_with($row, '(') && str_ends_with($row, ')')) {
            $row = substr($row, 1, -1);
        }
        $result[] = parseSQLValueList($row);
    }

    return $result;
}

function parseSQLValueList(string $row): array
{
    $values = [];
    $buffer = '';
    $inString = false;
    $escaped = false;
    $chars = preg_split('//u', $row, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($chars as $char) {
        if ($inString) {
            $buffer .= $char;
            if ($escaped) {
                $escaped = false;
            } elseif ($char === '\\') {
                $escaped = true;
            } elseif ($char === "'") {
                $inString = false;
            }
            continue;
        }

        if ($char === "'") {
            $inString = true;
            $buffer .= $char;
            continue;
        }

        if ($char === ',') {
            $values[] = normalizeSQLValue(trim($buffer));
            $buffer = '';
            continue;
        }

        $buffer .= $char;
    }

    if (trim($buffer) !== '') {
        $values[] = normalizeSQLValue(trim($buffer));
    }

    return $values;
}

function normalizeSQLValue(string $value)
{
    if ($value === 'NULL') {
        return null;
    }

    if (str_starts_with($value, "'") && str_ends_with($value, "'")) {
        $value = substr($value, 1, -1);
        $value = str_replace(["\\'", "\\\\"], ["'", "\\"], $value);
    }

    return $value;
}

function renderTeamPlayers(?array $teamData): void
{
    if (empty($teamData)) {
        echo '<div class="players-box"><h4>Aktív Felállás</h4><div class="player-row-grid">';
        for ($i = 0; $i < 5; $i++) {
            echo '<div class="player-badge"><span class="player-ign">?</span><span class="player-role">?</span></div>';
        }
        echo '</div></div><div class="players-box"><h4>Cserék</h4><div class="player-row-grid">';
        echo '<div class="player-badge"><span class="player-ign">?</span><span class="player-role">Sub</span></div>';
        echo '<div class="player-badge"><span class="player-ign">?</span><span class="player-role">Sub</span></div>';
        echo '</div></div>';
        return;
    }

    echo '<div class="players-box"><h4>Aktív Felállás</h4><div class="player-row-grid">';
    for ($i = 1; $i <= 5; $i++) {
        $player = htmlspecialchars($teamData['player' . $i] ?? '?', ENT_QUOTES, 'UTF-8');
        $role = htmlspecialchars($teamData['role' . $i] ?? '?', ENT_QUOTES, 'UTF-8');
        echo '<div class="player-badge"><span class="player-ign">' . $player . '</span><span class="player-role">' . $role . '</span></div>';
    }
    echo '</div></div>';

    echo '<div class="players-box"><h4>Cserék</h4><div class="player-row-grid">';
    for ($i = 1; $i <= 2; $i++) {
        $sub = htmlspecialchars($teamData['sub' . $i] ?? '?', ENT_QUOTES, 'UTF-8');
        $subRole = htmlspecialchars($teamData['sub' . $i . '_role'] ?? 'Sub', ENT_QUOTES, 'UTF-8');
        echo '<div class="player-badge"><span class="player-ign">' . $sub . '</span><span class="player-role">' . $subRole . '</span></div>';
    }
    echo '</div></div>';
}

function renderTeamAccordion(string $teamName, ?array $teamData, ?array $teamStats = null): void
{
    $logo = htmlspecialchars(teamLogoPlaceholder($teamName), ENT_QUOTES, 'UTF-8');
    $teamNameSafe = htmlspecialchars($teamName, ENT_QUOTES, 'UTF-8');

    echo '<div class="team-accordion">';
    echo '<div class="accordion-header">';
    echo '<div class="team-title-block">';
    echo '<div class="team-logo-placeholder">' . $logo . '</div>';
    echo '<span class="team-name">' . $teamNameSafe . '</span>';
    echo '</div>';
    echo '<i class="fa-solid fa-chevron-down accordion-arrow"></i>';
    echo '</div>';
    echo '<div class="accordion-content">';
    echo '<div class="accordion-inner">';
    renderTeamStats($teamStats);
    renderTeamPlayers($teamData);
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

function renderTeamStats(?array $teamStats): void
{
    $wins = $teamStats['wins'] ?? null;
    $losses = $teamStats['losses'] ?? null;
    $winRate = $teamStats['win_rate'] ?? ($teamStats['winrate'] ?? null);
    $roundDiff = $teamStats['round_diff'] ?? ($teamStats['rounddiff'] ?? null);
    $divisionRank = $teamStats['division_rank'] ?? ($teamStats['divisionrank'] ?? null);
    $overallRank = $teamStats['overall_rank'] ?? ($teamStats['overallrank'] ?? null);

    $wlText = ($wins !== null && $losses !== null)
        ? htmlspecialchars((string)$wins, ENT_QUOTES, 'UTF-8') . ' / ' . htmlspecialchars((string)$losses, ENT_QUOTES, 'UTF-8')
        : '?';
    $winRateText = $winRate !== null ? htmlspecialchars((string)$winRate, ENT_QUOTES, 'UTF-8') : '?';
    $roundDiffText = $roundDiff !== null ? htmlspecialchars((string)$roundDiff, ENT_QUOTES, 'UTF-8') : '?';
    $divisionRankText = $divisionRank !== null ? htmlspecialchars((string)$divisionRank, ENT_QUOTES, 'UTF-8') : '?';
    $overallRankText = $overallRank !== null ? htmlspecialchars((string)$overallRank, ENT_QUOTES, 'UTF-8') : '?';

    echo '<div class="stats-box">';
    echo '<h4>Csapat Statisztikák</h4>';
    echo '<div class="stats-mini-grid">';
    echo '<div class="stat-card"><span class="stat-val">' . $wlText . '</span><span class="stat-lbl">W / L</span></div>';
    echo '<div class="stat-card"><span class="stat-val">' . $winRateText . '</span><span class="stat-lbl">Win Rate</span></div>';
    echo '<div class="stat-card"><span class="stat-val">' . $roundDiffText . '</span><span class="stat-lbl">Round Diff</span></div>';
    echo '<div class="stat-card"><span class="stat-val">' . $divisionRankText . '</span><span class="stat-lbl">Helyezés (Divízió)</span></div>';
    echo '<div class="stat-card"><span class="stat-val">' . $overallRankText . '</span><span class="stat-lbl">Helyezés (Összes)</span></div>';
    echo '</div>';
    echo '</div>';
}

function teamLogoPlaceholder(string $teamName): string
{
    $clean = preg_replace('/[^\p{L}\p{N}\s]/u', '', $teamName);
    $words = preg_split('/\s+/u', trim($clean));
    if (count($words) === 0) {
        return '';
    }

    if (count($words) === 1) {
        return mb_strtoupper(mb_substr($words[0], 0, min(3, mb_strlen($words[0], 'UTF-8')), 'UTF-8'), 'UTF-8');
    }

    $logo = '';
    foreach ($words as $word) {
        if ($word === '') {
            continue;
        }
        $logo .= mb_substr($word, 0, 1, 'UTF-8');
        if (mb_strlen($logo, 'UTF-8') >= 3) {
            break;
        }
    }

    return mb_strtoupper($logo, 'UTF-8');
}
?>
<!-- Az oldalt fejlesztette: RISKATELY | Az oldal kódjainak lelopása, vagy felhasználása tilos | Az oldal forráskódja NEM a Hungarian Major tulajdona-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams | Hungarian Major</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="csapatok.css">
</head>
<body class="dark-theme">
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>
    <div class="bg-blob blob-3"></div>

    <header class="navbar">
        <div class="logo">
            <i class="fa-solid fa-crosshairs"></i> HUNGARIAN <span>MAJOR</span>
        </div>
        <nav class="nav-links">
            <a href="../index.php#hero">Home</a>
            <a href="../index.php#about">About</a>
            <a href="../index.php#tournaments">Tournaments</a>
            <a href="csapatok.php" class="active">Csapatok</a>
            <a href="../standing/helyezes.php">Helyezések</a>
        </nav>
        <div class="nav-actions">
            <button id="theme-toggle" class="btn-icon" aria-label="Toggle Theme">
                <i class="fa-solid fa-sun"></i>
            </button>
            <a href="https://discord.gg/UFTUpCfgu" class="btn-primary-sm">Register</a>
        </div>
    </header>

    <main class="section-container teams-main-padding">
        
        <h1 class="section-title">Csapat Statisztikák</h1>

        <div id="tier-selection-view" class="view-section active">
            <h2 class="section-title">Válassz Divíziót</h2>
            <div class="grid-3-col tier-selection-grid">
                
                <div class="glass-card tier-card" onclick="switchView('tier1-view')">
                    <i class="fa-solid fa-ranking-star"></i>
                    <h3>Tier 1</h3>
                    <p>High Tier</p>
                </div>

                <div class="glass-card tier-card" onclick="switchView('tier2-view')">
                    <i class="fa-solid fa-medal"></i>
                    <h3>Tier 2</h3>
                    <p>Mid Tier</p>
                </div>

                <div class="glass-card tier-card" onclick="switchView('tier3-view')">
                    <i class="fa-solid fa-turn-up"></i>
                    <h3>Tier 3</h3>
                    <p>Low Tier</p>
                </div>

            </div>
        </div>

        <div id="tier1-view" class="view-section">
            <button class="back-btn" onclick="switchView('tier-selection-view')">
                <i class="fa-solid fa-arrow-left"></i> Vissza a választáshoz
            </button>
            <h2 class="section-title text-left-alignment">Tier 1 Csapatok</h2>
            
            <!-- Tier 1 csapatok -->
             <!-- BUNVADASZOK -->
            <div class="team-list">
                <?php
                foreach ($teams['tier1'] ?? [] as $teamName => $teamStats) {
                    renderTeamAccordion($teamName, $players['tier1'][$teamName] ?? null, $teamStats);
                }
                ?>
            </div>
        </div>

        <!-- Tier 2 csapatok -->
        <div id="tier2-view" class="view-section">
            <button class="back-btn" onclick="switchView('tier-selection-view')">
                <i class="fa-solid fa-arrow-left"></i> Vissza a választáshoz
            </button>
            <h2 class="section-title text-left-alignment">Tier 2 Csapatok</h2>
            <div class="team-list">
                <?php
                foreach ($teams['tier2'] ?? [] as $teamName => $teamStats) {
                    renderTeamAccordion($teamName, $players['tier2'][$teamName] ?? null, $teamStats);
                }
                ?>
            </div>
        </div>

        <div id="tier3-view" class="view-section">
            <button class="back-btn" onclick="switchView('tier-selection-view')">
                <i class="fa-solid fa-arrow-left"></i> Vissza a választáshoz
            </button>
            <h2 class="section-title text-left-alignment">Tier 3 Csapatok</h2>
             <div class="team-list">
                <?php
                foreach ($teams['tier3'] ?? [] as $teamName => $teamStats) {
                    renderTeamAccordion($teamName, $players['tier3'][$teamName] ?? null, $teamStats);
                }
                ?>
            </div>
        </div>

    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2026 Hungarian Major. Minden jog fenntartva.</p>
            <div class="social-links">
                <a href="https://www.tiktok.com/@hungarian.major" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://discord.gg/UFTUpCfgu" aria-label="Discord"><i class="fa-brands fa-discord"></i></a>
                <a href="https://www.twitch.tv/hungarian_major" aria-label="Twitch"><i class="fa-brands fa-twitch"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <script src="../theme.js"></script>
    <script>
        // Switching View Controller
        function switchView(viewId) {
            document.querySelectorAll('.view-section').forEach(view => {
                view.classList.remove('active');
            });
            document.getElementById(viewId).classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Accordion Calculation Engine
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', () => {
                const accordion = header.parentElement;
                const content = accordion.querySelector('.accordion-content');
                
                if (accordion.classList.contains('open')) {
                    content.style.maxHeight = null;
                    accordion.classList.remove('open');
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    accordion.classList.add('open');
                }
            });
        });
    </script>
</body>
</html>