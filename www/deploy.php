<?php
  echo str_replace ("\n", '<br />', shell_exec ('/usr/bin/node /etc/SARAH/scripts/setup-apps.js'));
