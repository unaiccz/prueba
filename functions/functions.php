<?php
include_once 'db/db_config.php';
$conn = db_connect();
function get_all_contacts(){
    global $conn;
    $sql = "select nombre_contacto,telefono,nombre_mascota as 'Mascota', nombre_restaurante as 'restaurante favorito' from contactos LEFT join mascotas on contactos.id_mascota = mascotas.id_mascota inner join restaurantes on contactos.id_restaurante = restaurantes.id_restaurante;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
function Add_contacto($conn,$nombre_contacto,$telefono,$id_mascota,$id_restaurante){
    try{
        $sql = "insert into contactos(nombre_contacto,telefono,id_mascota,id_restaurante) values(:nombre_contacto,:telefono,:id_mascota,:id_restaurante)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_contacto',$nombre_contacto);
        $stmt->bindParam(':telefono',$telefono);
        $stmt->bindParam(':id_mascota',$id_mascota);
        $stmt->bindParam(':id_restaurante',$id_restaurante);
        $stmt->execute();
        echo "Contacto agregado correctamente";
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
function delete_masco($conn,$id){
    try{
        $conn->beginTransaction();
        $sql = "delete from mascotas where id_mascota = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $sql2 = "update contactos set id_mascota = 0 where id_mascota = :id";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':id',$id);
        $stmt2->execute();
        $conn->commit();
        echo "Mascota eliminada correctamente";
    }catch(PDOException $e){
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    }
    function update_mascota_contacto($conn,$id_mascota,$id_contacto){
        try{
            $sql = "update contactos set id_mascota = :id_mascota where id_contacto = :id_contacto";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_mascota',$id_mascota);
            $stmt->bindParam(':id_contacto',$id_contacto);
            $stmt->execute();
            echo "Mascota actualizada correctamente";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }