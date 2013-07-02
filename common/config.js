var config = new Object();

/* thingbroker url */
pathArray = window.location.href.split( '/' );
protocol = pathArray[0];
temp_host = pathArray[2].split(':');
host = temp_host[0];
url = protocol + '//' + host;
config.thingbroker_url = url+':8080/thingbroker';

/* app name */
config.app_name = 'ubercomp';