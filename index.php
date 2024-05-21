<?php
require("Partials/Nav.php");
?>

<header class="h-[28rem] bg-gray-50">
    <div class="container mx-auto px-4 flex h-full py-6 items-center">
        <div class="max-w-xl">
            <p class="text-sky-500 uppercase tracking-wider">Knowledge base</p>

            <h2 class="text-3xl xl:text-4xl font-bold mt-4 text-gray-800 capitalize">All Resources you need to grow</h2>

            <p class="text-gray-500 mt-4 text-lg">Welcome to our platform, where your thoughts and ideas take center stage. Our website is dedicated to providing you with a seamless and empowering blogging experience. Whether you're a seasoned writer, an aspiring blogger, or someone with a story to share, our platform is your canvas.</p>
        </div>
    </div>
</header>

<section class="container mx-auto px-4 py-16">
    <div class="flex items-center justify-between">
        <h2 class="text-gray-800 font-bold text-3xl">Latest Blog</h2>

        <button class="flex items-center px-4 py-2.5 font-medium tracking-wide text-sky-500 capitalize transition-colors duration-300 transform border border-sky-500 rounded-lg hover:bg-sky-50 focus:outline-none focus:ring focus:ring-sky-300 focus:ring-opacity-80">
            <a href="Blogs.php" class="mx-1">Explore All</a>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 mx-1 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </button>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 mt-12 xl:grid-cols-3">
        <?php
        include("connect.php");
        $sqlSelect = "SELECT p.*, t.tagName FROM posts p LEFT JOIN post_tags pt ON p.postID = pt.postID LEFT JOIN tags t ON pt.tagID = t.tagID WHERE p.status = 'Approved' LIMIT 3";
        $result = mysqli_query($conn, $sqlSelect);
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <div class="bg-gray-100 p-10 rounded-lg hover:shadow-lg">
                <div>
                <h1 class="text-2xl font-bold mb-3 text-gray-800 truncate hover:text-sky-500">
                        <a href="view.php?id=<?= $data['postID'] ?>"><?= $data["title"]; ?></a>
                    </h1>
                    <span class="bg-gray-200 font-semibold mt-4 text-gray-600 px-2 py-1 rounded-lg text-md mr-2"><?=$data['tagName'] ?></span>

                    <p class="mt-2 text-gray-500 dark:text-gray-400"><?= substr($data["content"], 0, 128) ?>...</p>

                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <?php
                            $sql = "SELECT `fullName` FROM `user` WHERE `userID` = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $data["userID"]);
                            $stmt->execute();
                            $stmt->bind_result($fullName);
                            $stmt->fetch();
                            $stmt->close(); // Close the statement here
                            ?>
                            <a href="#" class="text-lg font-medium text-gray-700 hover:underline hover:text-gray-500"><?= $fullName; ?></a>

                            <p class="text-sm text-gray-500 dark:text-gray-400"><?= date("F d, Y", strtotime($data["date"])) ?></p>
                        </div>

                        <a href="view.php?id=<?= $data['postID'] ?>" class="inline-block text-sky-500 underline hover:text-sky-400">Read more</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<?php require("Partials/Footer.php"); ?>
