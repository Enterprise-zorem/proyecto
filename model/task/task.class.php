<?php

class task
{
    private static $tablename = "task";

    private $con;

    private $pk_task;
    private $name;
    private $descripcion;
    private $duration;
    private $progress;
    private $start_date;
    private $parent;
    private $sortorder;
    private $created_at;
    private $updated_at;
    private $fk_proyecto;
    private $fk_area;

    function __construct(Connexion $con)
    {
        $this->con = $con;
    }

    //variables
    public function setpk($name)
    {
        $this->pk_task = $this->con->real_escape_string($name);
    }
    public function setname($name)
    {
        $this->name = $this->con->real_escape_string($name);
    }
    public function setdescripcion($name)
    {
        $this->descripcion = $this->con->real_escape_string($name);
    }
    public function setduration($name)
    {
        $this->duration = $this->con->real_escape_string($name);
    }
    public function setprogress($name)
    {
        $this->progress = $this->con->real_escape_string($name);
    }
    public function setstart_date($name)
    {
        $this->start_date = $this->con->real_escape_string($name);
    }
    public function setparent($name)
    {
        $this->parent = $this->con->real_escape_string($name);
    }
    public function setsortorder($name)
    {
        $this->sortorder = $this->con->real_escape_string($name);
    }
    public function setcreated_at($name)
    {
        $this->created_at = $this->con->real_escape_string($name);
    }
    public function setupdated_at($name)
    {
        $this->updated_at = $this->con->real_escape_string($name);
    }
    public function setfk_proyecto($name)
    {
        $this->fk_proyecto = $this->con->real_escape_string($name);
    }
    public function setfk_area($name)
    {
        $this->fk_area = $this->con->real_escape_string($name);
    }
    

    
    //selecteds

    public function getAll()
    {
        $query = "SELECT * FROM " . self::$tablename . " ORDER BY pk_task DESC";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllById()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE pk_task=$this->pk_task";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByFkProyecto()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE fk_proyecto=$this->fk_proyecto";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByParent()
    {
        $query = "SELECT * FROM " . self::$tablename . " WHERE parent=$this->parent";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByFkProyectoTask()
    {
        $query = "SELECT count(pk_task) as count FROM " . self::$tablename . " WHERE fk_proyecto=$this->fk_proyecto";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    public function getAllByFkProyectoTaskComplete()
    {
        $query = "SELECT count(pk_task) as count FROM " . self::$tablename . " WHERE fk_proyecto=$this->fk_proyecto where progress='1.00'";
        $res = $this->con->query($query);
        mysqli_close($this->con);
        return $res;
    }
    //FUNCIONES
    public function insert()
    {

        $query = "INSERT INTO " . self::$tablename . " (`duration`, `progress`, `start_date`, `parent`, `created_at`, `updated_at`, `sortorder`, `name`, `descripcion`, `fk_proyecto`, `fk_area`)";

        $query .= " VALUES ('$this->duration','$this->progress','$this->start_date','$this->parent','$this->created_at','$this->updated_at','$this->sortorder','$this->name','$this->descripcion','$this->fk_proyecto','$this->fk_area')";

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
       
        $query = "UPDATE " . self::$tablename . "  SET `name`='$this->name', `start_date` = '$this->start_date', `duration` = '$this->duration',`fk_area` = '$this->fk_area',`updated_at`='$this->updated_at'";
        

        $query .= " WHERE pk_task='$this->pk_task'";
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
        $query = "DELETE FROM " . self::$tablename . " WHERE pk_task=$this->pk_task";
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