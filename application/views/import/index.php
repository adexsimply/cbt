
<!DOCTYPE html>
<html>
<head>
  <title>Codeigniter Import Example</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
<form action="<?php echo base_url();?>upload/save" method="post" enctype="multipart/form-data">
    Upload excel file : 
    <input type="text" name="some_text" value="" /><br><br>
    <input type="file" name="userfile" value="" /><br><br>
    <input type="submit" name="importfile" value="Upload" />
</form>
</body>
</html>