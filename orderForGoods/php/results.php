<html>
<head>
    <title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>

<?php
/**
 * 从MySQL数据库获取并格式化搜索结果，以便显示结果
 */
$search_type = $_POST['searchtype'];
$search_term = trim($_POST['searchterm']);
if(!$search_type || !$search_term) {
    echo 'You have not entered search details.Please go back and try again.';
    exit;
}

// 获取当前magic_quotes_gpc的配置选项设置
if(!get_magic_quotes_gpc()) {
    // 使用反斜线引用字符串
    $search_type = addslashes($search_type);
    $search_term = addslashes($search_term);
}

@$db = new mysqli('localhost', 'root', '', 'books');

if(mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.Please try again later.';
    exit;
}

$query = "select * from books where ".$search_type." like  '%".$search_term."%'";
$result = $db->query($query);

$num_results = $result->num_rows;
echo '<p>Number of books found: '.$num_results.'</p>';

for($i = 0;$i < $num_results;$i++) {
    $row = $result->fetch_assoc();
    echo '<p><strong>'.($i+1).'. Title: ';
    echo '</strong></p>';
}

?>
</body>
</html>



































