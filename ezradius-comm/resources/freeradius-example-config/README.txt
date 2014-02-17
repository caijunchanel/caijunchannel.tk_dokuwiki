This folder contains ALL my own freeRADIUS configuration files. Use this as an example
howto prepare freeRADIUS so it can be managed using ezRADIUS. 

If you have freeRADIUS version prior to 1.1.4 use radiusd.conf

If you have freeRADIUS version 1.1.4 or above:
	rename radiusd.conf into radiusd.conf.v113
	rename radiusd.conf.v114 into radiusd.conf
	
don't forget to edit sql.conf for MySQL host, username and password.

edit clients.conf to match your NAS client password (Chillispot sharedsecret)
