var config = new Object();

/* thingbroker url */
pathArray = window.location.href.split( '/' );
protocol = pathArray[0];
host = pathArray[2];
url = protocol + '//' + host;
config.thingbroker_url = url+':8080/thingbroker';

/* app name */
config.app_name = 'ubercomp';