# Website_Football_League
Web app for a football league. Users can create teams, join contests, play games, and request substitutes. It uses HTML, CSS, Javascript, PHP and MySQL. It has different screens and features for users, captains, managers and admins

Screens description:
For a user who has not logged in, the home screen (index.php) shows the teams that exist in the database and the vacant positions in those teams. The user can also see the contests that exist and the games. The user can also register in the system on a page for that purpose that contains instructions for the user to navigate the system. There is also an About page that contains information about the project that was developed. After login: User: If the user who logged in only has basic permissions, then he/she has access to the following elements:

- Teams: list of teams that exist in the database, with a distinction on the page of their teams and those that are not yet registered. On the teams page you can also create a team and view information about your teams.
- Contests: list of contests that exist, having the option to choose to be a substitute in any of them and view the information of each one.
- Games: list of games in which you are registered and the other games that exist in the system. In the games you are registered in, you can request a substitute and in the other games you can only view the information.
- Edit User: page to edit user information and consult treasurer contact.
- Messages: shows messages/notifications that the user may have.
- About: system information. Captain: has all the screens that User has with the following differences:
- Teams: has an additional Manager button for each team in which he/she is captain, which serves to edit team data information.
- Manage Team: contains all fields to edit information of a particular player, team and has option to register games. Manager: has all screens that User has with following differences:
- Contests: has Create Contest button to create a new contest, Generate Games to generate games for that contest and Calender to view generated games.
- Create Contest: contains fields needed to create a contest.
- Calender: calendar of games. Admin: has all screens and features of both Manager and Captain and can also delete games from contests.

Validations:
There are validations in the program to check that data is entered correctly in Registration, namely if names are strings, if password has more than 4 characters, if email already exists and if it was entered correctly and also if citizen card number already exists.
