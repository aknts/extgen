# extgen
An extensions generator for Elastix, FreePBX and Asterisk.

The app generates a csv file to be used with Elastix/FreePBX bulk import modules.
For vanilla Asterisk, it generates the sip/iax/dahdi conf files needed to add a new extension on your installation.
Writen on an Elastix installation to ensure compatibility. Tested with FreePBX 2.11.
Not tested with Issabel and newer versions of FreePBX.
Use on your own. A mysql is needed to store data.
