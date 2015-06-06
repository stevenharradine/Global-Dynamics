// taken from http://stackoverflow.com/questions/1144783/replacing-all-occurrences-of-a-string-in-javascript on 20150330 at 11:12 EST
// extended to be a prototype
String.prototype.replaceAll = function (find, replace) {
	return this.replace(new RegExp(find, 'g'), replace);
};