<?php
session_start();
if ($_SESSION['role'] != "admin") {
    header("Location: index.php");
}
$fileName = "./data/users.json";
$users = json_decode(file_get_contents($fileName), true);
$role = "";
$email = "";

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    if ($users[$email]) {
        $role = $users[$email]['role'];
    }
}

if (isset($_POST['submit'])) {
    $inputRole = $_POST['role'];
    if (isset($users[$email])) {
        $users[$email]['role'] = $inputRole;
        file_put_contents($fileName, json_encode($users, JSON_PRETTY_PRINT));
        header("Location: manage_role.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Tailwind Styled Form</title>
</head>

<body class="bg-gray-200 p-4">
    <form class="max-w-md mx-auto bg-white rounded p-6 shadow-md" action="edit_role.php?email=<?php echo $email; ?>" method="POST">
        <div class="mb-4">
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Change Role</label>
            <select name="role" id="role" class="w-full px-4 py-2 border rounded-md">
                <option value="admin" <?php echo $role === "admin" ? "selected" : "" ?>>Admin</option>
                <option value="manager" <?php echo $role === "manager" ? "selected" : "" ?>>Manager</option>
                <option value="user" <?php echo $role === "user" ? "selected" : "" ?>>User</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="text" name="email" id="email" class="w-full px-4 py-2 border rounded-md" value="<?php echo $email; ?>" readonly>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="submit">
                Submit
            </button>
        </div>
    </form>
</body>

</html>