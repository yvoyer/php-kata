--TEST--
Assert that the help output always show the right information
--FILE--
<?php
$_SERVER['argv'][1] = '--help';
require __DIR__ . '/../../../phpkata.php';
?>
--EXPECTF--
#!/usr/bin/env php
phpkata version 0.1.0

Usage:
 command [options] [arguments]

Options:
 --help (-h)           Display this help message
 --quiet (-q)          Do not output any message
 --verbose (-v|vv|vvv) Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
 --version (-V)        Display this application version
 --ansi                Force ANSI output
 --no-ansi             Disable ANSI output
 --no-interaction (-n) Do not ask any interactive question

Available commands:
 continue   End the specified kata.
 help       Displays help for a command
 list       Lists commands
 start      Start the specified kata.

