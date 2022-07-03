<?php

include_once('objetos/objapi.php');
include_once('objetos/objdatos.php');
include_once('objetos/objexcel.php');

$fecha  = getdate();
//datos de entrada.

$datosEntrada   =   array();
isset($_POST['version']) ? $datosEntrada['version'] = $_POST['version'] : $datosEntrada['version'] = '';
isset($_POST['folio']) ? $datosEntrada['folio'] = $_POST['folio'] : $datosEntrada['folio'] = '';
isset($_POST['area']) ? $datosEntrada['area'] = $_POST['area'] : $datosEntrada['area'] = '';
isset($_POST['sistema']) ? $datosEntrada['sistema'] = $_POST['sistema'] : $datosEntrada['sistema'] = '';
isset($_POST['modulo']) ? $datosEntrada['modulo'] = $_POST['modulo'] : $datosEntrada['modulo'] = '';
isset($_POST['opcion']) ? $datosEntrada['opcion'] = $_POST['opcion'] : $datosEntrada['opcion'] = '';
isset($_POST['nomFolio']) ? $datosEntrada['nomFolio'] = $_POST['nomFolio'] : $datosEntrada['nomFolio'] = '';
isset($_POST['nomUsuario']) ? $datosEntrada['nomUsuario'] = $_POST['nomUsuario'] : $datosEntrada['nomUsuario'] = '';
isset($_POST['nomTester']) ? $datosEntrada['nomTester'] = $_POST['nomTester'] : $datosEntrada['nomTester'] = '';

$plantillas = array('plantillas' => array(  'plantillaEST' => array('plantilla' => 'plantillaEST',
                                                                'nombre' => 'EST-'.$datosEntrada['folio'].'-'.$datosEntrada['nomFolio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Requerimientos',
                                                                                    'celda' =>  array('B5'),
                                                                                    'valorCelda'    =>  array($datosEntrada['nomFolio'])
                                                                                    ),
                                                                                ),                                                            
                                                                ),
                                        'plantillaMAG'=>  array('plantilla' => 'plantillaMAG',
                                                                'nombre' => 'MAMB-'.$datosEntrada['folio'].'-'.$datosEntrada['nomFolio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Ambigüedades',
                                                                                    'celda' =>  array('D6','D7'),
                                                                                    'valorCelda'    =>  array($datosEntrada['folio'].'-'.$datosEntrada['nomFolio'],$datosEntrada['nomTester']),                                                            
                                                                                    ),
                                                                                ),
                                                                ),
                                        'plantillaMCP'=>  array('plantilla' => 'plantillaMPC',
                                                                'nombre' => 'MCP-SIT-'.$datosEntrada['nomFolio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Escenarios',
                                                                                    'celda' =>  array('C4','C5','F4','F5','H4','H5'),
                                                                                    'valorCelda'    =>  array($datosEntrada['area'].'_'.$datosEntrada['sistema'],$datosEntrada['modulo'].'_'.$datosEntrada['opcion'],$datosEntrada['nomTester'],$fecha['wday'].'-'.$fecha['mon'].'-'.$fecha['year'],$datosEntrada['folio'],$datosEntrada['nomFolio']),                                                            
                                                                                    ),
                                                                                ),
                                                            ),
                                        'plantillaMAP'=>  array('plantilla' => 'plantillaMAP',
                                                                'nombre' => 'MAP-'.$datosEntrada['folio'].'-'.$datosEntrada['nomFolio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Matriz',
                                                                                    'celda' =>  array('C3','C4','C5','C6','C7'),
                                                                                    'valorCelda'    =>  array($datosEntrada['folio'],$datosEntrada['nomFolio'],$datosEntrada['nomTester'],$datosEntrada['area'],$datosEntrada['nomTester']),                                                            
                                                                                    ),
                                                                                ),
                                                            ),
                                        'plantillaMDP'=>  array('plantilla' => 'plantillaMDP',
                                                                'nombre' => 'MDP-SIT-01 de MCP correspondiente-'.$datosEntrada['nomFolio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Matriz de Datos',
                                                                                    'celda' =>  array('C3','C4','C5'),
                                                                                    'valorCelda'    =>  array($datosEntrada['folio'],$datosEntrada['nomFolio'],$datosEntrada['nomTester']),                                                            
                                                                                    ),
                                                                                ),                                                           
                                                            ),
                                        'plantillaEncuesta'=>  array('plantilla' => 'plantillaEncuesta',
                                                                'nombre' => 'EncuestaAut-'.$datosEntrada['folio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Factibilidad',
                                                                                    'celda' =>  array('D5','D6','G5','G6','K5','K6'),
                                                                                    'valorCelda'    =>  array($datosEntrada['area'].'/'.$datosEntrada['sistema'],$datosEntrada['modulo'].'/'.$datosEntrada['opcion'],$datosEntrada['nomTester'],$fecha['mday'].'-'.$fecha['mon'].'-'.$fecha['year'],$datosEntrada['folio'],$datosEntrada['nomFolio']),                                                            
                                                                                    ),
                                                                                ),                                                           
                                                            ),
                                        'plantillaSE'=>  array('plantilla' => 'plantillaSE',
                                                                'nombre' => 'SE-'.$datosEntrada['folio'].'-'.$datosEntrada['nomFolio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Registro de Ejecución',
                                                                                    'celda' =>  array('B6'),
                                                                                    'valorCelda'    =>  array($datosEntrada['folio'].' '.$datosEntrada['nomFolio']),                                                            
                                                                                    ),
                                                                                ),                                                          
                                                            ),                                                              
                                        'plantillaAnalisisFac'=>  array('plantilla' => 'plantillaAnalisisFac',
                                                                'nombre' => 'AFACT-'.$datosEntrada['folio'],
                                                                'folio' => $datosEntrada['folio'],
                                                                'datos' => array(
                                                                                array(
                                                                                    'pestana' => 'Factibilidad',
                                                                                    'celda' =>  array('D5','D6','G5','G6','J5','J6'),
                                                                                    'valorCelda'    =>  array($datosEntrada['area'].'/'.$datosEntrada['sistema'],$datosEntrada['modulo'].'/'.$datosEntrada['opcion'],$datosEntrada['nomTester'],$fecha['mday'].'-'.$fecha['mon'].'-'.$fecha['year'],$datosEntrada['folio'],$datosEntrada['nomFolio']),                                                            
                                                                                    ),
                                                                                ),                                                           
                                                            ),
                                    ),
                                );

$objDatos = new ObjetoDeDatos( $plantillas['plantillas'] );
try {
    $respuesta = $objDatos->crearDocumento();
    echo json_encode(array('datos' => $respuesta));
    
}
catch(Exceptios $e)
{
    echo($e->error_get_last);
}