<?php
class GestorPDO extends Connection
{
    public function listar()
    {
        $consulta = "SELECT * FROM flotaVehiculos";
        $rtdo = $this->getConn()->query($consulta);
        $vehiculos = [];

        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $vehiculo = new Vehiculo(
                $value["marca"],
                $value["modelo"],
                $value["precioDia"],
                $value["id"]
            );
            $vehiculos[] = $vehiculo;
        }

        return $vehiculos;
    }

    public function agregar(Vehiculo $vehiculo)
    {
        $sql = "INSERT INTO flotaVehiculos (marca, modelo, precioDia) 
                VALUES (:marca, :modelo, :precioDia)";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':marca', $vehiculo->getMarca());
        $stmt->bindValue(':modelo', $vehiculo->getModelo());
        $stmt->bindValue(':precioDia', $vehiculo->getPrecioDia());

        return $stmt->execute();
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM flotaVehiculos WHERE id = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function editar($id, $marca)
    {
        $sql = "UPDATE flotaVehiculos SET marca = :marca WHERE id = :id";
        $stmt = $this->getConn()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':marca', $marca);

        return $stmt->execute();
    }

    public function registrarUsuario(Usuario $usuario)
    {
        try {
            $sql = "INSERT INTO Usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al registrar usuario: " . $e->getMessage();
            return false;
        }
    }

    public function buscarUsuarioPorEmail($email)
    {
        try {
            $sql = "SELECT * FROM Usuario WHERE email = :email LIMIT 1";
            $stmt = $this->getConn()->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($fila) {
                return new Usuario($fila['email'], $fila['password'], $fila['id']);
            }

            return false;
        } catch (PDOException $e) {
            echo "Error al buscar usuario: " . $e->getMessage();
            return false;
        }
    }
}
?>