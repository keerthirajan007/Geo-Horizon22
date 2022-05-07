<?php

require_once '../vendor/autoload.php';
require_once "../methods/db.php";   

function receipt($payment_id){
    
    $r = getTransactions("t.payment_id = '$payment_id'");
    
    $a = mysqli_fetch_array($r);

    $mpdf = new \Mpdf\Mpdf();

    ob_start();
    
    $html = '
    <html>
        <head>
            <meta charset="utf-8">
            <title>Payment Receipt</title>
            <style>
                body {
                    font-family: "Segoe UI", arial, sans-serif;
                    width:100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }


                table {
                    border-collapse: collapse;
                    min-width: 50%;
                    max-width: 100%;
                }
            

                th {
                    background-color: #2d4154;
                    color: white;
                    border: 1px solid #2d4154;
                    text-align: left;
                    padding: 8px;
                }

                td {
                    border: 1px solid #2d4154;
                    text-align: left;
                    padding: 8px;
                }
            </style>
        </head>

        <body>
            <h3>User Details</h3>
            <table>
                <tr>
                    <th>User Id</th>
                    <td>'.$a['user_id'].'</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>'.$a['user_name'].'</td>
                </tr>
                <tr>
                    <th>Mail</th>
                    <td>'.$a['user_mail'].'</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>'.$a['user_phone'].'</td>
                </tr>
            </table>

            <h3>Transaction Details</h3>
            <table>
                <tr>
                    <th>Event Id</th>
                    <td>'.$a['event_id'].'</td>
                </tr>
                <tr>
                    <th>Event Name</th>
                    <td>'.$a['name'].'</td>
                </tr>
                <tr>
                    <th>Event Amount</th>
                    <td>'.$a['event_amt'].' INR</td>
                </tr>
                <tr>
                    <th>Amount Paid</th>
                    <td>'.$a['paid_amt'].'</td>
                </tr>
                <tr>
                    <th>Paid Currency</th>
                    <td>'.$a['paid_amt_currency'].'</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>'.$a['payment_status'].'</td>
                </tr>

                <tr>
                    <th>Paid AT</th>
                    <td>'.$a['created'].'</td>
                </tr>
                <tr>
                    <th>Payment Id</th>
                    <td>'.$a['payment_id'].'</td>
                </tr>
                <tr>
                    <th>Txn Id</th>
                    <td>'.$a['txn_id'].'</td>
                </tr>
            </table>
        </body>
    </html>';

    $mpdf->WriteHTML($html);
    
    ob_end_clean();
    
    return $mpdf->Output('payment_receipt.pdf',"D");
}

?>