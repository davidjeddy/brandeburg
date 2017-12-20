// JavaScript Document

<!--
 var imlocation = "images/buzzwords/";
 var currentdate = 0;
 var image_number = 0;
 function ImageArray (n) {
   this.length = n;
   for (var i =1; i <= n; i++) {
     this[i] = ' '
   }
 }
 image = new ImageArray(3)
 image[0] = 'knowledgeable.jpg'
 image[1] = 'productive.jpg'
 image[2] = 'productive2.jpg'

 var rand = 60/image.length
 function randomimage() {
 	currentdate = new Date()
 	image_number = currentdate.getSeconds()
 	image_number = Math.floor(image_number/rand)
 	return(image[image_number])
 }
 document.write("<img src='" + imlocation + randomimage()+ "' alt''>");
//-->