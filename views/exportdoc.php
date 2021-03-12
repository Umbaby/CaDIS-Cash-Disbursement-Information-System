<?php 
    $date = date_create(date("Y-m-d"));
    $current = date_format($date,"M d, Y");
    $date2 = date_create($issued_from);
    $issued_from2 = date_format($date2,"M d, Y");
    $date3 = date_create($deadline);
    $deadline2 = date_format($date3,"M d, Y");
    $total = 0;
?>
<div id="docdiv">
<div style="margin:0 60px 0 60px;font-size:10px;">
    <?php echo $current; ?>
    <br><br><br>

    <p>TO&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <strong><?php echo $top; ?></strong></p>
    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $top_position; ?></p>
    <p>THRU&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <strong><?php echo $thru; ?></strong></p>
    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $thru_position; ?></p>
    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <strong><?php echo $focal_person; ?></strong></p>
    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo $focal_position; ?></p>
    <p>FROM&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: REGIONAL DIRECTOR</p>
    <p>SUBJECT&nbsp&nbsp&nbsp&nbsp: UNRELEASED CHECKS</p>

    <p>Please be informed of the following check issuances for immediate to the corresponding LGU partners 
    with <strong>validity of three (3) months from date of issue</strong>. The Bureau of Treasury thru our Central Office is making a follow up on 
    the status of our Agency's outstanding checks to ensure that all payments made are accounted for.
    </p>

    <p>Kindly facilitate contacting all the aforementioned payees specially those <strong>issued in <?php echo $issued_from2; ?></strong> to claim their checks not
    later than <strong><?php echo $deadline2; ?></strong>.</p><br>
    

    <table style="font-size:10px;">
        <thead>
            <tr>
                <th style="border:1px solid">Quantity</th>
                <th style="border:1px solid">PAYEE</th>
                <th style="border:1px solid">Check Number</th>
                <th style="border:1px solid">Amount</th>
                <th style="border:1px solid;size:50px;">Date Issued</th>
                <th style="border:1px solid">Remarks</th>
            </tr>
        </thead>
        <tbody>
        <?php $a=1; ?>
        <?php foreach($filter_row as $index => $value): ?>
                <tr>
                    <td style="border:1px solid"><?php echo $a; ?></td>
                    <td style="border:1px solid"><?php echo $value['payee']; ?></td>
                    <td style="border:1px solid"><?php echo $value['warrant_num']; ?></td>
                    <td style="border:1px solid"><?php echo number_format($value['gross'],2,'.',','); ?></td>
                    <td style="border:1px solid;size:50px;"><?php if($value['date_released']>0){ $date=date_create($value['date_released']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <?php foreach($remarks as $index2 => $value2): ?>
                        <?php if($a == $index2){ ?>
                            <td style="border:1px solid"><?php echo $value2; ?></td>
                        <?php } ?>
                    <?php endforeach; ?>
                </tr>
        <?php $a++; $total = $total + $value['gross']; ?>
        <?php endforeach; ?>
            <tr>
                <td style="border:1px solid">TOTAL</td>
                <td style="border:1px solid"></td>
                <td style="border:1px solid"></td>
                <td style="border:1px solid"><?php echo $total; ?></td>
                <td style="border:1px solid;size:50px;"></td>
                <td style="border:1px solid"></td>
            </tr>
        </tbody>
    </table>
    <br><br>
               <p><strong>For appropriate action.</strong></p><br><br>

    MERCEDITA P. JABAGAT<br><br>
    /MPJ/REN/VRS/gem
    </div>
</div>