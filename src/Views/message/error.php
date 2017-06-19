<?php include ROOT . "/src/Views/layouts/header.php"; ?>
    <h3>Error</h3>

<?php
if(isset($msg)) {
    $html = "<div class='col-md-6 col-md-offset-3'><table class='table table-striped'>
            <thead>
            <tr>
                <th class='text-center'>Key</th>
                <th class='text-center'>Value</th>            
            </tr>
            </thead>
            <tbody>";
    foreach ($msg as $key => $val) {
        $html .= "<tr>";
        $html .= "<td>$key</td>";
        $html .= "<td>$val</td>";
        $html .= "</tr>";
    }
    $html .= "</tbody></table></div>";

    echo $html;
}
?>

<?php include ROOT . "/src/Views/layouts/footer.php"; ?>