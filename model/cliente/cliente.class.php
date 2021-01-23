<?php

class cliente
{
    private static $tablename = "cliente";

    private $con;

    private $pk_cliente;
    private $nombres;
    private $apellidos;
    private $identificacion;
    private $telefono;
    private $email;
    private $password;
    private $image;
    private $created_at;
    private $updated_at;
    private $is_active;
    private $cliente_id;


    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_cliente = $this->con->real_escape_string($name);
    }
    public function setnombres($name)
    {
        $this->nombres = $this->con->real_escape_string($name);
    }
    public function setapellidos($name)
    {
        $this->apellidos = $this->con->real_escape_string($name);
    }
    public function setidentificacion($name)
    {
        $this->identificacion = $this->con->real_escape_string($name);
    }
    public function settelefono($name)
    {
        $this->telefono = $this->con->real_escape_string($name);
    }
    public function setemail($name)
    {
        $this->email = $this->con->real_escape_string($name);
    }
    public function setpassword($name)
    {
        $this->password = $this->con->real_escape_string($name);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
    public function setimage($name)
    {
        $this->image = $this->con->real_escape_string($name);
    }
    public function setclienteid($name)
    {
        $this->cliente_id = $this->con->real_escape_string($name);
    }
    public function setcreated_at($name)
    {
        $this->created_at = $this->con->real_escape_string($name);
    }
    public function setupdated_at($name)
    {
        $this->updated_at = $this->con->real_escape_string($name);
    }
    public function setis_active($name)
    {
        $this->is_active = $this->con->real_escape_string($name);
    }
   
    
    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_cliente DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_cliente=$this->pk_cliente";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByEmail()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE email='$this->email'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " ( `nombres`, `apellidos`, `identificacion`, `telefono`, `email`, `password`, `cliente_id`, `is_active`, `created_at`, `updated_at`, `image`)";

        $query .= " VALUES ('$this->nombres','$this->apellidos','$this->identificacion','$this->telefono','$this->email','$this->password','$this->cliente_id','$this->is_active','$this->created_at','$this->updated_at','$this->image')";

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
    
    public function update()
    {
        if (empty($this->password)) {
            $query = "UPDATE " . self::$tablename . "  SET `direccion`='$this->direccion',`nombres`='$this->nombres',`telefono`='$this->telefono',`identificacion`='$this->identificacion',`correo`='$this->correo'";
        } else {
            $query = "UPDATE " . self::$tablename . "  SET `direccion`='$this->direccion',`nombres`='$this->nombres',`telefono`='$this->telefono',`identificacion`='$this->identificacion',`correo`='$this->correo',`password`='$this->password'";
        }

        $query .= " WHERE pk_cliente='$this->pk_cliente'";
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
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_cliente=$this->pk_cliente";
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