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
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NOCONTROL')
            ->setCellValue('B1', 'NOINVENTARIO')
            ->setCellValue('C1', 'EQUIPO')
			->setCellValue('D1', 'MARCA')
			->setCellValue('E1', 'MODELO')
			->setCellValue('F1', 'SERIE')
            ->setCellValue('G1', 'SERVICIO')
			->setCellValue('H1', 'UBICACION')
            ->setCellValue('I1', 'NO_ORDEN')
            ->setCellValue('J1', 'NO_DICTAMEN')
			->setCellValue('K1', 'FECHA_DICTAMEN')
			->setCellValue('L1', 'DICTAMEN_TECNICO_DE')
            ->setCellValue('M1', 'ANIOS_USO')
            ->setCellValue('N1', 'DICTAMEN')
            ->setCellValue('O1', 'ELABORADO_POR')
			->setCellValue('P1', 'RECIBE')
			->setCellValue('Q1', 'JEFEDEAREA')
			->setCellValue('R1', 'EDO_DICTAMEN')
			;
			

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "siaem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Change character set to utf8
mysqli_set_charset($conn,"utf8");

$sql = "SELECT orden_servicio.NOCONTROL, orden_servicio.NOINVENTARIO, orden_servicio.EQUIPO, orden_servicio.MARCA, orden_servicio.MODELO, orden_servicio.SERIE, equipoinventario.AREA AS SERVICIO, equipoinventario.SERVICIO AS UBICACION, orden_servicio.NO_ORDEN, dictamenes.NO_DICTAMEN, orden_servicio.FECHA_ATENCION AS FECHA_DICTAMEN, dictamenes.DICTAMEN_TECNICO_DE, dictamenes.ANIOS_USO, dictamenes.DICTAMEN, orden_servicio.ING_REALIZA AS ELABORADO_POR, dictamenes.RECIBE, dictamenes.JEFEDEAREA, dictamenes.EDO_DICTAMEN FROM orden_servicio, dictamenes, equipoinventario WHERE orden_servicio.NO_ORDEN=dictamenes.NO_ORDEN AND equipoinventario.NO_CONTROL=orden_servicio.NOCONTROL ORDER BY `orden_servicio`.`FECHA_ATENCION` ASC";//SELECT orden_servicio.NOCONTROL, orden_servicio.NOINVENTARIO, orden_servicio.EQUIPO, orden_servicio.MARCA, orden_servicio.MODELO, orden_servicio.SERIE, orden_servicio.AREA_SERVICIO, orden_servicio.NO_ORDEN, dictamenes.NO_DICTAMEN, dictamenes.FECHA_DICTAMEN, dictamenes.DICTAMEN_TECNICO_DE, dictamenes.ANIOS_USO, dictamenes.DICTAMEN, dictamenes.ELABORADO_POR, dictamenes.RECIBE, dictamenes.JEFEDEAREA, dictamenes.EDO_DICTAMEN FROM orden_servicio, dictamenes WHERE orden_servicio.NO_ORDEN=dictamenes.NO_ORDEN";

$result = $conn->query($sql);
$n=2;
if ($result->num_rows > 0) {
    // output data of each row ''	''	''	''	'MARCA'	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	

    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["ID_EQUIPO_INVENTARIO"]. "<br>";
		$objPHPExcel->setActiveSheetIndex(0)
		    ->setCellValue('A'.$n, $row["NOCONTROL"])
            ->setCellValue('B'.$n,$row["NOINVENTARIO"])
         
            ->setCellValue('C'.$n,$row["EQUIPO"])
			->setCellValue('D'.$n,($row["MARCA"]))
			->setCellValue('E'.$n,($row["MODELO"]))
			->setCellValue('F'.$n,$row["SERIE"])
            ->setCellValue('G'.$n,$row["SERVICIO"])
			->setCellValue('H'.$n,$row["UBICACION"])
            ->setCellValue('I'.$n,$row["NO_ORDEN"])
            ->setCellValue('J'.$n,$row["NO_DICTAMEN"])
			->setCellValue('K'.$n,$row["FECHA_DICTAMEN"])
            ->setCellValue('L'.$n,($row["DICTAMEN_TECNICO_DE"]))
            ->setCellValue('M'.$n,$row["ANIOS_USO"])
            ->setCellValue('N'.$n,$row["DICTAMEN"])
			->setCellValue('O'.$n,($row["ELABORADO_POR"]))
			->setCellValue('P'.$n,$row["RECIBE"])
			->setCellValue('Q'.$n,$row["JEFEDEAREA"])
            ->setCellValue('R'.$n,$row["EDO_DICTAMEN"])
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
$objPHPExcel->getActiveSheet()->setTitle('Inventario');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Dictamenes.xlsx"');
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
