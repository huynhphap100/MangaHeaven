<?php
function addCategory($name){
    $database = DATABASE::connect();
    $sql = "INSERT INTO category(Name) VALUES (:name)";
    $cmd = $database->prepare($sql);
    $cmd->bindValue(":name", $name);
    return $cmd->execute();
}
function updateCategory($id, $name){
    $database = DATABASE::connect();
    $sql = "UPDATE category SET Name=:name WHERE Id=:id";
    $cmd = $database->prepare($sql);
    $cmd->bindValue(":name", $name);
    $cmd->bindValue(":id", $id);
    return $cmd->execute();
}
function deleteCategory($id){
    $database = DATABASE::connect();

    $sql = "UPDATE manga_category SET Id_category=NULL WHERE Id_category=:id";
    $cmd = $database->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();

    $sql = "DELETE FROM category WHERE Id=:id";
    $cmd = $database->prepare($sql);
    $cmd->bindValue(":id", $id);
    return $cmd->execute();
}

function getUsers(){
    $database = DATABASE::connect();
    $sql = "SELECT * FROM users";
    $cmd = $database->prepare($sql);
    $cmd->execute();
    return $cmd->fetchAll();
}

function lockUser($id, $lock){
    $database = DATABASE::connect();
    $sql = "UPDATE users SET LockUser=:lockuser WHERE Id=:id";
    $cmd = $database->prepare($sql);
    $cmd->bindValue(":lockuser", $lock);
    $cmd->bindValue(":id", $id);
    return $cmd->execute();
}