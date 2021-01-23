<?php

class usuario
{
    private static $tablename = "usuario";

    private $con;

    private $pk_usuario;
    private $nombres;
    private $dni;
    private $telefono;
    private $email;
    private $password;
    private $image;
    private $fk_area;
    private $created_at;
    private $updated_at;
    private $is_active;
    private $fk_rol;
    private $fk_job;
    private $parent;
    private $birth_date;


    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_usuario = $this->con->real_escape_string($name);
    }
    public function setnombres($name)
    {
        $this->nombres = $this->con->real_escape_string($name);
    }
    public function setdni($name)
    {
        $this->dni = $this->con->real_escape_string($name);
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
    public function setfkarea($name)
    {
        $this->fk_area = $this->con->real_escape_string($name);
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
    public function setfkjob($name)
    {
        $this->fk_job = $this->con->real_escape_string($name);
    }
    public function setparent($name)
    {
        $this->parent = $this->con->real_escape_string($name);
    }
    public function setfkrol($name)
    {
        $this->fk_rol = $this->con->real_escape_string($name);
    }
    public function setbirthdate($name)
    {
        $this->birth_date = $this->con->real_escape_string($name);
    }
    
    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_usuario DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_usuario=$this->pk_usuario";
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

        $query = "INSERT INTO " . self::$tablename . " ( `nombres`, `dni`, `telefono`, `email`, `password`, `image`, `fk_area`, `created_at`, `updated_at`, `is_active`, `fk_job`, `parent`, `fk_rol`, `birth_date`)";

        $query .= " VALUES ('$this->nombres','$this->dni','$this->telefono','$this->email','$this->password','$this->image','$this->fk_area','$this->created_at','$this->updated_at','$this->is_active','$this->fk_job','$this->parent','$this->fk_rol','$this->birth_date')";

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

        $query .= " WHERE pk_usuario='$this->pk_usuario'";
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
    public function update_perfil()
    {
        if (empty($this->password)) {
            $query = "UPDATE " . self::$tablename . "  SET `nombres`='$this->nombres',`dni`='$this->dni',`birth_date`='$this->birth_date',`telefono`='$this->telefono',`email`='$this->email',`fk_area`='$this->fk_area',`fk_job`='$this->fk_job',`updated_at`='$this->updated_at'";
        } else {
            $query = "UPDATE " . self::$tablename . "  SET `password`='$this->password',`nombres`='$this->nombres',`dni`='$this->dni',`birth_date`='$this->birth_date',`telefono`='$this->telefono',`email`='$this->email',`fk_area`='$this->fk_area',`fk_job`='$this->fk_job',`updated_at`='$this->updated_at'";
        }
        if(!empty($this->image))
        {
            $query.= ",`image`='$this->image'";
        }

        $query .= " WHERE pk_usuario='$this->pk_usuario'";
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
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_usuario=$this->pk_usuario";
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