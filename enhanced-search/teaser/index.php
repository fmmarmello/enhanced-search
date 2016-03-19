<?php


if ($_GET['page']=='post'){

	// process post forms
	include $_GET['page'].'.php';

};


if ($_GET['page']=='info'){
	phpinfo();
};