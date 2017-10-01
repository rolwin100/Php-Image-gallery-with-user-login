<?php

$connection = mysqli_connect('localhost', 'root', '', 'company');

if (!$connection)
	{
	    echo ("Database Connection Failed");
	}
?>