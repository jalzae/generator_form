<?php
$data = json_decode(file_get_contents('php://input'), true);

foreach ($data as $obj) {

    $name = str_replace('_', ' ', $obj['name']);

    if ($obj['write'] == "yes") {

        if ($obj['status'] == "not") {
            $obj['status'] = "";
        }
        echo '&#13;<div class="form-group">';
        echo '&#13;<label>' . ucfirst($name) . '</label>';

        if ($obj['type'] == "select") {
            echo '&#13;<select name="' . $obj['name'] . '" id="' . $obj['name'] . '" class="form-control" ' . $obj['status'] . '>';
            echo '&#13;<option value="0">Select</option>';
            echo "&#13;</select>";
        } else if ($obj['type'] == "datetime") {
            echo " ini nanti";
        } else if ($obj['type'] == "textarea") {
            echo '&#13;
                <textarea name="' . $obj['name'] . '" id="' . $obj['name'] . '" class="form-control" rows="3" ' . $obj['status'] . '"></textarea>';
        } else {
            echo '&#13;<input type="' . $obj['type'] . '" name="' . $obj['name'] . '" id="' . $obj['name'] . '" class="form-control" value="" ' . $obj['status'] . ' >';
        }

        echo '&#13;</div>';
        echo '&#13;';
    } else {
    }
}
