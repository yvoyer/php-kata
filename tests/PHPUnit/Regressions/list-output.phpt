--TEST--
Assert that the list command outputs all the available commands
--FILE--
<?php
$_SERVER['argv'][1] = 'list';
require __DIR__ . '/../../../phpkata.php';
?>
--EXPECTF--
#!/usr/bin/env php
phpkata version %s

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
 show       Show informations about the availables katas, or about a specific kata.
 start      Start the specified kata.
