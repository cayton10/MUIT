# MUIT

This project was offered to me by the IT Administration office at Marshall University. The problem here was that Marshall's available software page through the IT website did not contain comprehensive information about University provided (or suggested) software packages. This page was also a static web page which linked to many other static pages related to University software and became cumbersome to maintain.

Solution to the problem was to create a custom php Wordpress plugin to incorporate into Marshall's Wordpress environment. This way, software packages can be updated site wide by pulling data from tables added to the WP database. 

## Running the Project

Technologies required to run the project in it's current form
- Docker https://www.docker.com/products/docker-desktop
- Git https://git-scm.com/downloads

#### Clone This Repo Locally
Pull this project into a local directory of your choosing. 
- Navigate into the directory where you want to store the project
- Run shell command: $ git clone https://github.com/cayton10/MUIT.git

<strong>Voila</strong> you now have the project locally.

#### Get Docker Images and Run
- Start Docker
- Navigate to the plugin project directory: MUIT > AvailableSoftware
- Here you should have a docker-compose.yml file
- Run shell command: $ docker-compose up -d
    * You can use the -d flag meaning docker will run in <em>detached</em> mode
    * If the docker container is failing to run or you have other debugging problems, do not run in detached mode. Simply omit the -d flag.

### Getting Latest Changes
- Make sure you're on the main repo branch
```shell
$ git branch
```
- Your current branch will be highlighted in green.
- Run shell command:
```shell
$ git pull
```

## Pushing Changes
I highly suggest creating another repo for moving this project forward. If not that, at least make changes on a new branch and make a PR to this repo.


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

