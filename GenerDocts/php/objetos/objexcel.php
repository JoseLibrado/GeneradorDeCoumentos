<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


require_once 'vendor/autoload.php';

class ObjetoDeDatos
{
    // atirbutos  
    public $datos    =  array();

    function  __construct($arrDatos)
    {
        $this->datos = $arrDatos;
    }

    public function validarPlantillas($plantilla)
    {
        $rutaPlantilla = '..\\assets\\plantillas\\';
        $rutaPlantilla = strval($rutaPlantilla).strval($plantilla).'.xlsx';
        if(file_exists($rutaPlantilla))
        {
            return $rutaPlantilla;
        } else {
            return false;
        }
    }

    public function crearDocumento()
    {
        $datosCaptura = $this->datos;
        $documentosArr = array();
        foreach ($datosCaptura as $key => $value)
        {
            $respuesta = $this->agregarDatosPlantilla($value['plantilla'],
            $value['nombre'],
            $value['datos']);     // = [[obj],[obj]] 
            
            array_push($documentosArr,array('plantilla' => $respuesta['datos']['nombre'],'respuesta' => $respuesta['respuesta'],'mensaje' => $respuesta['mensaje']));

        }
        return $documentosArr;
    }

    // public function agregarDatosPlantilla($plantilla,$pestana,$celda,$valorCelda,$nombreArchivo)
    public function agregarDatosPlantilla($plantilla,$nombreArchivo,$datos)
    {

        if($template = $this->validarPlantillas($plantilla))
        {
            try 
            {
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
                $spreadsheet = $reader->load(strval($template));
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                // $sheet = $spreadsheet->getActiveSheet($datos);
                // $sheet->setCellValue($celda, $valorCelda);

                for ( $i = 0 ; count ( $datos ) > $i ; $i++ ) 
                {
                    $sheet = $spreadsheet->getActiveSheet($datos[$i]['pestana']);

                    for ( $x = 0 ; count( $datos[$i]['celda'] ) > $x ; $x++ ) 
                    {
                        $sheet->setCellValue($datos[$i]['celda'][$x], $datos[$i]['valorCelda'][$x]);
                    }
                }
                
                $writer->save('..\\documentos\\'.strval($nombreArchivo).'.xlsx');

                return $respuesta = array(  'respuesta'  => '1',
                                            'mensaje'   => 'Se genero documento sin fallos',
                                            'datos'     => array('nombre' => $nombreArchivo ));
            }
            catch (Exception $e) {
                return $respuesta = array(  'respuesta'  => '-1',
                                            'mensaje'   => 'Ocurrio un error al intentar editar la plantilla ' . $e,
                                            'datos'     => array('nombre' => $nombreArchivo ));
            }  

            
        } else {
            return $respuesta = array(  'respuesta'  => '-1',
                                            'mensaje'   => 'No existe la plantilla ',
                                            'datos'     => array('nombre' => $nombreArchivo ));
            
        }

    }
}