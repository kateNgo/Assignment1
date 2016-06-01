# Assignment1

This assignment requires you to create an Online Travel Agency. Visitors to the site can book airline tickets and pay by credit card. Details of the trips booked by them are sent by email. The website is menu driven. You can use the basic site code (including image maps) learned from the lecture or you can use your own code if you prefer. The first thing you will have to do is add a "Your Bookings" menu option. This can be added as part of the main menu or (preferably) as a link elsewhere on the page. It should always be available to visitors to the site no matter what web page on the site they happen to be looking at.

The "Home" menu option will simply bring up a page telling visitors to the website that it was created as an Assignment for the subject Programming on the Internet at the University of Technology, Sydney for Autumn semester 2016. However, if you like you can put in other information.

Visitors to the site can search for flights using the "Search Flights" menu option. The structure of the database table that is searched is set out below :

The database name is "poti"
The table name is "flights"

The attributes associated with each flight:
+-----------+-------------+------+-----+---------+----------------+
| Field     | Type        | Null | Key | Default | Extra          |
+-----------+-------------+------+-----+---------+----------------+
| route_no  | int(5)      | NO   | PRI | NULL    | auto_increment |
| from_city | varchar(20) | YES  |     | NULL    |                |
| to_city   | varchar(20) | YES  |     | NULL    |                |
| price     | float(8,2)  | YES  |     | NULL    |                |
+-----------+-------------+------+-----+---------+----------------+


Flights available for sale:
+----------+---------------+---------------+--------+
| route_no | from_city     | to_city       | price  |
+----------+---------------+---------------+--------+
|        1 | Sydney        | Melbourne     | 180.00 |
|        2 | Sydney        | Brisbane      | 170.00 |
|        3 | Sydney        | Canberra      | 120.00 |
|        4 | Canberra      | Sydney        | 120.00 |
|        5 | Sydney        | Newcastle     |  90.00 |
|        6 | Newcastle     | Sydney        |  90.00 |
|        7 | Sydney        | Broken Hill   | 130.00 |
|        8 | Broken Hill   | Sydney        | 130.00 |
|        9 | Melbourne     | Sydney        | 180.00 |
|       10 | Melbourne     | Canberra      | 140.00 |
|       11 | Canberra      | Melbourne     | 140.00 |
|       12 | Melbourne     | Adelaide      | 175.00 |
|       13 | Melbourne     | Hobart        | 130.00 |
|       14 | Melbourne     | Bendigo       |  70.00 |
|       16 | Bendigo       | Melbourne     |  70.00 |
|       17 | Melbourne     | Launceston    | 100.00 |
|       18 | Adelaide      | Melbourne     | 175.00 |
|       19 | Adelaide      | Broken Hill   | 100.00 |
|       20 | Broken Hill   | Adelaide      | 100.00 |
|       21 | Adelaide      | Perth         | 220.00 |
|       22 | Adelaide      | Darwin        | 230.00 |
|       23 | Darwin        | Adelaide      | 230.00 |
|       24 | Darwin        | Alice Springs | 120.00 |
|       25 | Alice Springs | Darwin        | 120.00 |
|       26 | Perth         | Adelaide      | 220.00 |
|       27 | Perth         | Albany        | 100.00 |
|       28 | Perth         | Kalgoorlie    |  80.00 |
|       29 | Perth         | Broome        |  90.00 |
|       30 | Albany        | Perth         | 100.00 |
|       31 | Kalgoorlie    | Perth         |  80.00 |
|       32 | Broome        | Perth         |  90.00 |
|       33 | Launceston    | Melbourne     | 100.00 |
|       34 | Launceston    | Hobart        |  80.00 |
|       35 | Hobart        | Melbourne     | 130.00 |
|       36 | Hobart        | Launceston    |  80.00 |
|       37 | Brisbane      | Sydney        | 170.00 |
|       38 | Brisbane      | Mt Isa        | 170.00 |
|       39 | Brisbane      | Rockhampton   | 180.00 |
|       40 | Brisbane      | Cairns        | 230.00 |
|       41 | Brisbane      | Darwin        | 240.00 |
|       42 | Mt Isa        | Brisbane      | 170.00 |
|       43 | Rockhampton   | Brisbane      | 180.00 |
|       44 | Cairns        | Brisbane      | 230.00 |
|       45 | Darwin        | Brisbane      | 240.00 |
|       46 | Mt Isa        | Darwin        | 120.00 |
|       47 | Darwin        | Mt Isa        | 120.00 |
|       48 | Adelaide      | Pt Augusta    |  50.00 |
|       49 | Pt Augusta    | Adelaide      |  50.00 |
+----------+---------------+---------------+--------+
48 rows in set (0.00 sec)

Note that this is a very simple table with only four attributes. In the assignment we are not going to worry about other flight details, such as flight numbers, times, or dates of departure. We are also going to ignore updating the database. (We have a magic database - it never runs out of flights).

Database

A MySQL account has been created for you to access the database "poti", on the server "rerun".

Details of the account:
The username to access the database is "potiro"
The password to access the database is "pcXZb(kL"

Unix Command line:
username: potiro  password: pcXZb(kL (select/read-only access)

MySQL Command line:
mysql -h rerun -u potiro -p  poti

Process

Use PFE (Windows) or PICO, VI, or emacs (Unix) to edit your DHTML and PHP files.
Use a graphic tool of your choice or PC Paint to create your clickable menu (or image maps).
Use clickable menu to create your input (query) field to search an particular flight.
Use PHP code to retrive flights' information from MySQL database
Test each component of your system, and then integrate all components into a complete system.
Once you have done that you will need to expand the search page so that it can search on from_city, to_city, or a combination of both. Note that you might be able to interact with the database using AJAX to populate drop down lists that can be used to select flights. Alternatively you could use some kind of graphical selection method or just simply some html input tags of type text. In all cases, the user's input should be validated to make sure only correct city names are entered.

If a search returns one or more rows of data, the data should be neatly set out using a table or CSS. If the user's search returns more than one flight then the user should be presented with a page that allows them to select a particular flight. The graphic below shows a example of what is required.

assignment form 1
Once a particular flight is selected and the submit button pressed, users will be presented with a screen that presents the basic flight details and 5 rows for the flight they have selected. Each row represents one seat on the flight. The row should have a checkbox so it can be selected and checkboxes for "Child", "Wheelchair" and "Special Diet". Below this there should be a display of the total number of seats selected. At the bottom of the page there should be a button labelled "Add to Bookings". This button should not work unless at least one seat has been booked. If users attempt to add to bookings without any seats booked, then a dialog box or message should appear.

If the user has correctly selected one or more seats and pressed the "Add to Bookings" button, they should be presented with a screen that lists their booked flights. At the bottom it should have buttons with the following options - "Book more Flights", "Clear all booked flights" and "Proceed to Checkout". If the user presses the "Clear all booked flights" menu option, then all flights booked so far should be deleted from the session. If the user presses the "Book more Flights" button they should be sent to the search page exactly the same as if they had pressed the "Search Flights" option of the main menu.

If the user presses the "Proceed to Checkout" button they should be presented with a form labelled "Complete Booking - stage 1 of 4 - Personal Details".

This page will get the user to enter the following information :

Given Name, Family Name, Address Line 1, Address Line 2, Suburb, State, Postcode Country, email address, mobile phone, business phone and work phone. If the country is Australia then all fields except Address Line 2 and the phone numbers must be completed. If the country is NOT Australia then Address Line 2, State, Postcode, and phone numbers are optional. Note that you should use the convention of a red asterisk to indicate which fields are compulsory. You should also put a note (in small red type perhaps) saying that State and postcode are optional fields for booking made from outside Australia.

At the bottom of the page is a button labelled "Stage 2 - Payment Details". When the user presses the button, the web page should validate the personal data. If the data is invalid in some way then the user should be informed of the error through a dialog box. Do not make the error dialog box too verbose. If there is a blank field simply say that one or more compulsory fields is blank. If all fields are complete, but there is some kind of invalid data tell the user what field is incorrect e.g. there is a a problem with the postcode field or whatever.

If the data entered by the user for stage 1 is valid, then the user is sent to a form labelled "Complete Booking - Stage 2 of 4 - Payment Details". The top of the form will have printed out the personal details the user entered in stage 1 - note these will not be in the form itself but simply neatly printed out above the form.

The website only allows payment by credit card. The payment details page section will get users to enter the following information :

Credit Card type (Visa, Diners, Mastercard, Amex), Credit Card Number, Name on Credit Card, expiry month date, expiry year date and security code (3 digits). All of these fields are compulsory and this should be clearly indicated on the page.

At the bottom of the page there will be a button labelled "Stage 3 - Review Bookings and Details". When the user presses this button, your code should thoroughly check the details entered by the user. It should check that all fields are completed and they contain valid data - e.g. Credit Cards is 12 digits, expiry month number is valid. Also they should check that the expiry date of the card is in the future.

If the data entered is valid, then the button should take the user to Stage 3 of 4 - Review Details. This page will have the purchaser's name and address, email address and the full details of the flights they have booked. It will not have the credit card details. Instead it will have the notation Credit Card details supplied. At the bottom there will be a button saying "Stage 4 - Confirm Payment". When this button is pressed, the user will be sent an email will be sent to the user showing their name and address and all details of the flights booked. The user will also be presented with a page saying in reasonably large type:

"Thank You! .... your booking has been completed and a confirmation email has been sent to your email address".

Your code should also clear all data in the user's session at this point.

Aditional Notes : The page brought up by the "Your Bookings" menu option mentioned in paragraph 2 should simply say "You have no bookings" if the user has not actually booked anything. If the user has made some bookings but has not completed all of the payment process, the "Your Bookings" page should list all of the users bookings in tabular form, and have a checkbox at the end of each row. The checkbox should indicate that the user can delete flights by using the checkbox.

At the bottom of the page there should be two buttons. One labelled "Delete selected Flights" - the other labelled "Proceed to Checkout". If the first button is pressed the button should be checked to see if any checkboxes have been selected and the appropriate flights deleted for that user's session. After any selected flights have been deleted, the user should be returned to a new "Your Bookings" page which will say either "You have no Bookings" if the user deleted all bookings or it will list the remaining flights if that user still has flights.

The Contact Web page should bring up a form which allows users to send an email to your UTS email address. The form should have a field for the subject of the email, the user's email address, the user's first name, the user's last name, a textarea for the contents of the email and a submit button. The subject fields, user's email address and textarea are all compulsory fields. When the submit button is pressed a confirmation email should be sent to the email address the user supplied.
