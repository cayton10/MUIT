# MUAvailSoft WordPress Plugin



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