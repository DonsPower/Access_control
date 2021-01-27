<?php
    // echo preg_replace('([^A-Za-z0-9])', '', $text);
    //  $output  = str_replace("<script>","" ,$text);
    //  $output  = str_replace("<script>","" ,$text);
    //  $output2  = str_replace("</script>","" ,$output);
    class validacion{
        function is_val($str){
            if(strlen($str)<3 || strlen($str)>20){
                return 1;
            }else if(preg_match('/[0-9]/',$str)){
                return 1;
            }
        }
        function solo_numeros($str){
            if(is_numeric($str) && strlen($str)==11){
                return 0;
            }else{
                return 1;
            }
        }
        //Validar pregunta de seguridad yrespuesta
        function preResSeg($str){
            
            $dos  = str_replace("<script>","" ,$str);
            $tres=str_replace("</script>","" ,$dos);
            $uno=preg_replace('([^¿?A-Za-z0-9])', '', $tres);
            return $uno;
        }
        function is_valid_email($str)
        {
            $matches = null;
            return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
        }
        function RFC($str){
            if(is_numeric($str) && strlen($str)==13 ){
                return 0;
            }else{
                return 1;
            }
        }
        function telefono($str){
            if(is_numeric($str) && strlen($str)==10){
                return 0;
            }else{
                return 1;
            }
        }
        function ext($str){
            if(is_numeric($str) ){
                return 0;
            }else{
                return 1;
            }
        }
    }

?>