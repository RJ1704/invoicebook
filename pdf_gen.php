<?php 
	
	require_once 'FPDF/fpdf.php';
	require_once 'config.php';

	$pdfquery = "SELECT * FROM customers WHERE c_id =".$_GET['id'];
	$pdfres   = mysqli_query($conn, $pdfquery);

		
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();	

		/*Cell(width , height , text , border , end line , [align] )*/
				$pdf->SetFont('Arial','B',16);
				$pdf->Cell(71 ,10,'',0,0);
				$pdf->Cell(59 ,5,'Invoice',0,0);
				$pdf->Cell(59 ,10,'',0,1);

				$pdf->SetFont('Arial','B',15);
				$pdf->Cell(71 ,5,'Company Details',0,0);
				$pdf->Cell(59 ,5,'',0,0);
				$pdf->Cell(59 ,5,'',0,1);	

		if ($rows = mysqli_fetch_array($pdfres)) {

			//set font to arial, regular, 12pt
			$pdf->SetFont('Arial','',12);

			$pdf->Cell(130	,5,'[Street Address]',0,0);
			$pdf->Cell(59	,5,'',0,1);//end of line

			$pdf->Cell(130	,5,'[City, Country, ZIP]',0,0);
			$pdf->Cell(25	,5,'Invoice Date: ',0,0);
			$pdf->Cell(34	,5,$rows['date'],0,1);//end of line

			$pdf->Cell(130	,5,'Phone [+12345678]',0,0);
			$pdf->Cell(25	,5,'Customer ID: ',0,0);
			$pdf->Cell(34	,5,'00'.$rows['c_id'],0,1);//end of line


			$pdf->Cell(130	,5,'Fax [+12345678]',0,0);
			
			//make a dummy empty cell as a vertical spacer
			$pdf->Cell(189	,10,'',0,1);//end of line

			//billing address
			$pdf->Cell(100	,5,'Customer Details',0,1);//end of line

			//add dummy cell at beginning of each line for indentation
			$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(20	,5,'Name: ',0,0);
			$pdf->Cell(90	,5,$rows['c_name'],0,1);

			$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(20	,5,'Email: ',0,0);
			$pdf->Cell(90	,5,$rows['c_email'],0,1);

			$pdf->Cell(10	,5,'',0,0);
			$pdf->Cell(20	,5,'Phone: ',0,0);
			$pdf->Cell(90	,5,$rows['c_phone'],0,1);

			//make a dummy empty cell as a vertical spacer
			$pdf->Cell(189	,10,'',0,1);//end of line

			//invoice contents
			$pdf->SetFont('Arial','B',12);

			$pdf->Cell(130	,5,'Service',1,0);
			$pdf->Cell(25	,5,'Discount',1,0);
			$pdf->Cell(34	,5,'Amount',1,1);//end of line

			$pdf->SetFont('Arial','',12);

			//Numbers are right-aligned so we give 'R' after new line parameter		
			
				$pdf->Cell(130	,5,$rows['c_service'],1,0);
				$pdf->Cell(25	,5,$rows['c_discount'].' %',1,0);
				$pdf->Cell(34	,5,$rows['c_amt'],1,1,'R');//end of line
				

			//summary
			$pdf->Cell(130	,5,'',0,0);
			$pdf->Cell(25	,5,'Subtotal',0,0);
			$pdf->Cell(4	,5,'$',1,0);
			$pdf->Cell(30	,5,$rows['c_total'],1,1,'R');//end of line	


			// email stuff (change data below)
			$to = $rows['c_email']; 
			$from = "rjwebmaster.1996@gmail.com"; 
			$subject = "send email with pdf attachment"; 
			$message = "<p>Please see the attachment.</p>";

			// a random hash will be necessary to send mixed content
			$separator = md5(time());

			// carriage return type (we use a PHP end of line constant)
			$eol = PHP_EOL;

			// attachment name
			$filename = "invoice.pdf";

			// encode data (puts attachment in proper format)
			$pdfdoc = $pdf->Output("", "S");
			$attachment = chunk_split(base64_encode($pdfdoc));

			// main header
			$headers  = "From: ".$from.$eol;
			$headers .= "MIME-Version: 1.0".$eol; 
			$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

			// no more headers after this, we start the body! //

			$body = "--".$separator.$eol;
			$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
			$body .= "Thank You".$eol;

			// message
			$body .= "--".$separator.$eol;
			$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
			$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
			$body .= $message.$eol;

			// attachment
			$body .= "--".$separator.$eol;
			$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
			$body .= "Content-Transfer-Encoding: base64".$eol;
			$body .= "Content-Disposition: attachment".$eol.$eol;
			$body .= $attachment.$eol;
			$body .= "--".$separator."--";

			// send message
			mail($to, $subject, $body, $headers);
			}
		
		$pdf->Output();
			
?>