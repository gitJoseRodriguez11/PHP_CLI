<?php
class Alumno
{
  private $id;
  private $nombre_completo;
  private $rut;
  private $f_nacimiento;
  private $correo;
  private $telefono;

  public function __construct($id, $nombre_completo, $rut, $f_nacimiento, $correo, $telefono)
  {
    $this->id = $id;
    $this->nombre_completo = $nombre_completo;
    $this->rut = $rut;
	$this->f_nacimiento = $f_nacimiento;
	$this->correo = $correo;
	$this->telefono = $telefono;
  }
 
  public function id()
  {
    return $this->id;
  }
 
  public function nombre_completo()
  {
    return $this->nombre_completo;
  }
 
  public function rut()
  {
    return $this->rut;
  }
  
  public function f_nacimiento()
  {
    return $this->f_nacimiento;
  }
  
  public function correo()
  {
    return $this->correo;
  }
  
  public function telefono()
  {
    return $this->telefono;
  }
}
?>