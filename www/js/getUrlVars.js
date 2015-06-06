// jquery version: jquery-1.5.2
// site: http://jquery-howto.blogspot.ca/2009/09/get-url-parameters-values-with-jquery.html
// time: 20120929 22:20 EST
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}