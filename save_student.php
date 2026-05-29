<?php
// save_student.php
header('Content-Type: application/json');

// DB Config
$host = 'localhost';
$db   = 'student_db';
$user = 'root';
$pass = '';

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    exit;
}

// Sanitize
$name          = htmlspecialchars(trim($input['name'] ?? ''));
$gender        = htmlspecialchars(trim($input['gender'] ?? ''));
$standard      = htmlspecialchars(trim($input['standard'] ?? ''));
$dob           = htmlspecialchars(trim($input['dob'] ?? ''));
$age           = (int)($input['age'] ?? 0);
$email         = htmlspecialchars(trim($input['email'] ?? ''));
$father_name   = htmlspecialchars(trim($input['father_name'] ?? ''));
$father_mobile = trim($input['father_mobile'] ?? '');

// Server-side validation
if (!$name || !$standard || !$dob || !$age || !$email || !$father_name) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email.']);
    exit;
}
if (!preg_match('/^\d{10}$/', $father_mobile)) {
    echo json_encode(['success' => false, 'message' => 'Mobile must be 10 digits.']);
    exit;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO students (name, gender, standard, dob, age, email, father_name, father_mobile)
            VALUES (:name, :gender, :standard, :dob, :age, :email, :father_name, :father_mobile)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name'          => $name,
        ':gender'        => $gender,
        ':standard'      => $standard,
        ':dob'           => $dob,
        ':age'           => $age,
        ':email'         => $email,
        ':father_name'   => $father_name,
        ':father_mobile' => $father_mobile
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}