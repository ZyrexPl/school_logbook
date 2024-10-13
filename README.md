This project is an electronic school logbook developed using PHP. The application follows the MVC (Model-View-Controller) architectural pattern, making it well-organized and modular. The system allows for different user roles, including students, teachers, and administrators, each with specific permissions and views tailored to their needs.

The students can view their grades for each subject, while teachers have the ability to manage the grades for students in their respective subjects. Administrators have a broader control, with the capability to manage subjects, assign teachers to subjects, and perform user management tasks.

The project implements features such as secure user authentication using hashed passwords, user session handling, and dynamic content generation based on the user's role. The code is structured to follow best practices, including an autoloader for class management and separation of concerns between controllers, models, and views.

The application's URL routing is handled by a custom-built router that dynamically maps URL segments to corresponding controllers and actions. SQL queries are carefully crafted using prepared statements to prevent SQL injection attacks.

Demo of the application can be seen at <a href="test.zyrex.pl">test.zyrex.pl</a> (admin/admin).
