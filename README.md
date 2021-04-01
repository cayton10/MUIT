# MUIT

This project was offered to me by the IT Administration office at Marshall University. The problem here was that Marshall's available software page through the IT website did not contain comprehensive information about University provided (or suggested) software packages. This page was also a static web page which linked to many other static pages related to University software and became cumbersome to maintain.

My solution to the problem was to create a custom php Wordpress plugin to incorporate into Marshall's Wordpress environment. This way, software packages can be updated site wide by pulling dynamically from a custom created database. 



## Admin Area

### Edit Software
Edit software functions similar to adding software. It actually uses the same function in the adminjs.js file 
``` javascript
array = pullData();
```
to grab all the information from the form, wrap it into an object array, and send it to the database for processing via ajax and php scripts.

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

