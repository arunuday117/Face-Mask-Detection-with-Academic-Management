<?php
include('includes/dbconnect.php');
    $img = $_POST['image'];
    $folderPath = "upload/";
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName =uniqid().'.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    function test()
    {
        sleep(6);
        $sql=mysql_query('SELECT * FROM maskviolations ORDER BY mid asc');
        $no=0;
        $flag=0;
        $match='';
        if($sql)
        {
            while($row=mysql_fetch_array($sql))
            {
                if($row['desc']=='nomask')
                {
                    $match='nomask';
                }
                elseif($row['desc']=='mask')
                {
                    $match='mask';
                }
                else
                {
                    $match='noface';
                }
            }
        return($match);
        }        
    
    }
    $con=test();
?>
<!DOCTYPE html>
<html>
<head>
    <title>ANV ACADEMICS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
</head>
<body>
    <div class="loader">
        <img src="assets/images/loader.gif" alt="Loading..." />
    </div>
    <script type="text/javascript">
        function load() {
            const loader = document.querySelector(".loader");
            loader.className += " hidden"; // class "loader hidden"
        };
        setTimeout(function(){ load(); }, 6000);
        setTimeout(function(){ alt(); }, 7000);
        var s='<?php echo $con; ?>';
        function alt(){
            if(s=='nomask'){
                alert('Mask Violation');
                location.href='image.php';

            }
            else if(s=='mask'){
                alert('No Mask Violation');
                location.href='image.php';
            }
            else if(s=='noface')
            {
                alert('No Face Found');
                location.href='image.php';   
            }
        }
        // setTimeout(function(){ alert('Image Recorded');location.href='image.php'; }, 7000);
    </script>
</body>
</html>