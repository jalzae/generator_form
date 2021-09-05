<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form Generator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <br />
            <form action="#" method="POST" id="formadd" role="form">



                <div class="form-group">
                    <label>Select DB</label>
                    <select name="databases" id="databases" class="form-control" required="required">
                        <?php
                        include('config.php');
                        $set = mysqli_query($success, "SHOW DATABASES;");
                        $dbs = array();
                        $kabehdb = array();
                        while ($db = mysqli_fetch_row($set))
                            $dbs[] = $db[0];
                        $hasil = count($dbs);
                        for ($i = 0; $i < $hasil; $i++) {
                            print_r("<option value='$dbs[$i]'>" . $dbs[$i] . "</option>");
                        }
                        mysqli_close($success);
                        ?>
                    </select>

                </div>

                <div class="form-group">
                    <label>Select Tables</label>

                    <select name="tablenya" id="tablenya" class="form-control" required="required">
                        <option value="0">Not Select Table</option>
                    </select>

                </div>

                <div class="form-group">
                    <label>Select Function</label>
                    <select name="method" id="method" class="form-control" required="required">
                        <option value="1">Add</option>
                        <option value="2">Edit</option>
                        <option value="3">Table</option>

                    </select>
                </div>
                <div class="form-group">
                    <label>Select Framework</label>
                    <select name="framework" id="framework" class="form-control" required="required">
                        <option value="1" selected>Bootstrap</option>

                    </select>
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

            <br>
            <div id="coding"></div>

            <br>
            <br>
            <textarea readonly class="col-sm-12" id="resultcoding"></textarea>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <br>
    <br>
    <br>
    <br>

    <?php include('part/function.php') ?>
</body>

</html>