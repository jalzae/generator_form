<script type="text/javascript">
    $("#formadd").submit(function(e) {
        var data = $(this).serialize();
        var method = $("#method").val();
        var fw = $("#framework").val();
        e.preventDefault();
        if (method == 1 && fw == 1) {
            $.ajax({
                type: "post",
                url: "bs/tables.php",
                data: data,
                success: function(response) {
                    $("#coding").html(response);
                }
            });
        } else {
            $("#coding").html("Not Detected Methods");
        }

    });
    $("#databases").change(function(e) {
        var data = $(this).val();
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "showtable.php",
            data: {
                data: data
            },
            success: function(response) {
                $("#tablenya").html(response);
                $("#tablenya").change();
            }
        });
    });

    $("#tablenya").change(function(e) {
        var data = $(this).val();
        var db = $("#databases").val();
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "showcolumn.php",
            data: {
                data: data,
                db: db
            },
            success: function(response) {
                $("#response").html(response);
            }
        });
    });


    $(window).on("load", function() {
        $("#databases").change();
    });
</script>