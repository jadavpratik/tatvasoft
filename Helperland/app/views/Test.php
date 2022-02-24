<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
<script>
    $.ajax({
        url : 'http://localhost/tatvasoft/helperland/data',
        success : function(res){
            console.log(res);
        },
        error : function(err){
            const { responseText } = err;
            // console.log(responseText);
            console.log(JSON.parse(responseText).error);
        }
    })
</script>
</body>
</html>