MarketoLeads
============

Synopsis:

A Marketo-like webhook to obtain attribute-values for a Marketo lead and place in a cookie

Installation:

There are two folders used in this project, service/ and js/.  They both need to be added to your hosting account.

On the back end:

In the file service/api-settings.php, provide values for the access key, secret key and the soap API endpoint; these are
available in your Marketo account.

In the file service/user-settings.php, you can optionally provide an email address to send errors via the variable
$error_email_address.  

You can also modify the list of Marketo lead attributes to provide to the cookie via the
$attributes hash.  The format of the attributes hash is:

Marketo attribute name => cookie label name

Please refer to Marketo's documentation for a list of available lead attribute names.

On the front end:

1) This application requires that the user's browser has JavaScript and cookies enabled

2) On the web page(s) on which you want the cookies created, pull in jQuery:

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>

and use the JavaScript from this project, which is located at: /js/marketo-lead.js

The application, out of the box, assumes the distribution is in the following directory structure:

/DIR/
  ------>js/
  ------>service/
  ------>*.html, *.php, etc.
  
  If this is the case, you can pull in the marketo-lead.js script with this tag:
  
  <script src="/js/marketo-lead.js"></script>
  
  If you have a different directory structure, you will need to modify the above script tag.  Moever, you will need to 
  modify the service variable on approximately line 41 of the marketo-lead.js script, as it is currently set to:
  
  '/service/getLead.php'

Expected output:

The output will be a cookie named 'mkto_lead_data', whose value is a stringified JSON object of defined attribute-value
paris.  Note that if a particular attribute in Marketo is not set or is undefined, it will not appear in the cookie.  
Only attributes with set values will be in the cookie.


