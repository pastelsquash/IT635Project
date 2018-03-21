# IT635Project

# TESTING DELIVERABLES ON LIVE SITE

I've made a live site to help you check my deliverables - hopefully without the need to set my project up yourself. I'll provide the current AWS
link to my website alongside my turn-in, but I must warn you: it's changed URLs on me before while I've been live, so it may not be too reliable.

If it does work, here's what you can do:

### 1. Sign in as a user (individual deliverables)

I've provided a few user accounts you can use to sign in. They are:

1. jimbo
2. strongbad
3. cletus

Every user's username is also their password. (Yes, I do like to live dangerously.)

You should be able to check all 3 of my user deliverables from the user's view page. Note that "Lookup Spot" and "Leave Spot" are under a single header;
I'm searching for a user's current parking spot automatically.

When you're satisfied, you can sign out in the top left-hand corner's "Sign Out" button. If you don't see it, you're not signed in.

### 2. Sign in as an admin (individual deliverables + some common)

There's also two admin accounts. They are:

1. bwallace
2. manager

Guess what their passwords are? (Hint: I like to live VERY dangerously.)

Now, The admin's view is a bit more complicated: right next to the "Sign Out" button in the left-hand side of the top bar, there'll also be three different
views you can enter - Parking Admin, Partners Admin, and Database Search. They satisfy (hopefully) these deliverables:

Parking Admin:

1. Add/Remove Parking Location

Partners Admin:

1. Add/Remove ad partners
2. Link partner to spot / spot range
3. Search Advertising Partners (sort of - you can see who all's already a partner, but not all their info. See Database Search for the rest.)

Database Search:

1. View ad partner (not 100% on what you meant here, so the database search lets you see everything about a current partner.)
2. Functioning Web Interface (My tables and their content are 100% visible through the search function)
3. 1NF, 2NF, 3NF (Though I'm not always in 3NF! My users table, for example, could uniquely ID users based on both user_ID and user_name)
4. Hashed Security Info (though it's only passwords - a compromise I made so that the user search feature was actually useful. They're salted too!)

The few common deliverables that are not covered (or partially covered) above will require that you look at my github.

# GITHUB

I have a github! Here's the link:

https://github.com/pastelsquash/IT635Project

The branch to grade is the master branch - if I make a new branch, it'll be for work on the final project.

The github's structure is pretty straightforward. It has the following folders:

### The main folder

The main folder contains my dump file (Parking.dmp) and... this README. And an old useless backup dump. I think you know how to use these.

### The web folder (and web.old)

The web folder is everything that needs to go in /var/www/html in order to replicate my project. Other than installing the right packages (like apache, the php ones, php-mysqli, etc.), I really don't think you need to do anything else to get this working properly - I certainly don't remember modifying any config files.

Web.old is old. Ignore it: it was a repository for bad, shameful ideas.

### The include folder

The include folder has everything that needs to go in /var/www/include in order to replicate my project. It has two files:

1. studentDB.inc (yes, I never renamed it - or many of your functions)

	If this file isn't exactly where it's supposed to be, nothing works. If it IS where it's supposed to be, everything works. Mostly.

2. testdb.php

	This file doesn't really work anymore (many of the functions it checks are no longer in use), and isn't necessary to test any of my
	deliverables anymore - I made the website front-end more robust to make up for it. Between mysql itself and my website's content
	(and the github's contents), you should have everything you need to judge me.

# MYSQL DATABASE

Last thing to worry about is my database itself. If you're recreating my project, there's a couple rules to keep in mind:

1. The root user's password must be pastelsquash .
2. The database must be on localhost.
3. The database you dump to must be called Parking .
4. If the above are okay, my Parking.dmp file can be redirected into your MySQL with this command:

	mysql -u root -p < Parking.dmp

If it works, yay! If not, see 1 and 2 above. Or... diagnose things, I guess.

# IS IT WORKING?

If you're recreating my project, follow these guidelines:

1. Once you've installed the LAMP stack, see the "MYSQL DATABASE" header above - nothing's gonna work unless the database works.
2. Copy my git to your device:
	git clone https://github.com/pastelsquash/IT635Project.git
3. Move folders to their proper destinations:
	sudo cp <route to my git>/web/* /var/www/html/*
	sudo cp <route to my git>/include/* /var/www/include/*
4. Make sure apache is running.
5. Visit the site! (Or don't.)

Not sure how much more in-depth this needs to be, quite frankly. I really did just copy your shit and build on it - moved it all straight into a barebones LAMP stack.
Maybe I'm forgetting something, but if I did it's something you did too. Anything I forgot I learned from watching you.
