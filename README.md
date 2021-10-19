# CourseManagementSystem
## Description
The University of DoWell in Wonderland (UDW) has started to build a Course Management System including a new tutorial allocation system. To increase the efficiency and the effectiveness of the enrolment process, the University has decided to develop a website where the students, tutors and lecturers can use.


### [See Code](https://github.com/jxcharlie1991/CourseManagementSystem)

## Application Introduction Video

[![](https://github.com/jxcharlie1991/CourseManagementSystem/blob/main/img/Thumbnail1.png)](https://youtu.be/UQv0bn9mlc4)

### [Click for the whole video](https://youtu.be/UQv0bn9mlc4)

[![](https://github.com/jxcharlie1991/CourseManagementSystem/blob/main/img/Thumbnail2.png)](https://youtu.be/5GnwWwFSCss)

### [Click for the whole video](https://youtu.be/5GnwWwFSCss)

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

## Research

A Course Management System (CMS) usually allows the University to manage unit enrolment, and tutorial allocation. A CMS usually provides the following functions:
- The management of units
- Tutorial allocation management 
- Student management
- Academic staff information

### Home Page
**Access: all**

The login/logout section include authentication of a user (i.e. database access is required)
### Registration page
**Access: all**

The registration page will need to store the registration data (i.e. database access is required).
When the registration data is stored to the database, password encryption is required. The crypt() function and using salt are expected for encryption.
