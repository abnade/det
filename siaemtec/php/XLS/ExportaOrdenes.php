<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('max_execution_time', 500);
ini_set('memory_limit','200M');
//date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("SIAEM")
							 ->setLastModifiedBy("Desarrollo Tecnológico")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription(" XLSX, generated using SIAEM.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data 
$n=1;
$objPHPExcel->setActiveSheetIndex(0)
		   	->setCellValue('A'.$n, "NO_ORDEN")
            ->setCellValue('B'.$n,"TRANSITO_POR")
            ->setCellValue('C'.$n,"NOCONTROL")
			->setCellValue('D'.$n,strtoupper("EQUIPO"))
			->setCellValue('E'.$n,strtoupper("SERIE "))
			->setCellValue('F'.$n,"NOINVENTARIO")
            ->setCellValue('G'.$n,"MARCA")
            ->setCellValue('H'.$n,"MODELO")
            ->setCellValue('I'.$n,"SERVICIO")
			->setCellValue('J'.$n,"UBICACION")
			->setCellValue('K'.$n,"ACCESORIOS_ADICIONALES")
            ->setCellValue('L'.$n,("FECHA_REPORTE"))
            ->setCellValue('M'.$n,"HORA_REPORTE")
            ->setCellValue('N'.$n,"EXTENSION")
			->setCellValue('O'.$n,("FALLA_REPORTE"))
			->setCellValue('P'.$n,"DESCRIPCION_REPORTE")
			->setCellValue('Q'.$n,"ING_RECIBE")
            ->setCellValue('R'.$n,"FECHA_SERVICIO")
            ->setCellValue('S'.$n,("FECHA_SERVICIO"))
			->setCellValue('T'.$n,("HORA"))
			->setCellValue('U'.$n,("DETALLE_SERVICIO"))
			->setCellValue('V'.$n,(string)(str_replace(',','',"DETALLE_SERVICIO")))
			 ->setCellValue('X'.$n,(string)"FUERA_SERVICIO")
			->setCellValue('Y'.$n,(string)"DESCRIPCION_SERVICIO")  
			->setCellValue('Z'.$n,"TIPO_EXTERNO")
			->setCellValue('AA'.$n,"ING_REALIZA") 
			->setCellValue('AB'.$n,"ING_EXTERNO")/**/ 
			->setCellValue('AB'.$n,"EMPRESA")/**/ 
			->setCellValue('AC'.$n,"FALLA_ENCONTRADA")/**/ 
			->setCellValue('AD'.$n,"OTRA_FALLA")/**/ 
			->setCellValue('AE'.$n,"REPARACION_REALIZADA")/**/ 
			->setCellValue('AF'.$n,"HORAS_EMPLEADAS")/**/ 
			->setCellValue('AG'.$n,"COMENTARIOS")/**/ 
			->setCellValue('AH'.$n,"REFACCIONES")/**/ 
			->setCellValue('AI'.$n,"FECHA_ENTREGA")/**/ 
			->setCellValue('AJ'.$n,"HORA_ENTREGA")/**/ 
			->setCellValue('AK'.$n,"ING_SUPERVISA")/**/ 
			->setCellValue('AL'.$n,"ING_ENTREGA")/**/ 
			->setCellValue('AM'.$n,"NOTA_IMPORTANTE")/**/
			->setCellValue('AN'.$n,"NOTA_IMPORTANTE")/**/
			->setCellValue('AO'.$n,"NOMBRE_RECIBE")/**/
			->setCellValue('AP'.$n,"FECHA_ATENCION")/**/
			->setCellValue('AQ'.$n,"HORA_ATENCION")/**/
			->setCellValue('AR'.$n,"INSTRUMENTOS");
			

$servername = "localhost";
$username = "root";
$password = "laura";
$dbname = "siaem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Change character set to utf8
mysqli_set_charset($conn,"utf8");
$sql = "SELECT orden_servicio.NO_ORDEN, orden_servicio.TRANSITO_POR	,orden_servicio.ESTADO, orden_servicio.NOCONTROL, orden_servicio.EQUIPO, orden_servicio.SERIE , orden_servicio.NOINVENTARIO, orden_servicio.MARCA, orden_servicio.MODELO, equipoinventario.SERVICIO, equipoinventario.AREA AS UBICACION, orden_servicio.ACCESORIOS_ADICIONALES, orden_servicio.FECHA_REPORTE, orden_servicio.HORA_REPORTE, orden_servicio.NOMBRE_SOLICITANTE, orden_servicio.EXTENSION, orden_servicio.FALLA_REPORTE, orden_servicio.DESCRIPCION_REPORTE, orden_servicio.ING_RECIBE, orden_servicio.FECHA_SERVICIO, orden_servicio.HORA, orden_servicio.DETALLE_SERVICIO, orden_servicio.DETALLE_SERVICIO, orden_servicio.FUERA_SERVICIO, orden_servicio.DESCRIPCION_SERVICIO, orden_servicio.TIPO_EXTERNO, orden_servicio.ING_REALIZA, orden_servicio.ING_EXTERNO, orden_servicio.EMPRESA, orden_servicio.FALLA_ENCONTRADA, orden_servicio.OTRA_FALLA, orden_servicio.REPARACION_REALIZADA, orden_servicio.HORAS_EMPLEADAS, orden_servicio.COMENTARIOS, orden_servicio.REFACCIONES, orden_servicio.FECHA_ENTREGA, orden_servicio.HORA_ENTREGA, orden_servicio.ING_SUPERVISA, orden_servicio.ING_ENTREGA, orden_servicio.NOTA_IMPORTANTE, orden_servicio.NOMBRE_RECIBE, orden_servicio.FECHA_ATENCION, orden_servicio.HORA_ATENCION, orden_servicio.INSTRUMENTOS FROM orden_servicio, equipoinventario WHERE orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO ORDER BY orden_servicio.NO_ORDEN DESC LIMIT 1000";



$result = $conn->query($sql);
$n=2;
if ($result->num_rows > 0) {
    // output data of each row ''	''	''	''	'MARCA'	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	

    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["ID_EQUIPO_INVENTARIO"]. "<br>";
		$objPHPExcel->setActiveSheetIndex(0)
		    ->setCellValue('A'.$n, $row["NO_ORDEN"])
            ->setCellValue('B'.$n,$row["TRANSITO_POR"])
            ->setCellValue('C'.$n,$row["NOCONTROL"])
			->setCellValue('D'.$n,strtoupper($row["EQUIPO"]))
			->setCellValue('E'.$n,strtoupper($row["SERIE"]))
			->setCellValue('F'.$n,$row["NOINVENTARIO"])
            ->setCellValue('G'.$n,$row["MARCA"])
            ->setCellValue('H'.$n,$row["MODELO"])
            ->setCellValue('I'.$n,$row["SERVICIO"])
			->setCellValue('J'.$n,$row["UBICACION"])
			->setCellValue('K'.$n,$row["ACCESORIOS_ADICIONALES"])
            ->setCellValue('L'.$n,($row["FECHA_REPORTE"]))
            ->setCellValue('M'.$n,$row["HORA_REPORTE"])
            ->setCellValue('N'.$n,$row["EXTENSION"])
			->setCellValue('O'.$n,($row["FALLA_REPORTE"]))
			->setCellValue('P'.$n,$row["DESCRIPCION_REPORTE"])
			->setCellValue('Q'.$n,$row["ING_RECIBE"])
            ->setCellValue('R'.$n,$row["FECHA_SERVICIO"])
            ->setCellValue('S'.$n,($row["FECHA_SERVICIO"]))
			->setCellValue('T'.$n,($row["HORA"]))
			->setCellValue('U'.$n,($row["DETALLE_SERVICIO"]))
			->setCellValue('V'.$n,(string)(str_replace(',','',$row["DETALLE_SERVICIO"])))
			 ->setCellValue('X'.$n,(string)$row["FUERA_SERVICIO"])
			->setCellValue('Y'.$n,(string)$row["DESCRIPCION_SERVICIO"])  
			->setCellValue('Z'.$n,$row["TIPO_EXTERNO"])
			->setCellValue('AA'.$n,'"'.$row["ING_REALIZA"].'"') 
			->setCellValue('AB'.$n,$row["ING_EXTERNO"])/**/ 
			->setCellValue('AB'.$n,$row["EMPRESA"])/**/ 
			->setCellValue('AC'.$n,$row["FALLA_ENCONTRADA"])/**/ 
			->setCellValue('AD'.$n,$row["OTRA_FALLA"])/**/ 
			->setCellValue('AE'.$n,$row["REPARACION_REALIZADA"])/**/ 
			->setCellValue('AF'.$n,$row["HORAS_EMPLEADAS"])/**/ 
			->setCellValue('AG'.$n,$row["COMENTARIOS"])/**/ 
			->setCellValue('AH'.$n,$row["REFACCIONES"])/**/ 
			->setCellValue('AI'.$n,$row["FECHA_ENTREGA"])/**/ 
			->setCellValue('AJ'.$n,$row["HORA_ENTREGA"])/**/ 
			->setCellValue('AK'.$n,$row["ING_SUPERVISA"])/**/ 
			->setCellValue('AL'.$n,$row["ING_ENTREGA"])/**/ 
			->setCellValue('AM'.$n,$row["NOTA_IMPORTANTE"])/**/
			->setCellValue('AN'.$n,$row["NOTA_IMPORTANTE"])/**/
			->setCellValue('AO'.$n,$row["NOMBRE_RECIBE"])/**/
			->setCellValue('AP'.$n,$row["FECHA_ATENCION"])/**/
			->setCellValue('AQ'.$n,$row["HORA_ATENCION"])/**/
			->setCellValue('AR'.$n,$row["INSTRUMENTOS"])/**/
			;
			
			$n=$n+1;
    }
} else {
    echo "0 results";
}
$conn->close();


/*Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');*/

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('ORDENES');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ORDENES.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
