<?php

if ($_SERVER["SERVER_NAME"] == "localhost") {
    // Database config
    define("DBNAME", "1576537_mydb");
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    
    define("ROOT", "http://localhost/ncaadynasty-new");
} else {
    // Database config
    define("DBNAME", "1576537_mydb");
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    
    // production root
    define("ROOT", "https://www.mywebsite.com");
}

define("APP_NAME", "NCAA Football Pickem");
define("APP_DESC", "Online college football picks game");
define("IMAGE_DIR","_assets/img/users/");
define("LOGO_IMAGE_DIR","../_assets/img/logos/");

// true means show errors
define("DEBUG", true);
date_default_timezone_set('America/Chicago');

const DIRTY = array(" fuck", " motherfuck", " ass ", "asshole", " damn", " shit ", " bitch", " bastard", " cunt" , " twat", " pussy", " dick", " cock", "nigger", "nigga");
const MSG = array ("", "Your message contained a naughty word. Your mother would be ashamed.", "User not found");

const WEEKS = array ("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "B");

const PASSINGSTATS = array('comp', 'att', 'yds', 'tds', 'int');
const RUSHINGSTATS = array('rush', 'yards', 'tds', 'fumb');
const RECEIVINGSTATS = array('rec', 'yards', 'tds', 'rac', 'drops', 'long');
const BLOCKINGSTATS = array('pancake', 'sacks');
const DEFENSESTATS = array('Solo','Asst', 'TFL', 'Sacks', 'INT', 'INTYds', 'Def', 'FF','FR', 'FYds', 'Blks', 'Sfty', 'TDs');
const KICKSTATS = array('fgm', 'fga', 'long', 'xmp', 'xpa', 'ko', 'tb');
const PUNTSTATS = array('long');
const KRSTATS = array('td');
const PRSTATS = array('td');
