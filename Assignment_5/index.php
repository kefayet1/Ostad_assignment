<?php
session_start();
$fileName = "./data/users.json";
$users = json_decode(file_get_contents($fileName), true);

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
}

if (isset($_POST['manage_role'])) {
    header("Location: manage_role.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!-- component -->
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<body class="bg-blueGray-50">
    <section class="py-1">
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 flex items-center">
                            <h2 class="text-red-500 text-sm font-bold pr-4">Name:
                                <?php echo $_SESSION['name'] ?>
                            </h2>
                            <h2 class="text-red-500 text-sm font-bold ml-4">Role:
                                <?php echo $_SESSION['role'] ?>
                            </h2>
                            <form action="index.php" method="POST" class="ml-auto">

                        </div>
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                            <?php
                            if ($_SESSION['role'] == "admin") {
                                echo '<button class="bg-orange-500 text-white active:bg-orange-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit" name="manage_role">Manage Role</button>';
                            }
                            ?>

                            <button class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit" name="logout">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center bg-transparent w-full border-collapse ">
                        <thead>
                            <tr>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    EMAIL
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    NAME
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    ROLE
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($users as $email => $userData) {
                                echo '<tr>
                                <th 
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
                                    ' . $email . '
                                </th>
                                <td 
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    ' . $userData['username'] . '
                                </td>
                                <td 
                                    class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    ' . $userData['role'] . '
                                </td>
                            </tr>';
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>