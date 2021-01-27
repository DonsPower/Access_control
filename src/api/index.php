<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API-PRUEBA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
  
</head>
<body>

    <button type="button" onclick="register()">Clickme</button>
  
    <script>
        cont=0;
        function register(){
           cont++;
            (async () => {
                const rawResponse = await fetch('http://localhost:8081/led', {
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({estado: 1, contador: cont})
                });
                const content = await rawResponse.json();

                console.log(content);
                })();
      }
     

    </script>
</body>
</html>