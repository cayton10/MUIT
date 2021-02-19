# MUIT

This project was offered to me by the IT Administration office at Marshall University. The problem here was that Marshall's available software page through the IT website did not contain comprehensive information about University provided (or suggested) software packages. This page was also a static web page which linked to many other static pages related to University software and became cumbersome to maintain.

My solution to the problem was to create a custom php Wordpress plugin to incorporate into Marshall's Wordpress environment. This way, software packages can be updated site wide by pulling dynamically from a custom created database. 


#### 1.6.2021

Created a mock admin page within the plugin directory. Will need to move these functions to their own files in the <strong>Admin</strong> directory once this is moved to the dev server.

#### 1.15.2021

Software packages can be added as tuples to the software table in the WP database via the <strong>Add Software</strong> plugin administrator's page.

#### 1.22.2021

Software packages are being sent to php ajax handler script to process information and upload to database.

#### 1.26.2021

All relevant software information except Department can successfully be added to DB. Future meetings needed to determine strict business rules for department and how to proceed.

## ToDo's:

### Smart Searching (Predictive Text)

As of <strong>2.19.21</strong> this functionality is working at 90% cap. 
I still need to:
- Style the dropdown divs
- Style the anchor tags containing the DB keyword result
- Fix the jQuery logic for adding the keyword to the list as a "button"

### Download location

Change wording for this link location. Make it clear that the information to enter should be the page containing the download link, not the link itself.

### Department Table

A list of departments will be needed to move forward with this feature.