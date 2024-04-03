<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>
<body>
    <h1>Update Data</h1>
    <form action="" method="post">
        <label for="">id</label><input type="text" class ="id">
        <label for="">Table Name</label><input type="text" class ="table">
        <input type="submit" class="btn">

    </form>
    <script src="js/jquery.js"></script>
    <script>
       $(document).ready(function(){
    $(".btn").on("click", function(e){
        e.preventDefault();
        const id = $(".id").val();
        let table = $(".table").val(); 
        if (table === "") {
            table = "students";
            $(".table").val(table);
        }
        console.log(id,table);
        $.ajax({
            url: "db.php",
            method: "POST",
            data: {sid:id,stable:table},
            success: function(data){
                console.log(data);
            }
        });
    });
});

    </script>
</body>
</html>
