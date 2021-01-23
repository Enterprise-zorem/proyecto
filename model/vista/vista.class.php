<?php

class vista
{
    private static $tablename = "vista";

    private $con;

    private $pk_vista;
    private $vista;
    private $tipo;

    private $fk_rol;


    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_vista = $this->con->real_escape_string($name);
    }
    public function setvista($name)
    {
        $this->vista = $this->con->real_escape_string($name);
    }
    public function settipo($name)
    {
        $this->tipo = $this->con->real_escape_string($name);
    }
    public function setfk_rol($name)
    {
        $this->fk_rol = $this->con->real_escape_string($name);
    }
    
    
    
    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_vista DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllTipo($tipo)
    {
        $query = "SELECT * FROM " . self::$tablename . " where tipo='$tipo' ORDER BY pk_vista DESC ";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_vista=$this->pk_vista";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByVista()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE vista='$this->vista'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByRolVista()
    {
        $query = "SELECT * FROM rol_vista WHERE fk_rol=$this->fk_rol";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByVistaRol()
    {
        $query = "SELECT * FROM rol_vista WHERE fk_rol=$this->fk_rol and fk_vista=$this->pk_vista";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByRol()
    {
        $query = "SELECT * FROM rol_vista WHERE fk_rol=$this->fk_rol";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
  
    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " ( `vista`, `tipo`)";

        $query .= " VALUES ('$this->vista','$this->tipo')";

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
    public function insert_vista_rol()
    {

        $query = "INSERT INTO rol_vista ( `fk_rol`, `fk_vista`)";

        $query .= " VALUES ('$this->fk_rol','$this->pk_vista')";

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
       
        $query = "UPDATE " . self::$tablename . "  SET `name`='$this->name',`updated_at`='$this->updated_at'";
        

        $query .= " WHERE pk_vista='$this->pk_vista'";
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
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_vista=$this->pk_vista";
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
    public function delete_vista_rol()
    {
        $query = "DELETE FROM rol_vista WHERE id=$this->pk_vista";
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