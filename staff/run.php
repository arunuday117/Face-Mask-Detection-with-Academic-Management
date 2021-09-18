<?php
   $command_exec = escapeshellcmd('../detect_face_mask.py');
   $str_output = shell_exec($command_exec);
   echo $str_output;
   echo "string";
?>