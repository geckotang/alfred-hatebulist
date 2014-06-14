<?php
require("workflows.php");
$wf = new Workflows();

$filename = "~/.hatebulist";
system('echo '.$query.' > '.$filename);
$wf->result(time(), $query, $query, $query."を登録します", "icon.png");

echo $wf->toxml();
?>
