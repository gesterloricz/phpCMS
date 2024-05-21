<?php require("partials/headerAdmin.php") ?>

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Skubidopakpak</h3>

        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                </div>
            </div>
        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white">
                    <div>
                        <?php
                        $id = isset($_GET["id"]) ? $_GET["id"] : null;
                        if ($id) {
                            include("../connect.php");
                            $selectPost = "SELECT p.*, t.tagName FROM posts p LEFT JOIN post_tags pt ON p.postID = pt.postID LEFT JOIN tags t ON pt.tagID = t.tagID WHERE p.postID = $id";
                            $result = mysqli_query($conn, $selectPost);
                            if (mysqli_num_rows($result) > 0) {
                                $data = mysqli_fetch_array($result);
                        ?>
                                <div class="post w-100 bg-light p-5">   
                                    <p class="mt-2 text-gray-500"><?= date("F d, Y", strtotime($data["date"])) ?></p>
                                    <h1 class="text-3xl xl:text-5xl font-bold mt-4 mb-4 text-gray-800 capitalize"><?php echo  $data['title']; ?></h1>
                                    <span class="bg-gray-200 mt-4 text-gray-600 px-2 py-1 rounded-lg text-md mr-2"><?=$data['tagName'] ?></span>
                                    <p class="mt-10 leading-loose text-gray-600"><?php echo $data['content']; ?></p>
                                </div>
                        <?php
                            } else {
                                echo "Post Not Found";
                            }
                        } else {
                            echo "Invalid Post ID";
                        }
                        ?>
                    </div>
                    <div class="px-6 py-4 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <div class="inline-flex mt-2 xs:mt-0">
                            <form method="post" action="approve.php">
                                <input type="hidden" name="postID" value="<?php echo htmlspecialchars($id); ?>">
                                <button type="submit" name="approve" class="text-sm bg-green-300 hover:bg-green-400 text-gray-800 font-semibold py-2 px-4 rounded-md mx-3">Approve</button>
                            </form>
                            <form method="post" action="reject.php">
                                <input type="hidden" name="postID" value="<?php echo htmlspecialchars($id); ?>">
                                <button type="submit" name="reject" class="text-sm bg-red-300 hover:bg-red-400 text-gray-800 font-semibold py-2 px-4 rounded-md mx-3">Reject</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?php require("partials/footerAdmin.php") ?>