# Employee Management System

A full-featured Employee Management System built with Laravel and MySQL for managing employees, departments, designations, attendance, leaves, payroll, company settings, and reports.

## 🚀 Features

### Admin Panel

- Admin authentication
- Admin dashboard
- Employee management
- Department management
- Designation management
- Attendance management
- Leave management
- Payroll management
- Company settings
- Employee reports
- Attendance reports
- Leave reports
- Payroll reports
- Employee data export
- PDF generation for employee, attendance, leave, and payroll records

### Employee Panel

- Employee authentication
- Employee dashboard
- View and update profile
- Change password
- Attendance management
- Leave application and leave history
- Payroll information
- Employee-specific dashboard

### Authentication & Security

- User registration and login
- Password reset
- Email verification
- Password confirmation
- Role-based access using Admin and Employee middleware
- Form validation

## 🛠️ Tech Stack

- **Backend:** PHP, Laravel
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Admin Panel:** AdminLTE
- **Build Tool:** Vite
- **Authentication:** Laravel Breeze
- **Version Control:** Git & GitHub

## 📂 Project Structure

```text
app/
├── Exports/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   ├── Auth/
│   │   └── Employee/
│   ├── Middleware/
│   └── Requests/
├── Mail/
├── Models/
└── Providers/

database/
├── migrations/
├── factories/
└── seeders/

resources/
├── css/
├── js/
└── views/
    ├── admin/
    ├── employee/
    ├── auth/
    └── components/

routes/
├── auth.php
├── console.php
└── web.php
