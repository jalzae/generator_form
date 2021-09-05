<?php
$db = $_POST["databases"];
$dbnya = $_POST["tablenya"];
$success = new mysqli("localhost", "root", "", "$db");

$set = mysqli_query($success, "SHOW FIELDS FROM $dbnya");

$dbs = array();
$types = array();
$nulls = array();

// var_dump($dbs);
// var_dump($types);
// var_dump($nulls);
?>

<table id="details" class="table table-bordered">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Required</th>
            <th scope="col">Add it?</th>
            <th style="display: none;" scope="col">Type</th>
            <th style="display: none;" scope="col">Required</th>
        </tr>
    </thead>
    <tbody>
        <?php

        while ($db = mysqli_fetch_row($set)) {
            $dbs[] = $db[0];
            $types[] = $db[1];
            $nulls[] = $db[2];
        }
        $hasil = count($dbs);
        for ($i = 1; $i < $hasil; $i++) {
        ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $dbs[$i] ?></td>
                <td align="center">
                    <div class="form-group">
                        <select id="my-select" class="custom-select typenya" name="my-select">
                            <option selected value="text">Text</option>
                            <option value="email">Email</option>
                            <option value="password">Password</option>
                            <option value="textarea">Textarea</option>
                            <option value="hidden">Hidden</option>
                            <option value="select">Select</option>
                            <option value="datetime">Datepicker</option>
                        </select>
                    </div>

                </td>
                <td align="center">
                    <div class="form-group">
                        <select id="my-select" class="custom-select requirenya" name="my-select1">
                            <?php
                            if ($nulls[$i] == "YES") {
                            ?>
                                <option value="required">Required</option>
                                <option selected value="">Not Required</option>
                            <?php
                            } else {
                            ?>
                                <option selected value="required">Required</option>
                                <option value="not">Not Required</option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select id="my-select" class="custom-select optionnya" name="my-select1">
                            <?php
                            if ($nulls[$i] == "YES") {
                            ?>
                                <option value="yes">Yes</option>
                                <option selected value="no">No</option>
                            <?php
                            } else {
                            ?>
                                <option selected value="yes">Yes</option>
                                <option value="no">No</option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>
                </td>
                <td style="display: none;">text</td>
                <td style="display: none;"><?php
                                            if ($nulls[$i] != "YES") {
                                                echo "required";
                                            } else {
                                                echo "not";
                                            }
                                            ?></td>
                <td style="display: none;"><?php
                                            if ($nulls[$i] == "YES") {
                                                echo "no";
                                            } else {
                                                echo "yes";
                                            }
                                            ?></td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<button type="button" id="getform" class="btn btn-primary">Generate it !!</button>
<button type="submit" style="float: right;" id="copythis" class="btn btn-primary">Copy</button>

<script>
    $(".typenya").change(function(e) {
        var table = document.getElementById("details"),
            rIndex, cIndex;

        data = $(this).val();
        // table rows
        for (var i = 1; i < table.rows.length; i++) {
            // row cells
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                table.rows[i].cells[j].onclick = function() {
                    rIndex = this.parentElement.rowIndex;
                    cIndex = this.cellIndex + 1;
                    console.log("Row : " + rIndex + " , Cell : " + cIndex);

                    table.rows[rIndex].cells[5].innerHTML = data;
                };
            }
        }
    });
    $(".requirenya").change(function(e) {
        var table = document.getElementById("details"),
            rIndex, cIndex;

        data = $(this).val();
        // table rows
        for (var i = 1; i < table.rows.length; i++) {
            // row cells
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                table.rows[i].cells[j].onclick = function() {
                    rIndex = this.parentElement.rowIndex;
                    cIndex = this.cellIndex + 1;
                    console.log("Row : " + rIndex + " , Cell : " + cIndex);

                    table.rows[rIndex].cells[6].innerHTML = data;
                };
            }
        }
    });
    $(".optionnya").change(function(e) {
        var table = document.getElementById("details"),
            rIndex, cIndex;

        data = $(this).val();
        // table rows
        for (var i = 1; i < table.rows.length; i++) {
            // row cells
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                table.rows[i].cells[j].onclick = function() {
                    rIndex = this.parentElement.rowIndex;
                    cIndex = this.cellIndex + 1;
                    console.log("Row : " + rIndex + " , Cell : " + cIndex);

                    table.rows[rIndex].cells[7].innerHTML = data;
                };
            }
        }
    });
    $("#getform").click(function(e) {
        var table = document.getElementById("details");
        var tableArr = [];

        for (var i = 1; i < table.rows.length; i++) {
            tableArr.push({
                id: table.rows[i].cells[1].innerHTML,
                name: table.rows[i].cells[1].innerHTML,
                type: table.rows[i].cells[5].innerHTML,
                status: table.rows[i].cells[6].innerHTML,
                write: table.rows[i].cells[7].innerHTML,
            });
        }

        console.log(tableArr);
        let data = JSON.stringify(tableArr);

        $.ajax({
            type: "post",
            url: "bs/add.php",
            data: data,
            success: function(response) {
                $("#resultcoding").html(response);
            }
        });
    });

    $("#copythis").click(function(e) {
        e.preventDefault();
        $("#resultcoding").select();
        document.execCommand('copy');
        alert("copied");
    });
</script>