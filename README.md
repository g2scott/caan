caan
====

SECURITY

config.php
	enabled encryption of cookies
	enabled POST GET encryption ***OVERHEAD WARNING*** $config['global_xss_filtering'] = TRUE; 





openFB UPDATING

Remove '+ context' from the oauthcallback url.  It only adds index.php to the url which subsequently breaks the callback.


REMOVED vendors/ from composer .gitignore's