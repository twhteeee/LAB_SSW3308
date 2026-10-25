# Campus Events Portal – Lab 2b

## PHP as server-side scripting and XAMPP MySQL

- PHP form handling and MySQL (register.php)
- The form in index.html uses action="register.php" method="post".

### Database

- Database (phpMyAdmin)
- Database: campus_event (character set utf8mb4)
- Table: registration with columns NO (auto-increment primary key), NAME, EMAIL, EVENT

### PHP

- Runs only when $\_SERVER['REQUEST_METHOD'] == 'POST'. Opening the page directly shows a yellow warning.
- Sanitizes input: trim(), strip_tags() on the name and FILTER_SANITIZE_EMAIL on the email.
- Validates on the server: name not empty and at most 100 characters, a valid email format and an event that exists in the $events allowlist.
- Shows a result page whose colour, icon, date, time, venue and tips depend on the chosen event:  
  | Event | Colour | Bootstrap classes |
  |-------|--------|-------------------|
  |Gemini No Code Hackathon 2026 | Blue | bg-primary-subtle, text-bg-primary |
  |UPM College Sports Basketball | Red | bg-danger-subtle, text-bg-danger |
  |PESKON 2026 Convocation Festival and Agricultural Expo | Green | bg-success-subtle, text-bg-success |
