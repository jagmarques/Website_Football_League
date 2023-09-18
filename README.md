# Website_Football_League

Website_Football_League is a web application for managing a football league. Users can create teams, join contests, play games, and request substitutes. The application is built using HTML, CSS, Javascript, PHP, and MySQL. It includes different screens and features for various user roles, including users, captains, managers, and admins.

## Screens Description

### Home Screen (index.php)
- For users who have not logged in, the home screen displays existing teams in the database and open positions within those teams.
- Users can also view contests and games.
- Users can register in the system through a dedicated page with instructions.

### About Page
- Contains information about the project and its development.

### User (Basic Permissions)
- Teams: List of teams in the database, allowing users to create a team and view information about their teams.
- Contests: List of contests with the option to become a substitute and view contest details.
- Games: List of registered games with the ability to request substitutes, and a list of other games for viewing.
- Edit User: Edit user information and contact the treasurer.
- Messages: Display user notifications.

### Captain
- All screens and features available to users.
- In the "Teams" section, captains can edit team data information.

### Manager
- All screens and features available to users.
- In the "Contests" section, managers can create contests, generate games, and view game calendars.

### Admin
- All screens and features available to both managers and captains.
- Admins can also delete games from contests.

## Validations

The application includes various data validations to ensure data is entered correctly during registration:
- Checks if names are strings.
- Ensures passwords have more than 4 characters.
- Verifies if email addresses already exist and are correctly formatted.
- Validates citizen card numbers for uniqueness.

## Getting Started

To set up and run this project locally, follow these steps:

1. Clone the repository to your local machine.

2. Configure your web server to serve the project's files.

3. Import the provided MySQL database schema to set up the database.

4. Update the database connection details in the PHP files.

5. Access the application through your web server.


