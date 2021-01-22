<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API-PRUEBA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  
</head>
<body>
<input type="text" id="name">
    <input type="password" name="password" id="password">
    <button type="button" onclick="register()">Clickme</button>
    <button type="button" onclick="getAlum()">Clickme</button>
    <script>
        function register(){
            let name= $('#name').val();
            let pass= $('#password').val();
            let URL='https://donasapiback.herokuapp.com/auth/login';
            fetch(URL, {
                method: "post",
                dataType: 'json',
                mode: 'cors',
                //headers: myHeaders
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "username" : name,
                    "password" : pass   
                })
            }).then((response) => {
                return response.json();   
            }).then((data) => {
                console.log(data);
                if(data['message']!='OK'){
                    //No se registro bien el usuario.
                    console.log("Registro incorrecto.");
                }else{
                    document.cookie = "token= "+data['token'];
                    fetch('https://donasapiback.herokuapp.com/poblacionfija/alumnos', {
                        method: "get",
                        dataType: 'json',
                        mode: 'cors',
                        //headers: myHeaders
                        headers:{
                            'Content-Type': 'application/json',
                            
                        }
                    }).then((response) => {
                        return response.json();   
                    }).then((data) => {
                    
                        //console.log(data['token']);
                        console.log(data);
                    })
                }
                //document.cookie = "token= "+data['token'];
                //console.log(data['token']);
            })
        }
        function getAlum(){
            fetch('https://donasapiback.herokuapp.com/poblacionfija/alumnos', {
                method: "get",
                dataType: 'json',
                mode: 'cors',
                //headers: myHeaders
                headers:{
                    'Content-Type': 'application/json',
                    
                }
            }).then((response) => {
                return response.json();   
            }).then((data) => {
               // document.cookie = "token= "+data['token'];
                //console.log(data['token']);
                console.log(data);
                //Aqui hacer el insert de los datos.
            })
        }
    </script>
</body>
</html>