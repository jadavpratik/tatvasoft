<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>CSRF-TOKEN PAGE</h1>
    <h4 id='token'></h4>

<script>
    function get_token(){
        let cookie = document.cookie.split(';');
        cookie = cookie.map((i)=> {
            arr = [];
            key = i.split('=')[0].trim();
            value = i.split('=')[1].trim();
            arr[key]=value;
            return arr;
        });
        let filtered = cookie.filter((i)=> {
            return i['CSRF-TOKEN'];
        } );
        document.getElementById('token').innerHTML = filtered[0]['CSRF-TOKEN'];
        return filtered[0]['CSRF-TOKEN'];
    }
    get_token();
</script>
</body>
</html>

