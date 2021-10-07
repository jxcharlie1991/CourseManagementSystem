# CourseManagementSystem
## Application Overview
This project is a websit project which is implemented in PHP. It has implemented all the functions of a real Course Management System. The file "localhost.sql" is my database, before uploading the website to server, you should import the file into your database. If you want to run this software on your personal device, you need to change the database setting to your xampp's setting.
### [See Code](https://github.com/jxcharlie1991/CourseManagementSystem)

## Application Introduction Video

[![](https://i.ytimg.com/an_webp/UQv0bn9mlc4/mqdefault_6s.webp?du=3000&sqp=CPKy-ooG&rs=AOn4CLD-fp9_4N5NINQb2-gWmdOxIv1wpA)](https://youtu.be/UQv0bn9mlc4)

[Click for the whole video](https://youtu.be/UQv0bn9mlc4)

[![](https://i.ytimg.com/an_webp/5GnwWwFSCss/mqdefault_6s.webp?du=3000&sqp=CP-w-ooG&rs=AOn4CLC0ivA5l4CxBaE_JG5AhsFufYm4Rg)](https://youtu.be/5GnwWwFSCss)

[Click for the whole video](https://youtu.be/5GnwWwFSCss)
## SQL data

[SQL data](https://github.com/jxcharlie1991/CourseManagementSystem/blob/main/localhost.sql)

## Self Evaluation
Disadvantages of this website: It cannot show the consultation timetable (although UC and DC can allocate the consultation time), it cannot allocate a UC and DC, and so on. Another shortage is that I was not a programmer before, so I do not know the preference that other programmers have. For example, I just use words “enrolled”, “enrol”, “choose” and “success” on the button, because I don’t know what should be written on the button. Another problem is the choice of Synchronou and Asynchronous, almost every page need to communicate with database, so there is a choice of Synchronou and Asynchronous. In this project, I prefer to display my my skills and logic, so I use Asynchronous more than Synchronou.

Note: Please follow the rule when set IDs, it must be 6 numbers, unit code uses three letters and three numbers, because I didn’t limit the inputs in php, there are already too many limits in the website. All the accounts have allocated levels, lecturers or tutors, if you want to text the access level, you need to undo allocate in Master List Allocation, or register a new account. In addition, I used bootstrap, jquery, ajax, jquery tabledit, bootstrap icons in the website, and I use several Internet pictures in the website, and other codes are all my own work.

## Details
UDW has three different campuses:
* Pandora
* Rivendell
* Neverland

UDW offers four study periods:
* Semester 1
* Semester 2
* Winter School
* Spring School

The site serves as a comprehensive portal with information on timetables, unit details, academic staff and functions such as tutorial allocation and unit enrolment. 

Students, teaching team of Unit Coordinator (UC), Lecturers, and Tutors as well as the Degree Coordinator (DC) are the main users. 

There will be two Master lists: Academic Staff and Units. 

Master list of academic staff contains the list of the UC, lecturers and tutors. Master list of Units contains the list of units offered by the UDW. The degree coordinator may manage both master lists of academic staff and units.

Each UC will be responsible for selecting tutors from the “Master List of Academic staff”. This will be included in the Unit details. (i.e., the list of tutors of each unit)

Each unit will have at least 2 academic staff (numbers are determined by DC), one of whom will be assigned to be the UC by the DC. Lecturers and tutors can be rostered to work at any unit, but there can be only one lecturer at each campus for each unit at a time. 

To use the CMS, staff and students must first register by providing Student/Staff ID, Name, E-mail address, and password for mandatory information. Address, Date of Birth, and Phone number are optional. 

Each class has a maximum capacity of students in the class. If a class is full, students cannot enrol into it. They instead must choose another available class. For example, if the capacity of tutorial is a maximum of 20 people, then students cannot join that tutorial once the tutorial is full. Also, different labs have different capacities which will be applied when students are allocated.

## Role Description
```
Role                       Description
Degree Coordinator (DC)    • Will decide
                               *  what units will be available at each semester; and
                               *  who will be teaching for each unit
                           • Will responsible for 
                               * giving access level to casual staff (assignment 2)
Unit Coordinator (UC)      • Will decide
                               * who will be a lecturer for the unit for each campus; 
                               * the lecture time; and
                               * the tutorial times
                           • Can add or remove tutor/students
Lecturer                   • Can view the student list of the corresponding unit
                           • Can add or remove tutor/students
Tutor                      • Can view the student list of the corresponding tutorial
Student                    • Can enrol unit and tutorial
```
