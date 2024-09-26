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

$array='';

if(isset($_POST['array'])) {
    $array = $_POST['array'];
} else {
    $array = '';
}

 $array = str_replace ( "[", '(', $array);
 $array = str_replace ( "]", ')', $array);

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("SIAEM")
							 ->setLastModifiedBy("Nadezhda Aguilar Blas")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription(" XLSX, generated using SIAEM.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data

$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->setActiveSheetIndex(0)
           
            ->setCellValue('A1', 'ID_EQUIPO_INVENTARIO')
            ->setCellValue('B1', 'NO_CONTROL')
            ->setCellValue('C1', 'ID_EQUIPO')
            ->setCellValue('C1', 'EQUIPO')
			->setCellValue('D1', 'MARCA')
			->setCellValue('E1', 'MODELO')
			->setCellValue('F1', 'SERIE')
            ->setCellValue('G1', 'NO_INVENTARIO')
            ->setCellValue('H1', 'SERVICIO')
            ->setCellValue('I1', 'UBICACION')
			->setCellValue('J1', 'CUERPO')
			->setCellValue('K1', 'EXTENSION')
			->setCellValue('M1', 'ID_PROVEEDOR')
            ->setCellValue('L1', 'PROVEEDOR')
            ->setCellValue('M1', 'FECHA_DE_INSTALACION')
            ->setCellValue('N1', 'ESTADO')
			->setCellValue('O1', 'PROPIEDAD')
			->setCellValue('P1', 'PRECIO')
			->setCellValue('Q1', 'FECHA_CREACION')
            ->setCellValue('R1', 'GARANTIA')
            ->setCellValue('S1', 'COMPRA_POR')
			->setCellValue('T1', 'CONVENIO_EVENTO')
			->setCellValue('U1', 'PARTIDA')
			->setCellValue('V1', 'NOTAS')
			->setCellValue('X1', 'FECHA_RECEPCION')
			->setCellValue('Y1', 'VIDA_UTIL')
			->setCellValue('Z1','FECHA_BAJA')
			->setCellValue('AA1','EDO_FUNCIONAL_EQUIPO')
			/*->setCellValue('AB1', '')*/
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

$sql = "SELECT ID_EQUIPO_INVENTARIO, NO_CONTROL, ID_EQUIPO, EQUIPO, MARCA, MODELO, SERIE, NO_INVENTARIO, SERVICIO, AREA AS UBICACION, CUERPO, EXTENSION, ID_PROVEEDOR, PROVEEDOR, FECHA_DE_INSTALACION, ESTADO, PROPIEDAD, PRECIO, FECHA_CREACION, GARANTIA, COMPRA_POR, CONVENIO_EVENTO, PARTIDA, NOTAS, FECHA_COMPRA, VIDA_UTIL, FECHA_BAJA, NO_ORDEN, ESTADO_FUNCIONAL AS EDO_ORDEN, case FUERA_SERVICIO when 'SI' then 'NO FUNCIONA' when 'NO' then 'FUNCIONA' when 'PARCIALMENTE' then 'PARCIALMENTE' else 'FUNCIONA' end as EDO_FUNCIONAL_EQUIPO FROM inventariovw1  WHERE ESTADO ='ACTIVO' ORDER BY ID_EQUIPO_INVENTARIO DESC";

$result = $conn->query($sql);
$n=2;
if ($result->num_rows > 0) {
    // output data of each row ''	''	''	''	'MARCA'	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	''	

    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["ID_EQUIPO_INVENTARIO"]. "<br>";
		$objPHPExcel->setActiveSheetIndex(0)
		    ->setCellValue('A'.$n, $row["ID_EQUIPO_INVENTARIO"])
            ->setCellValue('B'.$n,$row["NO_CONTROL"])
            ->setCellValue('C'.$n,$row["ID_EQUIPO"])
            ->setCellValue('C'.$n,$row["EQUIPO"])
			->setCellValue('D'.$n,($row["MARCA"]))
			->setCellValue('E'.$n,($row["MODELO"]))
			->setCellValue('F'.$n,$row["SERIE"])
            ->setCellValue('G'.$n,$row["NO_INVENTARIO"])
            ->setCellValue('H'.$n,$row["SERVICIO"])
            ->setCellValue('I'.$n,$row["UBICACION"])
			->setCellValue('J'.$n,$row["CUERPO"])
			->setCellValue('K'.$n,$row["EXTENSION"])
			->setCellValue('L'.$n,$row["ID_PROVEEDOR"])
            ->setCellValue('L'.$n,($row["PROVEEDOR"]))
            ->setCellValue('M'.$n,$row["FECHA_DE_INSTALACION"])
            ->setCellValue('N'.$n,$row["ESTADO"])
			->setCellValue('O'.$n,($row["PROPIEDAD"]))
			->setCellValue('P'.$n,$row["PRECIO"])
			->setCellValue('Q'.$n,$row["FECHA_CREACION"])
            ->setCellValue('R'.$n,$row["GARANTIA"])
           ->setCellValue('S'.$n,($row["COMPRA_POR"]))
			->setCellValue('T'.$n,($row["CONVENIO_EVENTO"]))
			->setCellValue('U'.$n,($row["PARTIDA"]))
			->setCellValue('V'.$n,(string)strtoupper(str_replace(',','',$row["NOTAS"])))
			 ->setCellValue('X'.$n,(string)$row["FECHA_COMPRA"])
			->setCellValue('Y'.$n,(string)$row["VIDA_UTIL"])  
			->setCellValue('Z'.$n,$row["FECHA_BAJA"])
			->setCellValue('AA'.$n,'"'.$row["EDO_FUNCIONAL_EQUIPO"].'"') 
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
$objPHPExcel->getActiveSheet()->setTitle('Inventario');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Inventario.xlsx"');
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
