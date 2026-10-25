<?php
// Declare and Initialize the variable
$errors = [];
$submitted = false;
$name = $email = $event = '';

// Each event's details and design
$events = [
    'hackathon' => [
        'title'   => 'Gemini No Code Hackathon 2026',
        'colour'  => 'primary',
        'icon'    => '💻',
        'date'    => '21 Oct – 30 Nov 2026',
        'time'    => '-',
        'venue'   => 'Online Platform',
        'message' => 'Get ready to build something great without writing a single line of code.',
        'tips'    => ['Prepare a stable internet connection', 'Form a team or join solo', 'Bring your best idea'],
    ],
    'college-sports' => [
        'title'   => 'UPM College Sports Basketball First Semester 26/27',
        'colour'  => 'danger',
        'icon'    => '🏀',
        'date'    => '26 Oct – 30 Oct 2026',
        'time'    => '5 P.M.',
        'venue'   => 'Sport Centre UPM',
        'message' => 'Lace up your shoes and bring your college spirit.',
        'tips'    => ['Wear sports attire and proper shoes', 'Bring a water bottle', 'Arrive 15 minutes early'],
    ],
    'festival' => [
        'title'   => 'PESKON 2026 Convocation Festival and Agricultural Expo',
        'colour'  => 'success',
        'icon'    => '🎪',
        'date'    => '30 Nov – 6 Dec 2026',
        'time'    => '8 A.M.',
        'venue'   => 'Dewan Besar PKKSSAAS',
        'message' => 'Come and enjoy the exhibitions, food stalls and performances.',
        'tips'    => ['Bring cash or an e-wallet for the stalls', 'Wear comfortable shoes', 'Invite your friends and family'],
    ],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $submitted = true;

    // 1. Sanitize
    $name  = trim(strip_tags($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $event = trim($_POST['event'] ?? '');

    // 2. Validate
    if ($name === '' || mb_strlen($name) > 100) {
        $errors[] = 'Please enter your name (maximum 100 characters).';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (!isset($events[$event])) {
        $errors[] = 'Please choose an event from the list.';
    }

    // 3. Insert into databases using MySQL in XAMPP
    if (!$errors) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $db = new mysqli('localhost', 'root', '', 'campus_event');
            $db->set_charset('utf8mb4');
            $stmt = $db->prepare(
                'INSERT INTO registration (name, email, event) VALUES (?, ?, ?)'
            );
            $stmt->bind_param('sss', $name, $email, $event);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            $errors[] = 'Sorry, we could not save your registration. Please try again later.';
        }
    }
}

// Design for the page after registration
$ok     = $submitted && !$errors;
$theme  = $ok ? $events[$event] : null;
$colour = $ok ? $theme['colour'] : 'secondary';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-<?= $colour ?>-subtle">
  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">

        <!--If the form is not submitted-->
        <?php if (!$submitted): ?>
          <div class="alert alert-warning" role="alert">
            Please use the registration form to submit your details.
          </div>
          <a href="index.html" class="btn btn-primary">Back to Main Page</a>

        <!--If there is any error-->
        <?php elseif ($errors): ?>
          <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
              <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <a href="index.html#register" class="btn btn-primary">Back to the form</a>

        <!--Else, no errors-->
        <?php else: ?>
          <div class="card border-<?= $colour ?> shadow"> <!--Using card to show the info-->
            <div class="card-header text-bg-<?= $colour ?> fs-5">
              <span aria-hidden="true"><?= $theme['icon'] ?></span>
              <?= $theme['title'] ?>
            </div>
            <div class="card-body">
              <h1 class="h4">Thank you, <?= htmlspecialchars($name) ?>!</h1>
              <p>Your interest has been successfully registered. <?= $theme['message'] ?></p>

              <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><strong>Date:</strong> <?= $theme['date'] ?></li>
                <li class="list-group-item"><strong>Time:</strong> <?= $theme['time'] ?></li>
                <li class="list-group-item"><strong>Venue:</strong> <?= $theme['venue'] ?></li>
              </ul>

              <h2 class="h6">Before you go</h2>
              <ul>
                <?php foreach ($theme['tips'] as $tip): ?>
                  <li><?= $tip ?></li>
                <?php endforeach; ?>
              </ul>

              <a href="index.html" class="btn btn-<?= $colour ?>">Back to Main Page</a>
              <a href="index.html#register" class="btn btn-outline-<?= $colour ?>">Register Another Event</a>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </main>
</body>
</html>