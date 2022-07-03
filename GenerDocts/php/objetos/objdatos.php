<?php

class Datos 
{
  public $datos;
  public $plantillas;

  function __construct($arrdatos,$arrplantillas) 
  {
    $this->datos = $arrdatos;
    $this->plantillas = $arrPlantillas;
  }

  public function datosParaPlantillas()
  {
    $datos = $this->datos;
    $arrPlantillas = $this->plantillas;
    // $arrPlantillas = array('plantillaEST','plantillaMAG','plantillaMCP','plantillaMAP','plantillaMDP','plantillaEncuesta','plantillaSE','plantillaAnalisisFac');
  //   $plantillas = array('plantillas' => array(  'plantillasv9' => array('plantilla' => 'plantillaEST',
  //                                                               'nombre' => 'EST-'.$datosEntrada['folio'].'-'.$datosEntrada['nomFolio'],
  //                                                               'folio' => $datosEntrada['folio'],
  //                                                               'pestana' => 'Requerimientos',
  //                                                               'celda' =>  array('B5'),
  //                                                               'valorCelda'    =>  array($datosEntrada['nomFolio']),                                                            
  //                                                               ),

  }


}