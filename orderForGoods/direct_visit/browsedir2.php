<html>
<head>
  <title>Browse Directories</title>
</head>
<body>
<h1>Browsing</h1>
<?php
  $dir = dir("D:/wamp64/uploads");

  echo "<p>Handle is <b style='color:red;'>$dir->handle</b></p>";
  echo "<p>Upload directory is $dir->path</p>";
  echo '<p>Directory Listing:</p><ul>';

  while(false !== ($file = $dir->read()))
      //strip out the two entries of . and ..
      if($file != "." && $file != "..")
      {
          $file = iconv('gbk', 'utf-8', $file);
          echo '<li><a href="filedetails.php?file='.$file.'">'.$file.'</a></li><br>';
      }
  echo '</ul>';
  $dir->close();
?>
</body>
</html>
