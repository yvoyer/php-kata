--TEST--
Assert that the show kata command output all the availables katas
--FILE--
<?php
$_SERVER['argv'][1] = 'show';
require __DIR__ . '/../../../phpkata.php';
?>
--EXPECTF--
#!/usr/bin/env php

  Here is a list of all available katas ready to be executed.

  You can start any kata using the start command:

    phpkata.php start {kata-name}

Available katas

   Name          Description                                      
   fibonacci     Calculate the sum of the two previous numbers.

