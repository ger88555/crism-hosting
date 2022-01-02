<Directory "{{  config('filesystems.disks.hosting.root') . $domain . DIRECTORY_SEPARATOR . 'public' }}">
    DirectoryIndex index.php
    AllowOverride All
    Order allow,deny
    Allow from all

    Header set Access-Control-Allow-Headers "ORIGIN, X-REQUESTED-WITH, CONTENT-TYPE"
    Header set Access-Control-Allow-Methods "POST, GET, OPTIONS, PUT, DELETE"
    Header set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Credentials true
    Header set Access-Control-Max-Age 60000
</Directory>