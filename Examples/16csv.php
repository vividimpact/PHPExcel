<?php /** @noinspection ALL */

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
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');

include "05featuredemo.inc.php";

/** PHPExcel_IOFactory */
require_once '../Classes/PHPExcel/IOFactory.php';


echo date('H:i:s') , " Write to CSV format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setDelimiter(',')
                                                                  ->setEnclosure('"')
                                                                  ->setSheetIndex(0)
                                                                  ->save(str_replace('.php', '.csv', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo date('H:i:s') , " File written to " , str_replace('.php', '.csv', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


echo date('H:i:s') , " Read from CSV format" , EOL;
$callStartTime = microtime(true);
$objReader = PHPExcel_IOFactory::createReader('CSV')->setDelimiter(',')
                                                    ->setEnclosure('"')
                                                    ->setSheetIndex(0);
$objPHPExcelFromCSV = $objReader->load(str_replace('.php', '.csv', __FILE__));

$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo 'Call time to reload Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

$objWriter2007 = PHPExcel_IOFactory::createWriter($objPHPExcelFromCSV, 'Excel2007');
$objWriter2007->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


echo date('H:i:s') , " Write to CSV format" , EOL;
$callStartTime = microtime(true);

$objWriterCSV = PHPExcel_IOFactory::createWriter($objPHPExcelFromCSV, 'CSV');
$objWriterCSV->setExcelCompatibility(true);
$objWriterCSV->save(str_replace('.php', '_excel.csv', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo date('H:i:s') , " File written to " , str_replace('.php', '_excel.csv', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done writing files" , EOL;
echo 'Files have been created in ' , getcwd() , EOL;
