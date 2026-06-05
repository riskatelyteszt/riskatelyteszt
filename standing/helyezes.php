<?php
$sqlFile = __DIR__ . '/../sql/points.sql';
if (!is_readable($sqlFile)) {
    $sqlFile = __DIR__ . '/../sql/pontszamok.sql';
}
$standings = loadPointsFromSQL($sqlFile);
$tier1 = $standings['tier1'] ?? [];
$tier2 = $standings['tier2'] ?? [];
$tier3 = $standings['tier3'] ?? [];

function loadPointsFromSQL(string $path): array
{
    if (!is_readable($path)) {
        return [];
    }

    $sql = file_get_contents($path);
    if ($sql === false) {
        return [];
    }

    return parsePontszamokSQL($sql);
}

function parsePontszamokSQL(string $sql): array
{
    $standings = [];
    if (preg_match_all('/INSERT INTO\s+`([^`]+)`\s*\(([^)]+)\)\s*VALUES\s*(.+?);/is', $sql, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $table = strtolower($match[1]);
            $columns = parseSQLIdentifierList($match[2]);
            $rows = parseSQLValueRows($match[3]);
            if (empty($columns) || empty($rows)) {
                continue;
            }

            $teamRows = [];
            $normalizedColumns = array_map(fn($col) => strtolower(trim($col)), $columns);
            if (isset($normalizedColumns[0]) && $normalizedColumns[0] === 'team_name') {
                foreach ($rows as $row) {
                    $team = $row[0] ?? null;
                    if ($team === null || $team === '') {
                        continue;
                    }

                    $rowData = [];
                    foreach ($columns as $index => $column) {
                        $value = $row[$index] ?? null;
                        $key = strtolower(trim($column));
                        $rowData[$key] = is_numeric($value) ? (int)$value : $value;
                    }
                    $teamRows[$team] = $rowData;
                }
            } else {
                $lastRow = end($rows);
                foreach ($columns as $index => $team) {
                    $points = $lastRow[$index] ?? null;
                    $teamRows[$team] = ['points' => is_numeric($points) ? (int)$points : $points];
                }
            }

            uasort($teamRows, function ($a, $b) {
                $pointsA = $a['points'] ?? null;
                $pointsB = $b['points'] ?? null;

                if ($pointsA === $pointsB) {
                    return 0;
                }

                if ($pointsA === null || $pointsA === '') {
                    return 1;
                }
                if ($pointsB === null || $pointsB === '') {
                    return -1;
                }

                return ($pointsA > $pointsB) ? -1 : 1;
            });

            $standings[$table] = $teamRows;
        }
    }

    return $standings;
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

function renderFormCell(?string $form): void
{
    $symbols = [];
    if ($form !== null && trim($form) !== '') {
        $symbols = preg_split('/\s+/', strtoupper(trim($form)));
        $symbols = array_filter($symbols, fn($symbol) => in_array($symbol, ['W', 'L', '-'], true));
    }

    if (empty($symbols)) {
        $symbols = array_fill(0, 5, '-');
    }

    if (count($symbols) > 5) {
        $symbols = array_slice($symbols, 0, 5);
    }

    $symbols = array_pad($symbols, 5, '-');

    echo '<td class="form-cell">';
    foreach ($symbols as $symbol) {
        $class = $symbol === 'W' ? 'win' : ($symbol === 'L' ? 'loss' : 'neutral');
        echo '<span class="trend-dot ' . $class . '">' . htmlspecialchars($symbol, ENT_QUOTES, 'UTF-8') . '</span>';
    }
    echo '</td>';
}

function renderStandingsRows(array $tierData): void
{
    if (empty($tierData)) {
        echo '<tr><td colspan="7" style="color: var(--text-muted); text-align:center;">Nincs elérhető adat a tier számára.</td></tr>';
        return;
    }

    $rank = 1;
    foreach ($tierData as $team => $rowData) {
        $rowClass = $rank <= 3 ? 'top-three rank-' . $rank : '';
        $teamLabel = htmlspecialchars($team, ENT_QUOTES, 'UTF-8');
        $pointsLabel = htmlspecialchars((string)($rowData['points'] ?? '-'), ENT_QUOTES, 'UTF-8');

        echo '<tr class="' . $rowClass . '">';
        echo '<td><span class="rank-badge">' . $rank . '</span></td>';
        echo '<td class="team-cell-name"><strong>' . $teamLabel . '</strong></td>';
        echo '<td>-</td>';
        echo '<td>-</td>';
        echo '<td>-</td>';
        echo '<td class="points-highlight">' . $pointsLabel . '</td>';
        renderFormCell($rowData['form'] ?? null);
        echo '</tr>';

        $rank++;
    }
}

function renderTierTable(array $tierData): void
{
    if (empty($tierData)) {
        echo '<div class="glass-card" style="padding: 40px; text-align: center;">';
        echo '<p style="color: var(--text-muted); font-style: italic;">A bajnokság megkezdése után a meccseredmények és pontok itt frissülnek.</p>';
        echo '</div>';
        return;
    }

    echo '<div class="table-container glass-card">';
    echo '<table class="standings-table">';
    echo '<thead><tr><th>Hely</th><th>Csapat</th><th>M</th><th>Gy</th><th>V</th><th>Pontszám</th><th>Forma</th></tr></thead>';
    echo '<tbody>';
    renderStandingsRows($tierData);
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>

<!-- Az oldalt fejlesztette: RISKATELY | Az oldal kódjainak lelopása, vagy felhasználása tilos | Az oldal forráskódja NEM a Hungarian Major tulajdona-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standings | Hungarian Major</title>
    <!-- betutipusok es ikonok -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- styleok/css -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="helyezes.css">
</head>
<body class="dark-theme">
    <!-- Ambient Background Blobs -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>
    <div class="bg-blob blob-3"></div>

    <!-- Navigation Header -->
    <header class="navbar">
        <div class="logo">
            <i class="fa-solid fa-crosshairs"></i> HUNGARIAN <span>MAJOR</span>
        </div>
        <nav class="nav-links">
            <a href="../index.php">Home</a>
            <a href="../index.php#about">About</a>
            <a href="../index.php#tournaments">Tournaments</a>
            <a href="../teams/csapatok.php">Csapatok</a>
            <a href="helyezes.php" class="active">Helyezések</a>
        </nav>
        <div class="nav-actions">
            <button id="theme-toggle" class="btn-icon" aria-label="Toggle Theme">
                <i class="fa-solid fa-sun"></i>
            </button>
            <a href="https://discord.gg/UFTUpCfgu" class="btn-primary-sm">Register</a>
        </div>
    </header>

    <!-- Content Wrapper -->
    <main class="section-container standings-main-padding">
        
        <!-- ==========================================
             TIER SELECTION
             ========================================== -->
        <div id="tier-selection-view" class="view-section active">
            <h2 class="section-title">Csapat Helyezések</h2>
            <div class="grid-3-col tier-selection-grid">
                
                <div class="glass-card tier-card" onclick="switchView('tier1-view')">
                    <i class="fa-solid fa-trophy"></i>
                    <h3>Tier 1 Standings</h3>
                    <p>High Tier</p>
                </div>

                <div class="glass-card tier-card" onclick="switchView('tier2-view')">
                    <i class="fa-solid fa-medal"></i>
                    <h3>Tier 2 Standings</h3>
                    <p>Mid Tier</p>
                </div>

                <div class="glass-card tier-card" onclick="switchView('tier3-view')">
                    <i class="fa-solid fa-shield"></i>
                    <h3>Tier 3 Standings</h3>
                    <p>Low Tier</p>
                </div>

            </div>
        </div>

        <!-- ==========================================
              TIER 1 STANDINGS TABLE
             ========================================== -->
        <div id="tier1-view" class="view-section">
            <button class="back-btn" onclick="switchView('tier-selection-view')">
                <i class="fa-solid fa-arrow-left"></i> Vissza a választáshoz
            </button>
            <h2 class="section-title text-left-alignment">Tier 1 Tabella</h2>
            <?php renderTierTable($tier1); ?>
        </div>

        <!-- ==========================================
             TIER 2 STANDINGS TABLE
             ========================================== -->
        <div id="tier2-view" class="view-section">
            <button class="back-btn" onclick="switchView('tier-selection-view')">
                <i class="fa-solid fa-arrow-left"></i> Vissza a választáshoz
            </button>
            <h2 class="section-title text-left-alignment">Tier 2 Tabella</h2>
            <?php renderTierTable($tier2); ?>
        </div>

        <!-- ==========================================
             TIER 3 STANDINGS TABLE
             ========================================== -->
        <div id="tier3-view" class="view-section">
            <button class="back-btn" onclick="switchView('tier-selection-view')">
                <i class="fa-solid fa-arrow-left"></i> Vissza a választáshoz
            </button>
            <h2 class="section-title text-left-alignment">Tier 3 Tabella</h2>
            <?php renderTierTable($tier3); ?>
        </div>

    </main>

    <!-- Footer -->
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
        function switchView(viewId) {
            document.querySelectorAll('.view-section').forEach(view => {
                view.classList.remove('active');
            });
            document.getElementById(viewId).classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function sortTableByPoints(tableId) {
            const table = document.querySelector(`#${tableId} .standings-table`);
            if (!table) return;

            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            rows.sort((a, b) => {
                const pointsA = parseInt(a.cells[5].textContent.trim()) || 0;
                const pointsB = parseInt(b.cells[5].textContent.trim()) || 0;
                return pointsB - pointsA;
            });

            rows.forEach((row, index) => {
                const rank = index + 1;
                const rankBadge = row.querySelector('.rank-badge');
                if (rankBadge) {
                    rankBadge.textContent = rank;
                }
                row.className = '';
                if (rank <= 3) {
                    row.classList.add('top-three');
                    row.classList.add(`rank-${rank}`);
                }
            });

            rows.forEach(row => tbody.appendChild(row));
        }

        document.addEventListener('DOMContentLoaded', function() {
            sortTableByPoints('tier1-view');
            sortTableByPoints('tier2-view');
        });
    </script>
</body>
</html>