# CourseManagementSystem
## Description
The Course Management System is a new tutorial allocation system, and designed for students, tutors and lecturers.

## Running
This project is a websit project which is implemented in PHP, and it is has been tested both on Sever and in XAMPP. Please download the repository and use XAMPP to run it.

### 1. Transfer the whole directory into XAMPP
Copy and paste the CourseManagementSystem folder into XAMPP's htdocs folder.

### 2. Start Apache and MySQL
Start the Apache and MySQL on XAMPP Contol Panel.

### 3. Make sure database is correctly set
This project's database is default running on localhost, please set the password on [db_conn](https://github.com/jxcharlie1991/CourseManagementSystem/blob/main/component/db_conn.php).

### 4. Transfer data
Firstly, create a new database MUST be called "chail" (if you don't like the name, you need to modify the [db_conn](https://github.com/jxcharlie1991/CourseManagementSystem/blob/main/component/db_conn.php)), then import the [Database Data](https://github.com/jxcharlie1991/CourseManagementSystem/blob/main/localhost.sql) into the database.

### 5. Open the website
If you copied the whole directory into htdocs, please input the address http://localhost/CourseManagementSystem-main into address bar. If you only copied the files and sub-directories into htdocs, please only input the address http://localhost into address bar.

## Test
This project is designed according to the [Research](#research) below. Please feel free to use the users below to explore and test all the pages.

### Student User Account
```
Name           Student id         Password
Liam           100001             Aa12345@            
Noah           100002             Aa12345@
William        100003             Aa12345@
James          100004             Aa12345@
Oliver         100005             Aa12345@
Benjamin       100006             Aa12345@             
Elijah         100007             Aa12345@
Lucas          100008             Aa12345@
Mason          100009             Aa12345@
Logan          100010             Aa12345@
Emma           100011             Aa12345@
Olivia         100012             Aa12345@
Ava            100013             Aa12345@
Isabella       100014             Aa12345@
Sophia         100015             Aa12345@
Charlotte      100016             Aa12345@
Mia            100017             Aa12345@
Amelia         100018             Aa12345@
Harper         100019             Aa12345@
Evelyn         100020             Aa12345@
```

### Staff User Account
```
Staff id      Name                      Password      Identity
202001        Kai Chiu Wong             Ac2333!       DC
202002        Riseul Ryu                Ac2333!       UC
202003        Mutaz Barika              Ac2333!       UC
202004        Dominic Duke              Ac2333!       UC
202005        John                      Ac2333!       Staff or Lecturer or Tutor
202006        Robert                    Ac2333!       Staff or Lecturer or Tutor
202007        Michael                   Ac2333!       Staff or Lecturer or Tutor
202008        William                   Ac2333!       Staff or Lecturer or Tutor
202009        David                     Ac2333!       Staff or Lecturer or Tutor
202010        Richard                   Ac2333!       Staff or Lecturer or Tutor
202011        Joseph                    Ac2333!       Staff or Lecturer or Tutor
202012        Thomas                    Ac2333!       Staff or Lecturer or Tutor
202013        Charles                   Ac2333!       Staff or Lecturer or Tutor
```

### Research

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
### Master List Page - academic staff
**Access: DC**

For the master list page for academic staff will need to modify the list of academic staff that will be available for selection of the lecturer and allocate tutors into the tutorial time. (i.e. database access is required). 

The degree coordinator can 
- View the academic staff unavailability
- Add or remove academic staff
- Allocate academic staff to be lecturer
- Allocate tutor to a unit
### Master List Page - Unit
**Access: DC**

In this page, the DC can add, remove or edit the units for the course including the offering semesters, campuses and its description. 
### Unit Detail Page – Unit Description Page
**Access: all**

In this page, the descriptions of the unit are displayed with basic information including the corresponding unit coordinator, the offering semesters and the offering campus.
### Unit Enrolment Page
**Access: student**

It will display available units for each student to enrol. In this page, students can enrol themselves into the unit and change their enrolment. The unit enrolment page needs to store a submitted unit enrolment request and update user account as required (i.e. database access IS required).
### Individual Timetable page
**Access: individual student**

It will display the student's timetable (including lectures and tutorials) that a user has enrolled in. If a student has not enrolled any unit, it will display empty timetable.
### User Account Page
**Access: all**

For assignment 2 the user account page needs to retrieve and update a user’s account details as required (i.e. database access IS required). User also can change their password, mobile number or e-mail address, etc.

Here a user can view their class timetable with the units they have enrolled in. Usuability must be considered.

The academic staff can
- Add, remove or update their unavailability 
### Unit Management / allocating teaching staff
**Access: DC, Unit Coordinator**

Here the UC can add or remove and consultation and tutorial time /location for the unit. The UC also allocates the lecturer for the unit (UC can be the lecturer or can allocate other staff members as a lecturer) and the tutor in the corresponding tutorial. Tutorial time must start on the hour or half-hour. i.e. a tutorial can start at 9:00, 9:30, 10:00, 10:30, or so on.
### Tutorial Allocation Page
**Access: student**

Student choose his preferred tutorial time for each enrolled unit.
The user must enrol themselves in the unit through unit enrolment page to allocate them into the tutorial. It will not allow a user to enrol a tutorial that exceeds the maximum capacity. 

The tutorial allocation page needs to store a submitted tutorial allocation request and update a user’s account as required (i.e. database access is required)
### Enrolled Student Details Page
**Access: DC, UC, lecturer, tutor**

This page is only available for the DC, UC, lecturer and tutor (Students cannot access to this page), and the list of students and their allocated tutorial time details are placed. Only the current student in 
each class will be visible. 
