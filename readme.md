# Brandeburg Properties

## Background
Around 2005 an associate was approached about redoing a website for a local property manager. I was brought onboard to
re-code the site.

## Features
 - Image Gallery
 - Retain original theme, but update and modernize the code base

## Goal
Code base refresh. 

## Requirements
 - Docker
 - Command prompt of some sort
 
## Road map
None; this project repository is for historic reference only.

## Usage
Clone the repository locally:
```
cd /project/root/parent
git clone https://github.com/davidjeddy/brandeburg.git
cd ./brandeburg
```

Then build and start the image via:

```
docker build -t brandeburg . --rm
docker run -d -h localhost -p 80:80 --name brandeburg_web -v "$PWD":/var/www/html brandeburg:latest --rm
docker logs -f brandeburg_web
```

Finally, if all went well, you should be able to visit `localhost` in your client browser of choice and see the 
application running.


## Warning
This project inception was pre-framework or best practice abeyance. If anything this is an example of hobbiest level web
development in the mid 2000s.

Though recently wrapped in a docker container for portability and hosted in a GiT repo; neither of which existed when
the site was made, this site IS NOT:
 - Secure
 - Pragmatic
 - Best practice adhering
 - An example of any sort of decent practices; if anything this is what you should NOT be doing
