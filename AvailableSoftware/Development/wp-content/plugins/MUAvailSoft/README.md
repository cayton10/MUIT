# MUAvailSoft WordPress Plugin

## Front End Markup / Functionality
This is accomplished by creating 'shortcodes' similar to what we're using with the Marsha WP theme for the university. I just started learning some of the nuances of this kind of work, and have created a "test-case" shortcode to get my bearings. You can find it [here](https://github.com/cayton10/MUIT/tree/main/AvailableSoftware/Development/wp-content/plugins/MUAvailSoft/includes/shortcodes).

Basically, I've started a file for shortcode function bodies and have written the definitions in this file. Call the function in the Main plugin page 'MUAvailSoft.php' to enable users to add them to their 'posts / pages'.

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


