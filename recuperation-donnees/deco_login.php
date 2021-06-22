<?php

session_start();
session_unset();
session_destroy();

header('Location: ../index2.php?message=you are disconnected');