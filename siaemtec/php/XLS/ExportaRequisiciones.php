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
ini_set('max_execution_time', 300);
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
 ->setCellValue('A'.$n, "ID_REQUISICION")
          
            ->setCellValue('B'.$n,"EDO_FUNCIONAL_EQUIPO")
			->setCellValue('C'.$n,"NOCONTROL")
			->setCellValue('D'.$n,"EQUIPO")
			->setCellValue('E'.$n,"MARCA")
            ->setCellValue('F'.$n,"MODELO")
            ->setCellValue('G'.$n,"SERIE")
            ->setCellValue('H'.$n,"ANIO")
			->setCellValue('I'.$n,"SERVICIO")
			->setCellValue('J'.$n,"UBICACION")
			->setCellValue('K'.$n,"ORDEN_SERVICIO")
			->setCellValue('L'.$n,"REQUISICION_POR")
            ->setCellValue('M'.$n,"EDO_REQUISICION")
            ->setCellValue('N'.$n,"FECHA_SOLICITUD_ALMACEN")
            ->setCellValue('O'.$n,"FECHA_SUMINISTRO")
			->setCellValue('P'.$n,"NUM_F")
			->setCellValue('Q'.$n,"requisicion")
			->setCellValue('R'.$n,"TIPO_SEGUIMIENTO")
			->setCellValue('S'.$n,"COMENTARIOS")
			->setCellValue('T'.$n,"REALIZO")
         ;
			

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

$sql = "select requisiciones.ID_REQUISICION,
        (case orden_servicio.FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA'
		when 'PARCIALMENTE' then 'PARCIALMENTE' else 'FUNCIONA' end) AS EDO_FUNCIONAL_EQUIPO,
		orden_servicio.NOCONTROL AS NOCONTROL,orden_servicio.EQUIPO AS EQUIPO,orden_servicio.MARCA 
		AS MARCA,orden_servicio.MODELO AS MODELO,orden_servicio.SERIE AS SERIE,
		year(orden_servicio.FECHA_ATENCION) AS ANIO, equipoinventario.AREA AS UBICACION,  equipoinventario.SERVICIO AS SERVICIO,
		requisiciones.ORDEN_SERVICIO AS ORDEN_SERVICIO,
		requisiciones.REQUISICION_POR AS REQUISICION_POR, requisiciones.EDO_REQUISICION AS EDO_REQUISICION,
		requisiciones.FECHA_SOLICITUD_ALMACEN AS FECHA_SOLICITUD_ALMACEN,requisiciones.FECHA_SUMINISTRO AS FECHA_SUMINISTRO,
		requisiciones.NUM_F AS NUM_F,requisiciones.requisicion AS requisicion,requisiciones.TIPO_SEGUIMIENTO AS TIPO_SEGUIMIENTO,
		requisiciones.COMENTARIOS AS COMENTARIOS,requisiciones.REALIZO AS REALIZO from orden_servicio RIGHT join equipoinventario ON orden_servicio.ID_EQUIPO = equipoinventario.ID_EQUIPO_INVENTARIO		RIGHT join requisiciones on orden_servicio.NO_ORDEN = requisiciones.ORDEN_SERVICIO WHERE requisiciones.EDO_REQUISICION !='DUPLICADO'
";
$result = $conn->query($sql);
$n=2;
if ($result->num_rows > 0) {
    // output data of each row ''	''	''	''	'MARCA'	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	

    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["ID_EQUIPO_INVENTARIO"]. "<br>";
		$objPHPExcel->setActiveSheetIndex(0)
		   
             ->setCellValue('A'.$n, $row["ID_REQUISICION"])
            //->setCellValue('B'.$n,$row["FUERA_SERVICIO"])
            ->setCellValue('B'.$n,$row["EDO_FUNCIONAL_EQUIPO"])
			->setCellValue('C'.$n,strtoupper($row["NOCONTROL"]))
			->setCellValue('D'.$n,strtoupper($row["EQUIPO"]))
			->setCellValue('E'.$n,$row["MARCA"])
            ->setCellValue('F'.$n,$row["MODELO"])
            ->setCellValue('G'.$n,(string)$row["SERIE"])
            ->setCellValue('H'.$n,$row["ANIO"])
			->setCellValue('I'.$n,$row["SERVICIO"])
			->setCellValue('J'.$n,$row["UBICACION"])
			->setCellValue('K'.$n,$row["ORDEN_SERVICIO"])
			->setCellValue('L'.$n,$row["REQUISICION_POR"])
            ->setCellValue('M'.$n,($row["EDO_REQUISICION"]))
            ->setCellValue('N'.$n,$row["FECHA_SOLICITUD_ALMACEN"])
            ->setCellValue('O'.$n,$row["FECHA_SUMINISTRO"])
			->setCellValue('P'.$n,($row["NUM_F"]))
			->setCellValue('Q'.$n,$row["requisicion"])
			->setCellValue('R'.$n,$row["TIPO_SEGUIMIENTO"])
			->setCellValue('S'.$n,$row["COMENTARIOS"])
			->setCellValue('T'.$n,$row["REALIZO"])
			//->setCellValue('AB'.$n,$row[""])/**/ 
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
$objPHPExcel->getActiveSheet()->setTitle('Requisiciones');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Requisiciones.xlsx"');
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
