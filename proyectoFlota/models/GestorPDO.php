<?php
class GestorPDO extends Connection{

    public function listar(){
        $consulta="SELECT * FROM flotaVehiculos";
        $rtdo=$this->getConn()->query($consulta);
        $vehiculos=[];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $vehiculo = new Vehiculo($value["marca"], $value["modelo"], $value["precioDia"], $value["id"]);
            $vehiculos[] = $vehiculo;
        }
        return $vehiculos;
    }

    public function agregar(Vehiculo $vehiculo){
        $sql = 'INSERT into flotaVehiculos (marca, modelo, precioDia) VALUES (:marca,:modelo,:precio)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':marca', $vehiculo->getMarca());
        $stmt->bindValue(':modelo', $vehiculo->getModelo());
        $stmt->bindValue(':precio', $vehiculo->getPrecioDia());
        return $stmt->execute();
    }

    public function eliminar($id){
        $sql = 'DELETE FROM flotaVehiculos WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function editar($id, $marca){
        $sql = 'UPDATE flotaVehiculos SET marca = :marca WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':marca', $marca);
        return $stmt->execute();
    }
}
