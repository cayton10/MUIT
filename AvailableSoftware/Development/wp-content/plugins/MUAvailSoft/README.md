# MUAvailSoft WordPress Plugin

### Department Listing
A redundant list of departments was used in this V.1 package of MUAvailSoft just to get the ball rolling and start development. This list could also be deployed to production, but it will likely have an adverse affect on UX for front end pages. 

#### Week of 3.22.2021
After being instructed to use the redundant department listing we've been given, functionality was added to the Add Software and Edit Software administrative plugin pages. Introducing functionality and tying the department functions into existing operations took some time and debugging.

### Smart Search (Auto Suggestion)

#### 2.19.2021

The smart search function is broken up amongst 3 files. All files should be sufficiently documented to detail how the function actually works. 

jQuery -> MUAvailSoft/admin/js/adminjs.js
Ajax Handler -> MUAvailSoft/admin/ajax/ajax_functions.php
PHP Class -> MUAvailSoft/classes/SmartSearch_class.php

#### 2.23.2021

Added functionality so user's can `TAB` select a suggestion or use mouse clicks to select.
When the suggestion is selected, the input fields are populated with that selection and the
suggestion div is hidden. 


### Edit Software (Admin Page)

#### 2.23.2021

Adding functionality to return all information related to software package located in DB.

##### Multiple Queries from Software Class function

In order to reduce duplication of data, multiple queries are fired in the 'getAllSoftDetails'
Software class function. Appropriate package results are loaded into an associative array with
designated array keys so it's easier to output the information needed and cuts down on the amount
of text recieved by a single query.

#### 2.25.2021

Spent most of the day removing or fixing bugs that I introduced to the system by adding functionality. Fixed things like: smartSearch Divs not hiding after adding options, duplication of buttons for search terms and package alternatives... various bugs.

##### Database Interaction for Editing Software

I decided it would be easiest to simply remove the entire software package and all associated data rather than update since each row of software has so many relationships with other tables. I figured it would pare down the complexity and significantly reduce development time. After the previous information is removed, all of the info from the editing form is inserted into the DB, albiet under a new unique PK.

#### 3.25.2021

