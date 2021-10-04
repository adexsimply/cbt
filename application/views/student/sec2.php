<?php
     $i=1;
    foreach ($students as $student) {
   
      if (($student->class == 25) || ($student->class == 26) || ($student->class == 27) || ($student->class == 28) || ($student->class == 29) || ($student->class == 30)) {
      $recipients = $student->phone;
      $password = $student->password;
      $username = $student->username;
      $flash = 0;
      $message = "Greetings student. 
E-learning activities resume on Wednesday 6th, January 2021. Check your Info box to be guided. 
Use the detail below to access your e-learning page:
Website  https://csmtschools.com Username: ".$username." Password: ".$password." Thank you.";

    //$result = $this->useJSON($this->json_url, $this->username, $this->apikey, $flash, $this->sendername, $message, $recipients);
    
    echo $i."--".$student->username."-".$student->class."<br>";
    
    $i++;
    }
    }

 ?>