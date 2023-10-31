<?php
session_start();
$fileName = "./data/users.json";
$users = json_decode(file_get_contents($fileName), true);
if ($_SESSION['role'] != "admin" && $_SESSION['role'] != "manager") {
    header("Location: index.php");
}

if (isset($_POST['add'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'] ?? "";

    //Validation
    if (empty($username) || empty($email) || empty($password)) {
        $errorMsg = "Please fill all the fields.";
    } else {
        if (isset($users[$email])) {
            $errorMsg = "Email already exists.";
        } else {
            $users[$email] = [
                "username" => $username,
                "password" => $password,
                "role" => $role,
            ];
            file_put_contents($fileName, json_encode($users, JSON_PRETTY_PRINT));
            header("Location: manage_role.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- component -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<body class="py-1 bg-blueGray-50">
    <section class="py-1 bg-blueGray-50">
        <h2>
            <?php
            echo isset($errorMsg) ? $errorMsg : "";
            ?>
        </h2>
        <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-24">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-blueGray-700">Manage User Role</h3>
                        </div>
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                            <button class="text-white bg-orange-500 active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"><a href="index.php">Home</a></button>

                            <button class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="addUserOpen()"><a>ADD</a></button>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center bg-transparent w-full border-collapse ">
                        <thead>
                            <tr>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    Email
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    NAME
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    ROLE
                                </th>
                                <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    ACTION
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($users as $email => $userData) {
                                echo '<tr>
                                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                        ' . $email . '
                                    </th>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                        ' . $userData['username'] . '
                                    </td>
                                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        ' . $userData['role'] . '
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <button
                                        class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button"><a href="delete_role.php?email=' . $email . '">Delete</a></button>

                                    <button
                                        class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button"><a href="edit_role.php?email=' . $email . '">Edit</a></button>
                                    </td>
                                </tr>';
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- Add user form -->
            <div class="flex items-center justify-center px-5 py-5 hidden" id="addForm">
                <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden absolute top-0 left-8" style="max-width:1000px">
                    <div class="md:flex w-full">
                        <div class="w-full  py-10 px-5 md:px-10">
                            <div class="text-center mb-10">
                                <h1 class="font-bold text-3xl text-gray-900">ADD USER</h1>
                            </div>
                            <div>
                                <form action="manage_role.php" method="POST">
                                    <div class="flex -mx-3">
                                        <div class="w-full px-3 mb-5">
                                            <label for="name" class="text-xs font-semibold px-1">Name</label>
                                            <div class="flex">
                                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                    <i class="mdi mdi-account-outline text-gray-400 text-lg"></i>
                                                </div>
                                                <input type="text" name="name" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Smith" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex -mx-3">
                                        <div class="w-full px-3 mb-5">
                                            <label for="email" class="text-xs font-semibold px-1">Email</label>
                                            <div class="flex">
                                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                    <i class="mdi mdi-email-outline text-gray-400 text-lg"></i>
                                                </div>
                                                <input type="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="johnsmith@example.com" id="email" name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex -mx-3">
                                        <div class="w-full px-3 mb-12">
                                            <label for="password" class="text-xs font-semibold px-1">Password</label>
                                            <div class="flex">
                                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                    <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                                                </div>
                                                <input type="password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************" id="name" name="password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex -mx-3">
                                        <div class="w-full px-3 mb-5">
                                            <label for="role" class="text-xs font-semibold px-1">Role</label>
                                            <div class="flex">
                                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                                    <i class="mdi mdi-account-outline text-gray-400 text-lg"></i>
                                                </div>
                                                <select name="role" id="role" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
                                                    <option value="user">User</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="manager">Manager</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex -mx-3">
                                        <div class="w-full px-3 mb-5">
                                            <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold" name="add">ADD</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <h1 class="cursor-pointer text-red-500 underline" onclick="addUserclose()">Hide The Form</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>