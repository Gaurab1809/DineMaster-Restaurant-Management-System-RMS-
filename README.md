<!-- Logo -->
<p align="center">
  <img src="DineMaster_Logo.png" alt="DineMaster Logo" width="400"/>
</p>

<!-- Title Banner -->
<p align="center">
  <img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%8D%BB%20DineMaster%20-%20Restaurant%20Management%20System&fontSize=36&width=1200&height=150&color=0:FFA500,100:FF4500"/>
</p>

<h3 align="center">
  <b style="color:purple;">🍴 Master Your Restaurant Operations</b>
</h3>

<h3 align="center">
  <b>💻 Web App for Customers & Admin Management</b>
</h3>

<p align="center">
  <img src="https://img.shields.io/badge/Platform-Web-blue?style=for-the-badge">
  <img src="https://img.shields.io/badge/Language-PHP-orange?style=for-the-badge">
  <img src="https://img.shields.io/badge/Database-MySQL-blue?style=for-the-badge">
  <img src="https://img.shields.io/badge/Status-Completed-success?style=for-the-badge">
</p>

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%">

<!-- Overview / Abstract Banner -->
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%93%9D%20DineMaster%20Overview%20%F0%9F%8D%BC&fontSize=32&width=1200&height=130&color=0:36BCF7,100:0f2027" width="100%">

**DineMaster – Restaurant Management System** is a professional web-based platform designed to **streamline restaurant operations** for both customers and administrators.  
It supports menu/product management, reservations, event handling, staff management, customer reviews, and dashboard analytics.  

The system centralizes restaurant operations, enhances efficiency, and ensures a **secure and user-friendly experience**.  

**Keywords:** Restaurant Management, Web Application, PHP, MySQL, Admin Dashboard, Reservations, CRUD Operations, Event Management, Staff Management.  

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%">


<!-- Introduction Banner -->
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%8D%BC%20DineMaster%20Introduction%20%F0%9F%9A%80&fontSize=32&width=1200&height=130&color=0:FF416C,100:FF4B2B" width="100%">

Modern restaurants face challenges in managing orders, reservations, events, staff, and reviews efficiently.  
**DineMaster** addresses these by providing a **unified platform**:  

- Customers can **browse menu items, make reservations, and submit reviews**.  
- Administrators can **manage products, staff, events, bookings, and monitor metrics** through a secure dashboard.  

Built with **PHP, MySQL, HTML/CSS, and JavaScript**, DineMaster ensures a responsive, interactive, and secure experience while centralizing restaurant management for operational efficiency.  

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%">  

<!-- Features Banner -->
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%9A%80%20Features&fontSize=32&width=1200&height=130&color=0:00F260,100:0575E6" width="100%">

- 👥 Admin & Customer login / registration with session control  
- 🔑 Password recovery & reset  
- 📝 Customer profile management  
- 📊 Dashboard overview (orders, reservations, events, reviews)  
- 🍽️ CRUD for Products / Menu Items  
- 📅 Reservation management  
- 🎉 Events creation & booked events handling  
- 🧑‍🍳 Staff management  
- ⭐ Reviews & Ratings  
- 🏷️ Category management  
- 🌐 Responsive front end with CSS & JS  
- 🔒 Session-based authorization  

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%">  

<!-- Getting Started Banner -->
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%9B%BA%20Getting%20Started&fontSize=32&width=1200&height=130&color=0:FF416C,100:FF4B2B" width="100%">

### Prerequisites
- 💻 Web server with PHP support (Apache, Nginx)  
- 🐘 PHP 7.x / 8.x  
- 🗄️ MySQL 
- 🌐 Modern browser  

### Installation
1. Clone the repo:

```bash
git clone https://github.com/Gaurab1809/Restaurant-Management-System-RMS-.git
cd Restaurant-Management-System-RMS-
```
2. Copy project folder into your server root (htdocs, www, etc.)
3. Create a new database: restaurant_db
4. Import tables:
```bash
mysql -u username -p restaurant_db < db_setup.sql
```
5. Update database connection in db_config.php:
```bash
host: your_db_host
username: your_db_user
password: your_db_password
database: restaurant_db
```
6. Ensure session folder is writable & CSS styling is intact (**style.css, styles_reg_for.css**)
Usage
7. Open browser: **http://localhost/RMS/**
8. Customer: **register/login, view menu/events, make reservations, submit reviews**
9. Admin: **login, manage staff/products/categories/events/reservations/reviews, view dashboard metrics**

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%"> 


<!-- Project Structure Banner --> 
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%93%9A%20Project%20Structure&fontSize=32&width=1200&height=130&color=0:36BCF7,100:0f2027" width="100%">

```bash
DineMaster/
├── admin_login.php
├── admin_registration.php
├── customer_register.php
├── customer_login.php
├── customer_forgot_password.php
├── customer_profile.php
├── password_recovery_confirmation.php
├── index.php
├── session.php
├── db_config.php
├── style.css
├── styles_reg_for.css
├── products/        # CRUD pages for products
├── reservations/    # Reservation pages
├── events/          # Event management
├── staff/           # Staff management
├── reviews/         # Customer reviews
├── categories/      # Menu/event categories
└── Dashboard/       # Dashboard pages
```
<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%"> 


<!-- Database Banner --> 
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%97%84%20Database&fontSize=32&width=1200&height=130&color=0:00F260,100:0575E6" width="100%">

<!-- Database Schema -->
### 🗄️ Suggested Tables

| Table          | Key Columns                                              |
|----------------|----------------------------------------------------------|
| `users`        | user_id, name, email, password_hash, role               |
| `products`     | product_id, name, category_id, price, description, image |
| `categories`   | category_id, category_name                               |
| `reservations` | reservation_id, user_id, product_id, date, time        |
| `events`       | event_id, event_name, date, location, details          |
| `booked_events`| booking_id, event_id, user_id, booking_date            |
| `staff`        | staff_id, name, role, contact_info                     |
| `reviews`      | review_id, user_id, product_id/event_id, rating, comment, timestamp |


<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%"> 


<!-- Security Banner -->
<img src="https://capsule-render.vercel.app/api?type=waving&text=Security%20and%20Authentication&fontSize=32&width=1200&height=130&color=0:FF416C,100:FF4B2B" width="100%">


🔐 Passwords hashed with password_hash()   
🛡️ Session-based login control   
⚠️ Input validation & sanitization (prevent SQLi/XSS)   
🔒 HTTPS recommended for production   

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%"> 


<!-- Future Enhancements Banner --> 
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%94%AE%20Future%20Enhancements&fontSize=32&width=1200&height=130&color=0:00F260,100:0575E6" width="100%">

📸 Image uploads for products/events  
👥 Role-based access control (admin, manager, customer)  
✉️ Email notifications (reservations, password resets)  
🛒 Cart / Order processing    
📊 Analytics & reporting   
📱 Mobile responsive design / dedicated frontend   
🏗️ MVC framework (Laravel/Symfony) for better structure   
<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%"> 

<!-- Author Banner --> 
<img src="https://capsule-render.vercel.app/api?type=waving&text=%F0%9F%91%A8%E2%80%8D%F0%9F%92%BB%20Author&fontSize=32&width=1200&height=130&color=0:6A82FB,100:FC5C7D" width="100%">

### A. K. M. Masudur Rahman (Gaurab)  
🎓 Department of Computer Science and Engineering (CSE)   
🏫 Bangladesh Army University of Science and Technology (BAUST), Saidpur   
📧 Email: your.email@example.com   

<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%"> 


<!-- Support Banner --> 
<img src="https://capsule-render.vercel.app/api?type=waving&text=%E2%AD%90%20Support&fontSize=32&width=1200&height=130&color=0:FF416C,100:FF4B2B" width="100%">

If you like this project, consider giving it a ⭐ on GitHub!
<img src="https://user-images.githubusercontent.com/73097560/115834477-dbab4500-a447-11eb-908a-139a6edaec5c.gif" width="100%"> 
