var sarah_root = '/etc/SARAH/',
    app_root = 'www/apps/';
 //   app_root_exist = ;

var sh = require('execSync');	// executing system commands
var clc = require('cli-color');	// colours in the console

console.log ("Reading package.json");
var packagejson = require (sarah_root + 'package.json'),
    numberOfApps = packagejson.apps.length;

// create apps folder if needed
var result = sh.exec ("mkdir " + sarah_root + app_root);
console.log (result.stdout);

for (var i = 0; i <= numberOfApps - 1; i++) {
	// load package name
	console.log ();
	console.log (clc.whiteBright.bgGreen(" Loading " + packagejson.apps[i].name + " "));
	var appName = packagejson.apps[i].name,
	    appPath = packagejson.apps[i].path;

	var cmd = "cd " + sarah_root + app_root + appPath + " && " + "git add . && git commit -m \"removed .gitignore from core\" && git push";
	console.log ("> " + cmd);
	console.log (sh.exec (cmd).stdout);
}