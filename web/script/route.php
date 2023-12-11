<?php
Router::login("/", "index");
Router::login("login","index");
Router::login("logup", "index");

Router::guest("logup", "logup");
Router::guest("/", "login");
