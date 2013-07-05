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

/* image location */
config.image_location = '../common/images/';

/* image view url (for QR codes) */
config.image_qrcode = 'https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl='+
						protocol + '//' + temp_host + '/mobile/view.php?img=';

config.large_image = '-large';
config.small_image = '-thumb';