var sarah_root = '/etc/SARAH/',
    app_root = 'www/apps/';
 //   app_root_exist = ;

var sh = require('execSync');	// executing system commands
var clc = require('cli-color');	// colours in the console

console.log ("Updating root SARAH repo");
sh.exec ("cd " + sarah_root + " && git pull");

console.log ("Reading package.json");
var packagejson = require (sarah_root + 'package.json'),
    numberOfApps = packagejson.apps.length;

var registeredPhpOutput = "<?php " + 
                          "$registered_apps = array ();";
// for file streams
var fs = require('fs'),
    fs_filename = "registered.php";

// create apps folder if needed
var result = sh.exec ("mkdir " + sarah_root + app_root);
console.log (result.stdout);

for (var i = 0; i <= numberOfApps - 1; i++) {
	// load package name
	console.log ();
	console.log (clc.whiteBright.bgGreen(" Loading " + packagejson.apps[i].name + " "));
	var appName = packagejson.apps[i].name,
	    gitPath = packagejson.apps[i].git,
	    appPath = packagejson.apps[i].path;

	// if the responce back from git clone contains "already exists" try doing a git pull
	var cmd = "cd " + sarah_root + app_root + " && " + "git clone " + gitPath;
	console.log ("> " + cmd)
	var clone = sh.exec (cmd).stdout

	if (clone.indexOf ("already exists") >= 0) {
		var cmd = "cd " + sarah_root + app_root + appPath + " && " + "git pull";
		console.log ("> " + cmd);
		console.log (sh.exec (cmd).stdout);
	}

	// update buffered output of registered.php
	registeredPhpOutput += "$registered_apps[] = '" + appPath + "';";
}

// write registered.php
fs.writeFile(sarah_root + app_root + fs_filename, registeredPhpOutput, function(err) {
    if(err) {
        console.log(err);
    } else {
        console.log(fs_filename + " updated");
    }
});

// compile SASS
console.log ();
console.log (clc.whiteBright.bgGreen("Compiling SASS"));
var cmd = "cd " + sarah_root + " && " + "grunt sass";
var result = sh.exec (cmd);
console.log (result.stdout);