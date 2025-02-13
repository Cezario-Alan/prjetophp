<?php
$hash = '$2y$10$1XUIVEY6l/mbvUDdsKKqXegTheXoXX1L7dH4tCsM0kzOzevdVxBcq';
$senha = '123';


if (password_verify($hash1, $hash2)) {
    echo "A senha está correta!";
} else {
    echo "A senha está incorreta.";
}










?>


