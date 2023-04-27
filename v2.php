<?php
if (isset($_GET['query'])) {
  // Replace "YOUR_ACCESS_KEY" with your actual Unsplash API access key
  $access_key = "your key";
  $query = $_GET['query'];
  $per_page = 9;  // Number of search results to retrieve

  // Build the API request URL
  $url = "https://api.unsplash.com/search/photos?query=" . urlencode($query) .
         "&per_page=$per_page&client_id=$access_key";

  // Send the API request and get the search results
  $response = file_get_contents($url);
  $results = json_decode($response)->results;

  if (count($results) > 0) {
    // Select a random photo from the search results
    $random_index = rand(0, count($results) - 1);
    $random_photo = $results[$random_index];

    // Get the URL of the selected photo
    $photo_url = $random_photo->urls->regular;
	//$photo_url = str_replace("https://images.unsplash.com", "https://yourdomain.com", $random_photo->urls->regular);

  } else {
    $error_message = "No results found for \"$query\"";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>随机图片</title>
</head>
<body>
  <h1>生成随机图片</h1>
  <form>
    <label for="query">输入关键词</label>
    <input type="text" name="query" id="query" required>
    <button type="submit">确定</button>
  </form>

  <?php if (isset($error_message)): ?>
    <p><?php echo $error_message; ?></p>
  <?php elseif (isset($photo_url)): ?>
    <p>马上就好</p>
    <img src="<?php echo $photo_url; ?>" alt="<?php echo $query; ?>">
  <?php endif; ?>
</body>
</html>
