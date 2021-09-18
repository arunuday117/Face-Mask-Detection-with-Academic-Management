<?php 
 require '../includes/FPDF/pdf_mc_table.php';
 include 'includes/dbconnect.php';
$type=$_POST['type'];
$sem=$_POST['sem'];
$course=$_POST['course'];
$tcourse=ucwords(strtolower($course));
$previous=isset($_POST['previous']);
if(isset($_POST['class']))
{
	$batch=$_POST['batch'];
	$semester='';
	if($_POST['sem']=='1')
	 {
	 	$semester='First Semester';
	 }
	 elseif($_POST['sem']=='2')
	 {
	 	$semester='Second Semester';
	 }
	 elseif($_POST['sem']=='3')
	 {
	 	$semester='Third Semester';
	 }
	 elseif($_POST['sem']=='4')
	 {
	 	$semester='Fourth Semester';
	 }
	 elseif($_POST['sem']=='5')
	 {
	 	$semester='Fifth Semester';
	 }
	 else
	 {
	 	$semester='Sixth Semester';
	 }

 /**
  * 
  */
 class myPDF extends FPDF
 {
 	function header()
 	{
 		global $type;
 		global $semester;
 		global $tcourse;
 		if ( $this->PageNo() == 1 ) {
	 		$this->Image('../assets/images/logo.png',80,6);
	 		$this->Ln(10);
	 		$this->SetFont('Arial','B',14);
	 		$this->Cell(0,5,'MarkList',0,0,'C');
	 		$this->Ln();
	 		$this->SetFont('Times','',12);
	 		$this->Cell(0,10,$semester.' '.$tcourse.' '.$type,0,0,'C');
	 		$this->Ln(20);
 		}
 	}
 	function footer()
 	{
 		$this->SetY(-15);
 		$this->SetFont('Arial','',8);
 		$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
 	}
 	function headerTable(){
 		$this->SetFont('Times','B',10);
 		$this->Cell(30,10,'Roll No',1,0,'C');
 		$this->Cell(50,10,'Name',1,0,'C');
 		$this->Cell(60,10,'Subject',1,0,'C');
 		$this->Cell(20,10,'Mark',1,0,'C');
 		$this->Cell(30,10,'Total Mark',1,0,'C');
 		$this->Ln();
 	}
 	function viewTable($con,$course,$previous,$type,$sem){
 		$this->SetFont('Times','',12);
 		if($previous=='true')
 		{
 			$cellWidth=60;//wrapped cell width
			$cellHeight=10;//normal one-line cell height
	 		$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND status='0' ORDER BY rlno ASC ");
	 		while ($row=mysql_fetch_array($query))
	 		{
	 			if($this->GetStringWidth($row['subject']) < $cellWidth){
				//if not, then do nothing
				$line=1;
			}else{				
				$textLength=strlen($row['subject']);	//total text length
				$errMargin=10;		//cell width error margin, just in case
				$startChar=0;		//character start position for each line
				$maxChar=0;			//maximum character in a line, to be incremented later
				$textArray=array();	//to hold the strings for each line
				$tmpString="";		//to hold the string for a line (temporary)
				
				while($startChar < $textLength){ //loop until end of text
					//loop until maximum character reached
					while( 
					$this->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
					($startChar+$maxChar) < $textLength ) {
						$maxChar++;
						$tmpString=substr($row['subject'],$startChar,$maxChar);
					}
					//move startChar to next line
					$startChar=$startChar+$maxChar;
					//then add it into the array so we know how many line are needed
					array_push($textArray,$tmpString);
					//reset maxChar and tmpString
					$maxChar=0;
					$tmpString='';
					
				}
				//get number of line
				$line=count($textArray);
			}
	 			$rlno=$row['rlno'];
	 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
	 			$ro=mysql_fetch_array($result);
	 			$this->Cell(30,($line * $cellHeight),$row['rlno'],1,0,'C');
	 			$this->Cell(50,($line * $cellHeight),ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
	 			$this->MultiCell($cellWidth,$cellHeight,$row['subject'],1,0,'L');
	 			$this->Cell(20,($line * $cellHeight),$row['mark'],1,0,'C');
	 			$this->Cell(30,($line * $cellHeight),$row['outof'],1,0,'C');
	 			$this->Ln();
	 		}
	 	}
	 	else
	 	{
	 		$cellWidth=60;//wrapped cell width
			$cellHeight=10;//normal one-line cell height
	 		$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND status='0' ORDER BY rlno ASC ");
	 		while ($row=mysql_fetch_array($query))
	 		{
	 			if($this->GetStringWidth($row['subject']) < $cellWidth){
				//if not, then do nothing
				$line=1;
			}else{				
				$textLength=strlen($row['subject']);	//total text length
				$errMargin=10;		//cell width error margin, just in case
				$startChar=0;		//character start position for each line
				$maxChar=0;			//maximum character in a line, to be incremented later
				$textArray=array();	//to hold the strings for each line
				$tmpString="";		//to hold the string for a line (temporary)
				
				while($startChar < $textLength){ //loop until end of text
					//loop until maximum character reached
					while( 
					$this->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
					($startChar+$maxChar) < $textLength ) {
						$maxChar++;
						$tmpString=substr($row['subject'],$startChar,$maxChar);
					}
					//move startChar to next line
					$startChar=$startChar+$maxChar;
					//then add it into the array so we know how many line are needed
					array_push($textArray,$tmpString);
					//reset maxChar and tmpString
					$maxChar=0;
					$tmpString='';
					
				}
				//get number of line
				$line=count($textArray);
			}
	 			$rlno=$row['rlno'];
	 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
	 			$ro=mysql_fetch_array($result);
	 			$this->Cell(30,($line * $cellHeight),$row['rlno'],1,0,'C');
	 			$this->Cell(50,($line * $cellHeight),ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
	 			$this->MultiCell($cellWidth,$cellHeight,$row['subject'],1,0,'L');
	 			$this->Cell(20,($line * $cellHeight),$row['mark'],1,0,'C');
	 			$this->Cell(30,($line * $cellHeight),$row['outof'],1,0,'C');
	 			$this->Ln();
	 		}
	 	}
 	}
 }
 $name=$semester.' '.$tcourse.' '.$type;
 $pdf=new myPDF();
 $pdf->AliasNbPages();
 $pdf->AddPage('P','A4',0);
 $pdf->headerTable();
 $pdf->viewTable($con,$course,$previous,$type,$sem);
 $pdf->Output('D',$name.'.pdf');
}
if(isset($_POST['sub']))
{
	$batch=$_POST['batch'];
	$semester='';
	if($_POST['sem']=='1')
	 {
	 	$semester='First Semester';
	 }
	 elseif($_POST['sem']=='2')
	 {
	 	$semester='Second Semester';
	 }
	 elseif($_POST['sem']=='3')
	 {
	 	$semester='Third Semester';
	 }
	 elseif($_POST['sem']=='4')
	 {
	 	$semester='Fourth Semester';
	 }
	 elseif($_POST['sem']=='5')
	 {
	 	$semester='Fifth Semester';
	 }
	 else
	 {
	 	$semester='Sixth Semester';
	 }
	$subject=$_POST['subject'];
	$tsubject=ucwords(strtolower($subject));
 /**
  * 
  */
 class myPDF extends FPDF
 {
 	function header()
 	{
 		global $type;
 		global $semester;
 		global $tcourse;
 		global $tsubject;
 		if ( $this->PageNo() == 1 ) {
	 		$this->Image('../assets/images/logo.png',80,6);
	 		$this->Ln(10);
	 		$this->SetFont('Arial','B',14);
	 		$this->Cell(0,5,'MarkList',0,0,'C');
	 		$this->Ln();
	 		$this->SetFont('Times','',12);
	 		$this->Cell(0,10,$semester.' '.$tcourse.' '.$tsubject.' '.$type,0,0,'C');
	 		$this->Ln(20);
 		}
 	}
 	function footer()
 	{
 		$this->SetY(-15);
 		$this->SetFont('Arial','',8);
 		$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
 	}
 	function headerTable(){
 		$this->SetFont('Times','B',12);
 		$this->Cell(30,10,'Roll No',1,0,'C');
 		$this->Cell(60,10,'Name',1,0,'C');
 		$this->Cell(50,10,'Mark',1,0,'C');
 		$this->Cell(50,10,'Total Mark',1,0,'C');
 		$this->Ln();
 	}
 	function viewTable($con,$course,$previous,$subject,$type,$sem){
 		$this->SetFont('Times','',12);
 		if($previous=='true')
 		{
	 		$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND subject='$subject' ORDER BY rlno ASC ");
	 		$i=0;
	 		while ($row=mysql_fetch_array($query))
	 		{
	 			$rlno=$row['rlno'];
	 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
	 			$ro=mysql_fetch_array($result);
	 			$this->Cell(30,10,$row['rlno'],1,0,'C');
	 			$this->Cell(60,10,ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
	 			$this->Cell(50,10,$row['mark'],1,0,'C');
	 			$this->Cell(50,10,$row['outof'],1,0,'C');
	 			$this->Ln();
	 		}
	 	}
	 	else
	 	{
	 		$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND subject='$subject' AND status='0' ORDER BY rlno ASC ");
	 		while ($row=mysql_fetch_array($query))
	 		{
	 			$rlno=$row['rlno'];
	 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
	 			$ro=mysql_fetch_array($result);
	 			$this->Cell(30,10,$row['rlno'],1,0,'C');
	 			$this->Cell(60,10,ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
	 			$this->Cell(50,10,$row['mark'],1,0,'C');
	 			$this->Cell(50,10,$row['outof'],1,0,'C');
	 			$this->Ln();
	 		}
	 	}
 	}
 }
 $name=$semester.' '.$tcourse.' '.$tsubject.' '.$type;
 $pdf=new myPDF();
 $pdf->AliasNbPages();
 $pdf->AddPage('P','A4',0);
 $pdf->headerTable();
 $pdf->viewTable($con,$course,$previous,$subject,$type,$sem);
 $pdf->Output('D',$name.'.pdf');
}
if(isset($_POST['stu']))
{
	$semester='';
	if($_POST['sem']=='1')
	 {
	 	$semester='First Semester';
	 }
	 elseif($_POST['sem']=='2')
	 {
	 	$semester='Second Semester';
	 }
	 elseif($_POST['sem']=='3')
	 {
	 	$semester='Third Semester';
	 }
	 elseif($_POST['sem']=='4')
	 {
	 	$semester='Fourth Semester';
	 }
	 elseif($_POST['sem']=='5')
	 {
	 	$semester='Fifth Semester';
	 }
	 else
	 {
	 	$semester='Sixth Semester';
	 }
	$rollno=$_POST['id'];
	$subject=$_POST['subject'];
	$tsubject=ucwords(strtolower($subject));
 /**
  * 
  */
 class myPDF extends FPDF
 {
 	function header()
 	{
 		global $type;
 		global $semester;
 		global $tcourse;
 		global $tsubject;
 		if ( $this->PageNo() == 1 ) {
	 		$this->Image('../assets/images/logo.png',80,6);
	 		$this->Ln(10);
	 		$this->SetFont('Arial','B',14);
	 		$this->Cell(0,5,'MarkList',0,0,'C');
	 		$this->Ln();
	 		$this->SetFont('Times','',12);
	 		$this->Cell(0,10,$semester.' '.$tcourse.' '.$tsubject.' '.$type,0,0,'C');
	 		$this->Ln(20);
 		}
 	}
 	function footer()
 	{
 		$this->SetY(-15);
 		$this->SetFont('Arial','',8);
 		$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
 	}
 	function headerTable(){
 		$this->SetFont('Times','B',12);
 		$this->Cell(30,10,'Roll No',1,0,'C');
 		$this->Cell(60,10,'Name',1,0,'C');
 		$this->Cell(50,10,'Mark',1,0,'C');
 		$this->Cell(50,10,'Total Mark',1,0,'C');
 		$this->Ln();
 	}
 	function viewTable($con,$course,$rollno,$previous,$subject,$type,$sem){
 		$this->SetFont('Times','',12);
 		if($subject=='')
 		{
 			if($previous=='true')
 		 	{
 			 	$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND rlno='$rollno' ORDER BY rlno ASC ");
		 		while ($row=mysql_fetch_array($query))
		 		{
		 			$rlno=$row['rlno'];
		 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
		 			$ro=mysql_fetch_array($result);
		 			$this->Cell(30,10,$row['rlno'],1,0,'C');
		 			$this->Cell(60,10,ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
		 			$this->Cell(50,10,$row['mark'],1,0,'C');
		 			$this->Cell(50,10,$row['outof'],1,0,'C');
		 			$this->Ln();
		 		}
		 	}
		 	else
		 	{
		 		$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND rlno='$rollno' AND status='0' ORDER BY rlno ASC ");
		 		while ($row=mysql_fetch_array($query))
		 		{
		 			$rlno=$row['rlno'];
		 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
		 			$ro=mysql_fetch_array($result);
		 			$this->Cell(30,10,$row['rlno'],1,0,'C');
		 			$this->Cell(60,10,ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
		 			$this->Cell(50,10,$row['mark'],1,0,'C');
		 			$this->Cell(50,10,$row['outof'],1,0,'C');
		 			$this->Ln();
		 		}
		 	}
 		}
 		else
 		{
 			if($previous=='true')
 		 	{
 			 	$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND rlno='$rollno' AND subject='$subject' ORDER BY rlno ASC ");
		 		while ($row=mysql_fetch_array($query))
		 		{
		 			$rlno=$row['rlno'];
		 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
		 			$ro=mysql_fetch_array($result);
		 			$this->Cell(30,10,$row['rlno'],1,0,'C');
		 			$this->Cell(60,10,ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
		 			$this->Cell(50,10,$row['mark'],1,0,'C');
		 			$this->Cell(50,10,$row['outof'],1,0,'C');
		 			$this->Ln();
		 		}
		 	}
		 	else
		 	{
		 		$query=mysql_query("SELECT * FROM exammark WHERE course='$course'AND type='$type' AND sem='$sem' AND rlno='$rollno'AND subject='$subject' AND status='0' ORDER BY rlno ASC ");
		 		while ($row=mysql_fetch_array($query))
		 		{
		 			$rlno=$row['rlno'];
		 			$result=mysql_query("SELECT * FROM studentlist WHERE rlno='$rlno'");
		 			$ro=mysql_fetch_array($result);
		 			$this->Cell(30,10,$row['rlno'],1,0,'C');
		 			$this->Cell(60,10,ucwords(strtolower($ro['sfname'].' '.$ro['slname'])),1,0,'L');
		 			$this->Cell(50,10,$row['mark'],1,0,'C');
		 			$this->Cell(50,10,$row['outof'],1,0,'C');
		 			$this->Ln();
		 		}
		 	}
 		}
 	}
 }
 $name=$semester.' '.$tcourse.' '.$tsubject.' '.$type;
 $pdf=new myPDF();
 $pdf->AliasNbPages();
 $pdf->AddPage('P','A4',0);
 $pdf->headerTable();
 $pdf->viewTable($con,$course,$rollno,$previous,$subject,$type,$sem);
 $pdf->Output('D',$name.'.pdf');
}
?>