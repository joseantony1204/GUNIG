<?php 
class FormatearFechas{
 
 public $dia;
 public $mes;
 public $anio;
 public $fecha;
 
 public function obtenerNombreMes($numero){
  switch ($numero){
    case 1: return "Enero";
    case 2: return "Febrero";
    case 3: return "Marzo";
    case 4: return "Abril";
    case 5: return "Mayo";
    case 6: return "Junio";
    case 7: return "Julio";
    case 8: return "Agosto";
    case 9: return "Septiembre";
    case 10: return "Octubre";
    case 11: return "Noviembre";
    case 12: return "Diciembre";
   }
  
}
	
public function fechaLarga($fecha){
  
  $this->dia = date("d",strtotime($fecha));
  $this->mes= $this->obtenerNombreMes(date("m",strtotime($fecha)));
  $this->anio=date("Y",strtotime($fecha));
  $this->fecha =  $this->dia." de ".$this->mes." de ".$this->anio;
  }
}
?>