var sarah_root = '/etc/SARAH/',
    app_root = 'www/apps/',
 //   app_root_exist = ,

    clc = require('cli-color'),	// colours in the console
    fs  = require('fs'),			// for file streams
    fs_filename = "registered.php",

    DB_CONFIG = JSON.parse(fs.readFileSync(sarah_root + 'config.json', 'utf8')),

    isSassOnly = process.argv[2] == "sass"
var sys = require('sys')
var exec = require('child_process').exec

function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}

function compileSassFolder (folderPath) {
	console.log (folderPath);

	fs.readdir (folderPath, function (error, files) {
		files.forEach (function (file) {
			if (file.toLowerCase().indexOf(".scss") >= 0) {
				console.log ("SASSing " + folderPath + file);

				exec("cd " + folderPath + " && " + "sass " + file + " " + file.split('.scss')[0] + ".css", function (error, stdout, stderr) {
					sys.print('stdout: ' + stdout);
					sys.print('stderr: ' + stderr);
					if (error !== null) {
						console.log('exec error: ' + error);
					}
				})
			}
		});
	});
}

if (!isSassOnly) {
	console.log (clc.whiteBright.bgGreen("Updating root SARAH framework repo"));
	
	exec("cd " + sarah_root + " && git pull", function (error, stdout, stderr) {
		sys.print('stdout: ' + stdout);
		sys.print('stderr: ' + stderr);
		if (error !== null) {
			console.log('exec error: ' + error);
		}
	})

	// load inital sql
	exec("mysql -u " + DB_CONFIG.DB_USER + " --password=" + DB_CONFIG.DB_PASS + " " + " < " + sarah_root + "/init.sql", function (error, stdout, stderr) {
		sys.print('stdout: ' + stdout);
		sys.print('stderr: ' + stderr);
		if (error !== null) {
			console.log('exec error: ' + error);
		}
	})
}

console.log ("Reading package.json");
var packagejson = require (sarah_root + 'package.json'),
    numberOfApps = packagejson.apps.length;

var registeredPhpOutput = "<?php " + 
                          "$registered_apps = array ();";

// create apps folder if needed
exec("mkdir " + sarah_root + app_root, function (error, stdout, stderr) {
	sys.print('stdout: ' + stdout);
	sys.print('stderr: ' + stderr);
	if (error !== null) {
		console.log('exec error: ' + error);
	}
})

for (var i = 0; i <= numberOfApps - 1; i++) {
	// load package name
	console.log ();
	console.log (clc.whiteBright.bgGreen(" Loading " + packagejson.apps[i].name + " "));
	var appName     = packagejson.apps[i].name,
	    appSafeName = replaceAll (" ", "", appName),
	    gitPath     = packagejson.apps[i].git,
	    appPath     = packagejson.apps[i].path;

	if (!isSassOnly) {
		// if the response back from git clone contains "already exists" try doing a git pull
		var cmd = "cd " + sarah_root + app_root + " && " + "git clone " + gitPath + " " + appSafeName;
		console.log ("> " + cmd)
		exec(cmd, function (error, stdout, stderr) {
			sys.print('stdout: ' + stdout);
			sys.print('stderr: ' + stderr);
			if (error !== null) {
				console.log('exec error: ' + error);
			}

			if (stderr.indexOf ("already exists") >= 0) {
				var cmd = "cd " + sarah_root + app_root + appSafeName + " && " + "git pull";
				console.log ("> " + cmd);
				exec(cmd, function (error, stdout, stderr) {
					sys.print('stdout: ' + stdout);
					sys.print('stderr: ' + stderr);
					if (error !== null) {
						console.log('exec error: ' + error);
					}
				})
			}
		})
	}

	// compile SASS
	compileSassFolder (sarah_root + app_root + appSafeName + "/css/");

	if (!isSassOnly) {
		// load inital sql
		exec("mysql -u " + DB_CONFIG.DB_USER + " --password=" + DB_CONFIG.DB_PASS + " " + DB_CONFIG.DB_NAME + " < " + sarah_root + app_root + appPath + "/init.sql", function (error, stdout, stderr) {
			sys.print('stdout: ' + stdout);
			sys.print('stderr: ' + stderr);
			if (error !== null) {
				console.log('exec error: ' + error);
			}
		})

		// compile updaters
		exec("cd " + sarah_root + app_root + appSafeName + "/updater && bash compile.sh", function (error, stdout, stderr) {
			sys.print('stdout: ' + stdout);
			sys.print('stderr: ' + stderr);
			if (error !== null) {
				console.log('exec error: ' + error);
			}
		})

		// configure system for app
		exec("ansible-playbook -i \"localhost,\" " + sarah_root + app_root + appSafeName + "/playbook.yml", function (error, stdout, stderr) {
			sys.print('stdout: ' + stdout);
			sys.print('stderr: ' + stderr);
			if (error !== null) {
				console.log('exec error: ' + error);
			}
		})
	}

	// update buffered output of registered.php
	registeredPhpOutput += "$registered_apps[] = '" + appSafeName + "';";
}

if (!isSassOnly) {
	// write registered.php
	fs.writeFile(sarah_root + app_root + fs_filename, registeredPhpOutput, function(err) {
	    if(err) {
	        console.log(err);
	    } else {
	        console.log(fs_filename + " updated");
	    }
	});
}

// compile SASS
compileSassFolder (sarah_root + "www/css/");
