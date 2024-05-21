<?php require("Partials/Nav.php"); ?>

<section class="container mx-auto px-4 py-16">
    <div class="flex items-center justify-between">
        <h2 class="text-gray-800 font-bold text-3xl">All Articles</h2>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 mt-12 xl:grid-cols-3">
        <?php
        include("connect.php");
        // Select only approved posts
        $sqlSelect = "SELECT p.*, t.tagName FROM posts p LEFT JOIN post_tags pt ON p.postID = pt.postID LEFT JOIN tags t ON pt.tagID = t.tagID WHERE p.status = 'Approved'";
        $result = mysqli_query($conn, $sqlSelect);
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <div class="bg-gray-100 p-10 rounded-lg hover:shadow-lg">
                <div>
                    <h1 class="text-2xl font-bold mb-3 text-gray-800 truncate hover:text-sky-500">
                        <a href="view.php?id=<?= $data['postID'] ?>"><?= $data["title"]; ?></a>
                    </h1>
                    <span class="bg-gray-200 font-semibold mt-4 text-gray-600 px-2 py-1 rounded-lg text-md mr-2"><?=$data['tagName'] ?></span>

                    <p class="mt-2 text-gray-600 dark:text-gray-500">
                        <?= substr($data["content"], 0, 128) ?>...
                    </p>

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
                            <a href="#" class="text-lg font-medium text-gray-700 hover:underline hover:text-gray-500">
                                <?= $fullName; ?>
                            </a>

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
