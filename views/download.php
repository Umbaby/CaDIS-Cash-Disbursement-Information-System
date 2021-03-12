<?php session_start();
        include "../controllers/downloadfunction.php";
      include 'C:\Users\tbadlawan\vendor\autoload.php';

      use PhpOffice\PhpSpreadsheet\Spreadsheet;
      use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

      $date = date("Y-m-d");

      if(isset($_SESSION['usertype']) && ($_SESSION['usertype'] =="Encoder" || $_SESSION['usertype'] =="Claim/OR officer" || $_SESSION['usertype'] =="Releasing officer")){

        if((isset($ex_select) && $ex_select == "yes") || (isset($all_select) && $all_select == "yes")){

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Date Encoded');
            $sheet->setCellValue('B1', 'Payee');
            $sheet->setCellValue('C1', 'Particular');
            $sheet->setCellValue('D1', 'Period (From)');
            $sheet->setCellValue('E1', 'Period (To)');
            $sheet->setCellValue('F1', 'Et Al');
            $sheet->setCellValue('G1', 'OB Number');
            $sheet->setCellValue('H1', 'Gross Amount');
            $sheet->setCellValue('I1', 'Net Amount');
            $sheet->setCellValue('J1', 'Program');
            $sheet->setCellValue('K1', 'Remarks');

            if($filter_status != "for_issuance"){
                $sheet->setCellValue('L1', 'Check/ADA Number');
                $sheet->setCellValue('M1', 'Date Released');

                if($filter_status != "for_claim/for_or"){
                    $sheet->setCellValue('N1', 'Receipt Number');
                    $sheet->setCellValue('O1', 'Date Issue');
                    $sheet->setCellValue('P1', 'Date Claimed');
                    $sheet->setCellValue('Q1', 'Claimed By');
                } else {
                    $sheet->setCellValue('N1', 'Date Cancelled');
                    $sheet->setCellValue('O1', 'Date Expired');
                }
            } else {
                $sheet->setCellValue('L1', 'Date Cancelled');
                $sheet->setCellValue('M1', 'Date Expired');
            }

            if($filter_status == "cancelled" || $filter_status == "expired"){
                $sheet->setCellValue('R1', 'Date Cancelled');
                $sheet->setCellValue('S1', 'Date Expired');
            }

            $a=2;
            foreach($filter_row as $index => $value):
            
                if($value['date_encoded']>0){ $date=date_create($value['date_encoded']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                    $sheet->setCellValue('A'.$a, $new_date);
                    $sheet->setCellValue('B'.$a, $value['payee']);
                    $sheet->setCellValue('C'.$a, $value['particular']);
                if($value['period_from']>0){ $date=date_create($value['period_from']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                    $sheet->setCellValue('D'.$a, $new_date);
                if($value['period_to']>0){ $date=date_create($value['period_to']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                    $sheet->setCellValue('E'.$a, $new_date);
                    $sheet->setCellValue('F'.$a, $value['et_al']);
                    $sheet->setCellValue('G'.$a, $value['ob_num']);
                    $sheet->setCellValue('H'.$a, $value['gross']);
                    $sheet->setCellValue('I'.$a, $value['net']);
                    $sheet->setCellValue('J'.$a, $value['program']);
                    $sheet->setCellValue('K'.$a, $value['remarks']);

                    if($filter_status != "for_issuance"){
                            $sheet->setCellValue('L'.$a, $value['warrant_num']);
                        if($value['date_released']>0){ $date=date_create($value['date_released']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                            $sheet->setCellValue('M'.$a, $new_date);

                            if($filter_status != "for_claim/for_or"){
                                    $sheet->setCellValue('N'.$a, $value['or_num']);
                                if($value['date_issue']>0){ $date=date_create($value['date_issue']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                                    $sheet->setCellValue('O'.$a, $new_date);
                                if($value['date_claimed']>0){ $date=date_create($value['date_claimed']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                                    $sheet->setCellValue('P'.$a, $new_date);
                                    $sheet->setCellValue('Q'.$a, $value['claimed_by']);
                            } else {
                                if($value['date_cancelled']>0){ $date=date_create($value['date_cancelled']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                                    $sheet->setCellValue('N'.$a, $new_date);
                                if($value['date_expire']>0){ $date=date_create($value['date_expire']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                                    $sheet->setCellValue('O'.$a, $new_date);
                            }
                    } else {
                        if($value['date_cancelled']>0){ $date=date_create($value['date_cancelled']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                            $sheet->setCellValue('L'.$a, $new_date);
                        if($value['date_expire']>0){ $date=date_create($value['date_expire']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                            $sheet->setCellValue('M'.$a, $new_date);
                    }

                    if($filter_status == "cancelled" || $filter_status == "expired"){
                        if($value['date_cancelled']>0){ $date=date_create($value['date_cancelled']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                            $sheet->setCellValue('R'.$a, $new_date);
                        if($value['date_expire']>0){ $date=date_create($value['date_expire']); $new_date = date_format($date,"M-d-Y"); } else { $new_date = ""; }
                            $sheet->setCellValue('S'.$a, $new_date);
                    }
            $a++;
            endforeach;

            
            //$writer->save('C:\Users\Public\Downloads\spreadsheet.xlsx');

            $filename = "excel_report_" . date('Y-m-d') . ".xlsx";

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header('Cache-Control: max-age=0');

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');   

        }

    } else {
        header("location:index.php");
    }
?>