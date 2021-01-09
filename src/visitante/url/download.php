<?php
            setcookie('id','',time()-60*60*24*30,'/');
            $img = "./temp/test.png";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($img));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($img));
            ob_clean();
            flush();
            readfile($img);
            session_start();





?>