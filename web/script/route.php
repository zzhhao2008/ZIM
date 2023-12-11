<?php
Router::any("logup", "logup");

Router::login("/", "index.php");

Router::guest("/", "login");
