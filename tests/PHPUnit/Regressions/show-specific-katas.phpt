--TEST--
Assert that the `show {kata-name}` command output all the information about the kata
--FILE--
<?php
$_SERVER['argv'][1] = 'show';
$_SERVER['argv'][2] = 'fibonacci';

require __DIR__ . '/../../../phpkata.php';
?>
--EXPECTF--
#!/usr/bin/env php

Kata information:

Kata:           fibonacci
Description:    Calculate the sum of the two previous numbers.
Objectives:
