<?php
require_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Função de login
    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        return false;
    }

    // Cria o token
    public function createToken($email) {
        $token = bin2hex(random_bytes(16));
        $token_expiration = date("Y-m-d H:i:s", strtotime("+3 minutes"));

        $query = "UPDATE users SET token = :token, token_expiration = :expiration WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":expiration", $token_expiration);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $token;
    }

    // Redefine a senha
    public function resetPassword($token, $new_password) {
        $query = "SELECT * FROM users WHERE token = :token AND token_expiration > NOW()";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "Token inválido ou expirado.";
            return false;
        }

        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_query = "UPDATE users SET password = :password, token = NULL, token_expiration = NULL WHERE id = :id";
        $update_stmt = $this->conn->prepare($update_query);
        $update_stmt->bindParam(":password", $hashed_password);
        $update_stmt->bindParam(":id", $user['id']);
        $update_stmt->execute();

        return true;
    }

    // Função de registro
    public function register($nome, $email, $password, $telefone, $cpf, $data_nascimento, $sexo) {
        // Verifica se o email já está em uso
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return "Este email já está cadastrado.";
        }
    
        // Cria o hash da senha
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insere o novo usuário, incluindo nome, telefone, CPF, nascimento, sexo
        $query = "INSERT INTO users (nome, email, password, telefone, cpf, data_nascimento, sexo) 
                  VALUES (:nome, :email, :password, :telefone, :cpf, :data_nascimento, :sexo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":data_nascimento", $data_nascimento);  // Corrigido para $data_nascimento
        $stmt->bindParam(":sexo", $sexo);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return "Erro ao registrar usuário.";
        }
    }
}
?>
