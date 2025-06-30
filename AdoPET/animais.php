<?php
// AdoPET/animais.php
require_once 'db.php';
$page_title = 'Animais Dispon�veis para Ado��o';
include 'templates/header.php';

$conn = get_db_connection();
$todos_animais = [];

$query = "SELECT a.*, u.nome as nome_doador FROM animais a JOIN usuarios u ON a.id_usuario = u.id WHERE a.disponivel = TRUE";
$params = [];
$types = '';
$conditions = [];

$especie_sel = $_GET['especie'] ?? '';
if ($especie_sel) {
    $conditions[] = "a.especie = ?";
    $params[] = $especie_sel;
    $types .= 's';
}

$porte_sel = $_GET['porte'] ?? '';
if ($porte_sel) {
    $conditions[] = "a.porte = ?";
    $params[] = $porte_sel;
    $types .= 's';
}

$genero_sel = $_GET['genero'] ?? '';
if ($genero_sel) {
    $conditions[] = "a.genero = ?";
    $params[] = $genero_sel;
    $types .= 's';
}

if (!empty($conditions)) {
    $query .= " AND " . implode(" AND ", $conditions);
}
$query .= " ORDER BY a.data_cadastro DESC";

$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$todos_animais = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<section class="animais-disponiveis">
    <h2>Animais Dispon�veis para Ado��o</h2>

    <div class="filtros">
        <form action="animais.php" method="GET">
            <div class="filter-group">
                <label for="especie">Esp�cie:</label>
                <select name="especie" id="especie">
                    <option value="">Todas</option>
                    <option value="Cachorro" <?php echo ($especie_sel == 'Cachorro') ? 'selected' : ''; ?>>Cachorro</option>
                    <option value="Gato" <?php echo ($especie_sel == 'Gato') ? 'selected' : ''; ?>>Gato</option>
                    <option value="Outros" <?php echo ($especie_sel == 'Outros') ? 'selected' : ''; ?>>Outros</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="porte">Porte:</label>
                <select name="porte" id="porte">
                    <option value="">Todos</option>
                    <option value="Pequeno" <?php echo ($porte_sel == 'Pequeno') ? 'selected' : ''; ?>>Pequeno</option>
                    <option value="Medio" <?php echo ($porte_sel == 'Medio') ? 'selected' : ''; ?>>M�dio</option>
                    <option value="Grande" <?php echo ($porte_sel == 'Grande') ? 'selected' : ''; ?>>Grande</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="genero">G�nero:</label>
                <select name="genero" id="genero">
                    <option value="">Ambos</option>
                    <option value="Macho" <?php echo ($genero_sel == 'Macho') ? 'selected' : ''; ?>>Macho</option>
                    <option value="F�mea" <?php echo ($genero_sel == 'F�mea') ? 'selected' : ''; ?>>F�mea</option>
                </select>
            </div>
            
            <button type="submit" class="btn-secondary">Filtrar</button>
        </form>
    </div>

    <div class="galeria-animais">
        <?php if (!empty($todos_animais)): ?>
            <?php foreach ($todos_animais as $animal): ?>
                <div class="animal-card">
                    <img src="uploads/<?php echo htmlspecialchars($animal['foto_url']); ?>" alt="Foto do <?php echo htmlspecialchars($animal['nome']); ?>">
                    <h3><?php echo htmlspecialchars($animal['nome']); ?></h3>
                    <p><?php echo htmlspecialchars($animal['especie']); ?> - <?php echo htmlspecialchars($animal['idade']); ?> anos</p>
                    <p>Doador: <?php echo htmlspecialchars($animal['nome_doador']); ?></p>
                    <a href="animal_detalhes.php?id=<?php echo $animal['id']; ?>" class="btn-primary">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum animal dispon�vel com os filtros selecionados.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'templates/footer.php'; ?>