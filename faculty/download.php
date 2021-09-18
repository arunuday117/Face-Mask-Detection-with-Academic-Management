<?php 
 require '../includes/FPDF/fpdf.php';
 include 'includes/dbconnect.php';
$course=$_POST['course'];
$subject=$_POST['subject'];
$sem=$_POST['sem'];
$tsubject=ucwords(strtolower($subject));
$tcourse=ucwords(strtolower($course));
if(isset($_POST['add']))
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
 class myPDF extends FPDF
 {
 	function header()
 	{
 		global $tsubject;
 		global $tcourse;
 		global $semester;
 		if ( $this->PageNo() == 1 ) {
	 		$this->Image('../assets/images/logo.png',124,6);
	 		$this->Ln(10);
	 		$this->SetFont('Arial','B',14);
	 		$this->Cell(0,5,'Assignment MarkList',0,0,'C');
	 		$this->Ln();
	 		$this->SetFont('Times','',12);
	 		$this->Cell(0,10,$semester.' '.$tsubject.' '.$tcourse,0,0,'C');
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
 		$this->Cell(80,10,'Subject',1,0,'C');
 		$this->Cell(80,10,'Title',1,0,'C');
 		$this->Cell(30,10,'Mark',1,0,'C');
 		$this->Ln();
 	}
 	function viewTable($con,$course,$sem,$subject,$batch){
 		$this->SetFont('Times','',10);
 		$cellWidth=80;//wrapped cell width
		$cellHeight=10;//normal one-line cell height
 		$query=mysql_query("SELECT * FROM assignmentmark NATURAL JOIN assignment WHERE assignmentmark.asid=assignment.asid AND course='$course' AND sem='$sem' AND subject='$subject' AND batch='$batch'ORDER BY stid ASC ");
 		while ($row=mysql_fetch_array($query))
 		{
 			if($this->GetStringWidth($row['title']) < $cellWidth){
				//if not, then do nothing
				$line=1;
			}else{				
				$textLength=strlen($row['title']);	//total text length
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
						$tmpString=substr($row['title'],$startChar,$maxChar);
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
 			$rlno=$row['stid'];
 			$result=mysql_query("SELECT * FROM studentreg WHERE stid='$rlno'");
 			$ro=mysql_fetch_array($result);
 			$this->Cell(30,($line * $cellHeight),$ro['stid'],1,0,'C');
 			$this->Cell(60,($line * $cellHeight),ucwords(strtolower($ro['stfname'].' '.$ro['stlname'])),1,0,'L');
 			$this->Cell(80,($line * $cellHeight),$row['subject'],1,0,'L');
 			$this->MultiCell($cellWidth,$cellHeight,$row['title'],1,0,'L');
 			$this->Cell(30,($line * $cellHeight),$row['mark'],1,0,'C');
 			$this->Ln();
 		}
	}
 }
 $name=$semester.' '.$tsubject.' '.$tcourse." Assignment";
 $pdf=new myPDF();
 $pdf->AliasNbPages();
 $pdf->AddPage('L','A4',0);
 $pdf->headerTable();
 $pdf->viewTable($con,$course,$sem,$subject,$batch);
 $pdf->Output('D',$name.'.pdf');
}
?>