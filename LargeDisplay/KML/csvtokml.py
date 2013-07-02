# -*- coding: cp1252 -*-
import csv, os

print os.getcwd()
#Input the file name.
fname =  './google-addresses'
data = csv.reader(open(fname + '.csv'), delimiter = ',')
#Skip the 1st header row.
k=data.next()
#Open the file to be written.
f = open('GeoDataForImages.kml', 'w')

#Writing the kml file.
f.write("<?xml version="+"'1.0'"+" encoding="+"'UTF-8'?>\n")
f.write("<kml xmlns='http://earth.google.com/kml/2.2'>\n")
f.write("<Document>\n")
f.write("   <name>" + fname + '.kml' +"</name>\n")
f.write('<Style id="normalPlacemark">\n  <IconStyle>\n       <Icon>\n            <href>http://web.cs.dal.ca/~rizi/img/dal2.png</href>\n        </Icon>\n     </IconStyle>\n</Style>\n')



f.write("   <Placemark>\n")
#f.write("       <name>" + str(row[2]) + "</name>\n")
f.write('       <description> <![CDATA[  <a href="'+ k[3].strip("'") + '"'+"><img src=\""+k[4].strip("'")+'" width="120" /><a></br>'+  k[2].strip("'")+'<br /><a href="'+ k[3].strip("'") +'">Click me</a> ]]></description>\n')

f.write(" <styleUrl>#normalPlacemark</styleUrl>\n")
f.write("       <Point>\n")
f.write("           <coordinates>" + k[0].strip("'") + "," + k[1].strip("'")  + "</coordinates>\n")
f.write("       </Point>\n")
f.write("   </Placemark>\n")






for row in data:
    f.write("   <Placemark>\n")
    #f.write("       <name>" + str(row[2]) + "</name>\n")
    f.write('       <description> <![CDATA[  <a href="'+ row[3].strip("'") + '"'+"><img src="+row[4].strip("'")+' width="120" /><a></br>'+  row[2].strip("'")+'<br /><a href=\"' + row[3].strip("'") +'">Click me</a><br/>'+'<img src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl='+row[5]+'" alt="qr code"/>'+']]></description>\n')
    f.write("<styleUrl>#normalPlacemark</styleUrl>\n")
    f.write("       <Point>\n")
    f.write("           <coordinates>" + row[0].strip("'") + "," + row[1].strip("'")  + "</coordinates>\n")
    f.write("       </Point>\n")
    f.write("   </Placemark>\n")
f.write("</Document>\n")
f.write("</kml>\n")
f.close()
