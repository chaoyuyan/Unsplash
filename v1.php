<!DOCTYPE html>
<html>
<head>
    <title>Unsplash API Demo</title>
</head>
<body>
    <form method="get" action="">
        <label for="keyword">关键词：</label>
        <input type="text" name="keyword" id="keyword"><br>
        <label for="count">数量：</label>
        <input type="number" name="count" id="count"><br>
        <input type="submit" value="搜索">
    </form>

    <?php
    if (isset($_GET['keyword']) && isset($_GET['count'])) {
        $keyword = $_GET['keyword'];
        $count = $_GET['count'];

        // Replace "YOUR_ACCESS_KEY" with your actual Unsplash API access key
        $access_key = "your-key";

        // Build the API request URL
        $url = 'https://api.unsplash.com/photos/random?query=' . urlencode($keyword) . '&count=' . $count . '&client_id=' . $access_key;

        // Send the API request and get the search results
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (count($data) > 0) {
            // Output the images
            foreach ($data as $photo) {
                echo '<img src="' . $photo['urls']['regular'] . '">';
            }
        } else {
            echo 'No results found.';
        }
    }
    ?>
</body>
</html>
