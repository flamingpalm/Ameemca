<?php
/************
 *  DOWNLOAD ALLOTMENT
 * 
 * ************/


require_once 'DB.php'; 
include "../libraries/spreadsheet/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

if($_GET["action"] == "download_slip")	{


        $query = "
    	     SELECT SUM(allotment_amount) as total_allotment, COUNT(id) as total_user FROM usertable
    	     WHERE NOT staffid = '210035'
        ";
        $secondHeader = '';
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
        	$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$secondHeader .= 'TOTAL: N'.number_format($row["total_allotment"]).' - MEMBERS: '.number_format($row["total_user"]);
			}
		}




//styling array start
//table head start
$tableHead = [
        'font'=>[
           'color'=>[
                'rgb'=>'FFFFFF'
           ],
           'bold'=>true,
           'size'=>11
        ],
        'fill'=>[
          'fillType'=>Fill::FILL_SOLID,
          'startColor'=>[
                'rgb'=>'73D7FF'
           ] 
        ],
];

//even row
$evenRow = [
        'fill'=>[
           'fillType'=> Fill::FILL_SOLID,
           'startColor'=>[
                'rgb'=>'FFFFFF'
                ]
        ]
];

//odd row
$oddRow = [
        'fill'=>[
           'fillType'=> Fill::FILL_SOLID,
           'startColor'=>[
                'rgb'=>'FFFFFF'
                ]
        ]
];
//styling array end




$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()
                ->getFont()
                ->setName('Arial')
                ->setSize(10);

//heading 1
$spreadsheet->getActiveSheet()
                ->setCellValue('A1', 'AMEEMCA ALLOTMENT');

//merge heading
$spreadsheet->getActiveSheet()
                ->mergeCells("A1:R1");

//set font style
$spreadsheet->getActiveSheet()
                ->getStyle("A1")
                ->getFont()
                ->setSize(20);

//set cell alignment
$spreadsheet->getActiveSheet()
                ->getStyle("A1")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                
                

//heading 2
$spreadsheet->getActiveSheet()
                ->setCellValue('A2', $secondHeader);

//merge heading
$spreadsheet->getActiveSheet()
                ->mergeCells("A2:R2");

//set font style
$spreadsheet->getActiveSheet()
                ->getStyle("A2")
                ->getFont()
                ->setSize(17);

//set cell alignment
$spreadsheet->getActiveSheet()
                ->getStyle("A2")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);

//set column width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(18);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);           
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(18);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(23);
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(30);

//header text
$spreadsheet->getActiveSheet()
                ->setCellValue('A3', 'EMPLOYEE ID')
                ->setCellValue('B3', 'EMPLOYEE')
                ->setCellValue('C3', 'PAY PERIOD')
                ->setCellValue('D3', 'COUNTRY')
                ->setCellValue('E3', 'POST/LOCATION')
                ->setCellValue('F3', 'BUREAU')
                ->setCellValue('G3', 'PAYEE LINE')
                ->setCellValue('H3', 'PAYMENT CURRENCY')
                ->setCellValue('I3', 'NATIONAL ID')
                ->setCellValue('J3', 'NAME')
                ->setCellValue('K3', 'ELEMENT DESCR')
                ->setCellValue('L3', 'AMOUNT')
                ->setCellValue('M3', 'NEW AMOUNT')
                ->setCellValue('N3', 'CURRENCY')
                ->setCellValue('O3', 'EXCHANGE RATE')
                ->setCellValue('P3', 'AMOUNT (USE)')
                ->setCellValue('Q3', 'PAYMENT METHOD DESCR')
                ->setCellValue('R3', 'GLOBAL CHECK RECIPIENT');

//set font style
$spreadsheet->getActiveSheet()
                ->getstyle('A3:R3')->getFont()->setSize(11);
$spreadsheet->getActiveSheet()
                ->getstyle('A3:R3')->getFont()->setBold(true);

//background color
$spreadsheet->getActiveSheet()
                ->getstyle('A3:R3')->applyFromArray($tableHead);


 $query = "SELECT * FROM usertable";
 $query .= " WHERE NOT staffid = '210035'"; //exclude maintenance staff
 $query .= " GROUP BY staffid";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->rowCount();
        if($result > 0){
        $studentData = $statement->fetchAll();
        $row=3;
   foreach($studentData as $student){
     $spreadsheet->getActiveSheet()
                        ->setCellValue('A'.$row, $student['employee_number'])
                        ->setCellValue('B'.$row, $student['fname'].' '.$student['lname'])
                        ->setCellValue('C'.$row, $student['allotment_desc'])
                        ->setCellValue('D'.$row, $student['country'])
                        ->setCellValue('E'.$row, 'Abuja/Abuja')
                        ->setCellValue('F'.$row, $student['agency_bureau'])
                        ->setCellValue('G'.$row, 'FSN')
                        ->setCellValue('H'.$row, 'NGN')
                        ->setCellValue('I'.$row, '')
                        ->setCellValue('J'.$row, '')
                        ->setCellValue('K'.$row, 'AMEEMCA ALLOTMENT')
                        ->setCellValue('L'.$row, $student['allotment_amount'])
                        ->setCellValue('M'.$row, '')
                        ->setCellValue('N'.$row, 'NGN')
                        ->setCellValue('O'.$row, '')
                        ->setCellValue('P'.$row, '')
                        ->setCellValue('Q'.$row, 'Global Check')
                        ->setCellValue('R'.$row, '56001');

        //set row style               
        if($row % 2 ==0 ){
        //even row 
        //$spreadsheet->getActiveSheet()->getstyle('A'.$row.':R'.$row)->applyFromArray($evenRow);
        } else {
        //odd row
        //$spreadsheet->getActiveSheet()->getstyle('A'.$row.':R'.$row)->applyFromArray($oddRow);
        }
        //increament
        $row++;
}
        }
//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename="ALLOTMENT.xlsx"');
//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');
	} else{
        exit('Restricted Area');
  }
