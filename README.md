# email-generator-schrauger
Personal wildcard email generator

As I control the domain 'schrauger.com', I can spin up any email address I want. 
A catch-all (wildcard/asterisk) email can be useful, but it can get filled with spam
pretty quickly. So instead, I have a SQL database with valid email addresses that
can optionally expire after a time. With other fields, I can keep track of which email
address was given to which site, when it was created, and (hopefully) track the number
of emails sent to that address (and how many were rejected or accepted).

This project is a gui frontend for myself, so that I can easily create and modify those
SQL records. I hope to make a firefox plugin or userscript that will give me a simplified
approach. That way, I can go to a site with an email input, right-click on it, and the plugin
will automatically generate a site-specific email address, save the url and date/time, and fill
in the email field all in one easy click.
