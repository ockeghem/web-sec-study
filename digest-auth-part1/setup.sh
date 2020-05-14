#!/bin/sh
#
# シェルスクリプト形式になっているが、コピペ用と考えてください
#
sudo mkdir /var/www/html/digest
sudo vi /var/www/html/digest/secret.html
sudo vi /etc/apache2/sites-available/digest.conf
echo 'Set password "kghez8w@j$u"'
sudo htdigest -c /etc/apache2/.htdigest "Digest Auth" user1
sudo a2ensite digest
sudo a2enmod auth_digest
sudo systemctl restart apache2

