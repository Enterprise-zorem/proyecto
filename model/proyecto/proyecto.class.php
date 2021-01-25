<?php

class proyecto
{
    private static $tablename = "proyecto";

    private $con;

    private $pk_proyecto;
    private $name;
    private $descripcion;
    private $fecha_entrega;
    private $presupuesto;
    private $archivos;
    private $estado;
    private $progress;
    private $start_date;
    private $duration;
    private $priority;
    private $fk_cliente;
    private $created_at;
    private $updated_at;
    private $fk_usuario_lider;
    private $fk_usuario;



    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_proyecto = $this->con->real_escape_string($name);
    }
    public function setname($name)
    {
        $this->name = $this->con->real_escape_string($name);
    }
    public function setdescripcion($name)
    {
        $this->descripcion = $this->con->real_escape_string($name);
    }
    public function setfecha_entrega($name)
    {
        $this->fecha_entrega = $this->con->real_escape_string($name);
    }
    public function setpresupuesto($name)
    {
        $this->presupuesto = $this->con->real_escape_string($name);
    }
    public function setarchivos($name)
    {
        $this->archivos = $this->con->real_escape_string($name);
    }
    public function setestado($name)
    {
        $this->estado = $this->con->real_escape_string($name);
    }
    public function setprogress($name)
    {
        $this->progress = $this->con->real_escape_string($name);
    }
    public function setstart_date($name)
    {
        $this->start_date = $this->con->real_escape_string($name);
    }
    public function setduration($name)
    {
        $this->duration = $this->con->real_escape_string($name);
    }
    public function setpriority($name)
    {
        $this->priority = $this->con->real_escape_string($name);
    }
    public function setfk_cliente($name)
    {
        $this->fk_cliente = $this->con->real_escape_string($name);
    }
    public function setcreated_at($name)
    {
        $this->created_at = $this->con->real_escape_string($name);
    }
    public function setupdated_at($name)
    {
        $this->updated_at = $this->con->real_escape_string($name);
    }
    public function setfk_usuario_lider($name)
    {
        $this->fk_usuario_lider = $this->con->real_escape_string($name);
    }
    public function setfk_usuario($name)
    {
        $this->fk_usuario = $this->con->real_escape_string($name);
    }


    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_proyecto DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_proyecto=$this->pk_proyecto";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }

    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " (`name`, `descripcion`, `fecha_entrega`, `presupuesto`, `archivos`, `estado`, `progress`, `start_date`, `duration`, `created_at`, `updated_at`, `priority`, `fk_cliente`)";

        $query .= " VALUES ('$this->name','$this->descripcion','$this->fecha_entrega','$this->presupuesto','$this->archivos','$this->estado','$this->progress','$this->start_date','$this->duration','$this->created_at','$this->updated_at','$this->priority','$this->fk_cliente')";

        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            $id=mysqli_insert_id($this->con);
            mysqli_close($this->con);
            return $id;
        }
    }

    public function update_archivos()
    {

        $query = "UPDATE " . self::$tablename . "  SET `archivos`='$this->archivos'";


        $query .= " WHERE pk_proyecto='$this->pk_proyecto'";
        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }
    public function update_liders()
    {

        $query = "UPDATE " . self::$tablename . "  SET `fk_usuario_lider`='$this->fk_usuario_lider'";


        $query .= " WHERE pk_proyecto='$this->pk_proyecto'";
        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }
    public function update_users()
    {

        $query = "UPDATE " . self::$tablename . "  SET `fk_usuario`='$this->fk_usuario'";

        $query .= " WHERE pk_proyecto='$this->pk_proyecto'";
        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }

    public function delete()
    {
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_proyecto=$this->pk_proyecto";
        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }

    public function update()
    {
       
        $query = "UPDATE " . self::$tablename . "  SET `name`='$this->name', `descripcion`='$this->descripcion', `start_date` = '$this->start_date', `duration` = '$this->duration', `presupuesto`= '$this->presupuesto',`updated_at`='$this->updated_at', `fk_cliente`='$this->fk_cliente'";
        

        $query .= " WHERE pk_proyecto='$this->pk_proyecto'";
        $this->con->query($query);

        if (mysqli_error($this->con)) {
            $result = mysqli_error($this->con);
            mysqli_close($this->con);
            return $result;
        } else {
            mysqli_close($this->con);
            return "defaultValue";
        }
    }
}
