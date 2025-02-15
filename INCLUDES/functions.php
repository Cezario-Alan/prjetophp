<?php





//Criando funcões


//Cadastrar usuario

function registerUser($name, $email, $password, $profileType, $conn)
{

    //CRUD

    $passHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn = $conn->prepare("INSERT INTO users(userName,email,userPassword,profileType) VALUES (?,?,?,?)");

    $stmt->bind_param("ssss", $name, $email, $passHash, $profileType);

    return $stmt->execute();
}

// funcao para fazer Login
function doLogin($email, $password, $conn) {
    $stmt = $conn->prepare("SELECT user_id, userName, userPassword, profileType FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    //validacao de senha 
    
    if ($user && password_verify($password, $user['userPassword'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['userName'];
        $_SESSION['profileType'] = $user['profileType'];
        return true;  
    }

    return false;  
}




function registerProduct($id_employer, $productName, $description, $category, $quantity, $unitPrice, $supplier, $entryDate, $expiryDate, $location, $productStatus, $note, $conn) {
    
    // Preparar a query SQL para inserção
    $stmt = $conn->prepare("INSERT INTO products (id_employer, productName, description, category, quantity, unitPrice, supplier, entryDate, expiryDate, location, productStatus, note) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Verifica se a preparação da query foi bem-sucedida
    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    // Bind dos parâmetros para evitar SQL Injection
    $stmt->bind_param("isssisssssss", $id_employer, $productName, $description, $category, $quantity, $unitPrice, $supplier, $entryDate, $expiryDate, $location, $productStatus, $note);

    // Executa a query e retorna true ou false
    return $stmt->execute();
}

//Visualizar produto



// Editar produto

function editProduct(){}



//Deletar produto

function delectProduct(){}




?>