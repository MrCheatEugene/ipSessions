# How to use
```php
<?php

include('ipsessions.php');
$ipsession = new ipSession($_SERVER['REMOTE_ADDR']);
if($ipsession->error == false):
  // IP Session was created succesfully
  echo 'created successfully';
else:
  // IP Session failed to create, see 'error' variable in ipsession object.
  echo $ipsession->error;
endif;

// $ipsession->currentArray is your session array.
$ipsession->currentArray['foo']='bar';
if($ipsession->writeSession()){// Writing session
  // success
  echo 'session writed succesfully';
}else{
  // failure
  echo $ipsession->error;
}

// Use $ipsession->close() to delete session.
?>
```

# Can it be used to store personal info, just like $_SESSION?
**NO!**
__Well, nobody stops you from doing that, but risks that somebody with the same IP as the other person will be signed in as previous user are very high.__

**Do not use** this library to store user info. 
Store variables that you are unable to save in cookies-based session, but you are worried for their value.
Like, failed login attempts. 
