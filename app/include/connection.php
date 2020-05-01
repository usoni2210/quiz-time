<?php

  # replace these value to use it locally
  $HOST_URL = getenv("MYSQL_HOST_URL");
  $MYSQL_USER = getenv("MYSQL_USERNAME");
  $MYSQL_PASS = getenv("MYSQL_PASSWORD");
  $QUIZ_TIME_DB = getenv("DATABASE_NAME");

	$con = mysqli_connect($HOST_URL, $MYSQL_USER, $MYSQL_PASS, $QUIZ_TIME_DB) or die("Could not connect to mysql".mysqli_error($con));
