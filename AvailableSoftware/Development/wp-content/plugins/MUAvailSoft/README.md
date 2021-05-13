# MUAvailSoft WordPress Plugin

### 5.4.2021
Since the ajax function to add software is a long one that instantiates multiple class objects and calls their methods, I've added a little more robust error handling such that if a particular insert fails, the user can check the console to find out where it failed.

### Smart Search (Auto Suggestion)

#### 2.19.2021

The smart search function is broken up amongst 3 files. All files should be sufficiently documented to detail how the function actually works. 

jQuery -> MUAvailSoft/admin/js/adminjs.js
Ajax Handler -> MUAvailSoft/admin/ajax/ajax_functions.php
PHP Class -> MUAvailSoft/classes/SmartSearch_class.php

##### Database Interaction for Editing Software

I decided it would be easiest to simply remove the entire software package and all associated data rather than update since each row of software has so many relationships with other tables. I figured it would pare down the complexity and significantly reduce development time. After the previous information is removed, all of the info from the editing form is inserted into the DB, albiet under a new unique PK.


