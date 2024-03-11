<?php
echo 'AE';

$ldapServer = 'ldap://ldap.unespar.edu.be:389';
$ldapPort = 389;
$ldapConnection = ldap_connect($ldapServer, $ldapPort);

if (!$ldapConnection) {
    die("Failed to connect to LDAP server");
} else {
    echo "hi!";
}

ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);

