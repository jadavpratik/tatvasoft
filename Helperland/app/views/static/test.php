<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1 style="text-align:center;">TEST</h1>
    
    <script>
        $.ajax({
            url : 'http://localhost:8000/data',
            method : 'GET',
            success : function(res){
                console.log(res);
            },
            error : function(obj){
                const {responseText} = obj;
                const error = JSON.parse(responseText);
                console.log(error.message);
            }
        })
    </script>
</body>
</html>