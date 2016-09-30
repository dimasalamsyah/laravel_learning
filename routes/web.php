<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('importExport', 'MaatwebsiteDemoController@importExport');
Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');

Route::get('/customers',function(){


	//ini_set('max_execution_time', 300); //5 menit

	// $pdf = App::make('dompdf.wrapper');
	// $faker = Faker\Factory::create();
 //    $limit = 20;
 //    $content=ini_get('max_execution_time')."<br>";
 //    $content .= "<table border=1>";

 //    for ($i = 0; $i < $limit; $i++) {
 //    	$content .="<tr>";

 //    		$content .= "<td>".$i."</td>";
 //    		$content .= "<td>".$faker->name."</td>";
 //    		$content .= "<td>".$faker->unique()->email."</td>";
 //    		$content .= "<td>".$faker->phoneNumber."</td>";

 //    	$content .="</tr>";
 //    }
 //    $content .= "</table>";
	// $pdf->loadHTML($content);
	// $pdf->setPaper('A4', 'landscape');
	// return $pdf->stream();

// $objPHPExcel = new PHPExcel();
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A1', 'No.')
//             ->setCellValue('B1', 'Cut Of Date')
//             ->setCellValue('C1', 'Document STO')
//             ->setCellValue('D1', 'Category')
//             ->setCellValue('E1', 'Sub Category')
//             ->setCellValue('F1', 'Product Family')//
//             ->setCellValue('G1', 'Location')
//             ->setCellValue('H1', 'Location Detail')

//             //detail
//             ->setCellValue('I1', 'Serial No')
//             ->setCellValue('J1', 'Part No')
//             ->setCellValue('K1', 'Part Name')//
//             ->setCellValue('L1', 'UOM')
//             ->setCellValue('M1', 'Stock')
//             ->setCellValue('N1', 'Actual')
//             ->setCellValue('O1', 'Deviation')
//             ->setCellValue('P1', 'Note')
//             ->setCellValue('Q1', 'User')
//             ->setCellValue('R1', 'Date')
//             ;
// $objPHPExcel->getActiveSheet()->setTitle('STO');

// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
// header('Content-type: application/vnd.ms-excel');
// header('Content-Disposition: attachment; filename="sto.xlsx"');
// $objWriter->save('php://output');


Excel::create('ccc', function ($excel) {

    $excel->sheet('aa', function ($sheet) {

        // first row styling and writing content
        $sheet->mergeCells('A1:W1');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Comic Sans MS');
            $row->setFontSize(30);
        });

        $sheet->row(1, array('Some big header here'));

        // second row styling and writing content
        $sheet->row(2, function ($row) {

            // call cell manipulation methods
            $row->setFontFamily('Comic Sans MS');
            $row->setFontSize(15);
            $row->setFontWeight('bold');

        });

        $sheet->row(2, array('Something else here'));

        // getting data to display - in my case only one record
        $users = User::get()->toArray();

        // setting column names for data - you can of course set it manually
        $sheet->appendRow(array_keys($users[0])); // column names

        // getting last row number (the one we already filled and setting it to bold
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

        // putting users data as next rows
        foreach ($users as $user) {
            $sheet->appendRow($user);
        }
    });

})->export('xls');

});
