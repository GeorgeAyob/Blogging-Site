<html>
<head>
  <title>Book-O-Rama Catalog Search</title>
</head>
<body>

  <?php 
include('includes/header.html');
  ?>
  
<br>
<br>
  <h1>Book-O-Rama Catalog Search</h1>

  <form action="resultsBook.php" method="post">
    
    Choose Search Type:<br />
    <select name="searchtype">
      <option value="Author">Author
      <option value="Title">Title
      <option value="ISBN">ISBN
    </select>
    <br />
    Enter Search Term:<br />
    <input name="searchterm" type="text" size="40">
    <br />
    <input type="submit" name="submit" value="Search">
  </form>



</body>
</html>

