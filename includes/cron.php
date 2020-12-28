<?php

/*
 * Cron info is saved in $_CRON
 */

/**
 * We should ALWAYS mark a cron else it will stuck running!
 */
/**
 * Please know that the cron file will NOT inherit plugin properties. meaning Config::get will not work like the way it does in the plugin files.
 * To get the config "helloworld" in the plugin you would have to run Config::get("plugin_PLUGINNAME_helloworld") here
 */
if (isset($_CRON)) {

    $Key = "plugin_" . $_CRON["Plugin"] . "_database_uri";

    consoleLog($Key);



    $Test = \crisp\api\Config::set($Key, trim(shell_exec("/usr/local/bin/heroku config:get DATABASE_URL -a edit-tosdr-org")));

    consoleLog("Setting Config: $Test");


    \crisp\api\lists\Cron::markAsFinished($_CRON["ID"]);
}