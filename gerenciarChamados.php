<?php
include 'conexao.php'; // Inclui a conexão com o banco

// Função para alterar o status do chamado
if (isset($_POST['alterar_status'])) {
    $chamado_id = $_POST['chamado_id'];
    $novo_status = $_POST['status'];

    $sql = "UPDATE Chamados SET status='$novo_status' WHERE chamado_id='$chamado_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Status atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o status: " . $conn->error;
    }
}

// Função para atribuir colaborador
if (isset($_POST['atribuir_colaborador'])) {
    $chamado_id = $_POST['chamado_id'];
    $colaborador_id = $_POST['colaborador_id'];

    $sql = "UPDATE Chamados SET colaborador_id='$colaborador_id' WHERE chamado_id='$chamado_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Colaborador atribuído com sucesso!";
    } else {
        echo "Erro ao atribuir colaborador: " . $conn->error;
    }
}

// Listar os chamados
$sql = "SELECT * FROM Chamados WHERE status = 'aberto' AND criticidade = 'alta'";
$result = $conn->query($sql);
?>

<h2>Gerenciamento de Chamados</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Criticidade</th>
            <th>Colaborador Responsável</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['chamado_id'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['criticidade'] . "</td>";
            echo "<td>" . ($row['colaborador_id'] ? $row['colaborador_id'] : "Sem colaborador") . "</td>";
            echo "<td>
                    <form method='POST' action='GerenciarChamados.php'>
                        <input type='hidden' name='chamado_id' value='" . $row['chamado_id'] . "'>
                        <select name='status'>
                            <option value='aberto'>Aberto</option>
                            <option value='em andamento'>Em andamento</option>
                            <option value='resolvido'>Resolvido</option>
                        </select>
                        <button type='submit' name='alterar_status'>Alterar Status</button>
                    </form>
                    <form method='POST' action='GerenciarChamados.php'>
                        <input type='hidden' name='chamado_id' value='" . $row['chamado_id'] . "'>
                        <input type='text' name='colaborador_id' placeholder='ID Colaborador'>
                        <button type='submit' name='atribuir_colaborador'>Atribuir Colaborador</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
// Fechar a conexão
$conn->close();
?>
