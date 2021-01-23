<?php

class notification
{
    private static $tablename = "notification";

    private $con;

    private $pk_notification;
    private $fk_rol_name;
    private $name;
    private $created_at;
    private $is_active;
    private $link;
    private $fk_usuario;
    private $is_view;

    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_notification = $this->con->real_escape_string($name);
    }
    public function setfkrolname($name)
    {
        $this->fk_rol_name = $this->con->real_escape_string($name);
    }
    public function setname($name)
    {
        $this->name = $this->con->real_escape_string($name);
    }
    public function setcreated_at($name)
    {
        $this->created_at = $this->con->real_escape_string($name);
    }
    public function setis_active($name)
    {
        $this->is_active = $this->con->real_escape_string($name);
    }
    public function setlink($name)
    {
        $this->link = $this->con->real_escape_string($name);
    }
    public function setfkusuario($name)
    {
        $this->fk_usuario = $this->con->real_escape_string($name);
    }
    public function setis_view($name)
    {
        $this->is_view = $this->con->real_escape_string($name);
    }
    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_notification DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllTrue()
    {
        $query = "SELECT * FROM " . self::$tablename . " where   is_active=1 and fk_rol_name='$this->fk_rol_name' or fk_rol_name='all'  ORDER BY pk_notification DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllTable()
    {
        $query = "SELECT * FROM " . self::$tablename . " where   fk_rol_name='$this->fk_rol_name' or  fk_rol_name='all' ORDER BY pk_notification DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_notification=$this->pk_notification";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
  
    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " ( `fk_rol_name`, `fk_usuario`, `name`, `created_at`, `link`, `is_view`)";

        $query .= " VALUES ('$this->fk_rol_name','$this->fk_usuario','$this->name','$this->created_at','$this->link','$this->is_view')";

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
       
        $query = "UPDATE " . self::$tablename . "  SET `is_view`='$this->is_view'";
        

        $query .= " WHERE pk_notification='$this->pk_notification'";
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
    public function clear()
    {
       
        $query = "UPDATE " . self::$tablename . "  SET `is_active`='0'";
        

        $query .= " WHERE fk_usuario='$this->fk_usuario'";
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
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_notification=$this->pk_notification";
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