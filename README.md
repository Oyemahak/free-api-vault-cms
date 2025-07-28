# Free API Vault CMS

A categorized CMS to manage, explore, and display free public APIs.

Built for **Assignment 2 – Web Development Project (HTTP-5225-0NA)** at **Humber College**, this PHP + MySQL-based project allows authenticated admins to manage APIs and categories, while users can browse, filter, and search APIs in a responsive frontend.

---

## ✅ Assignment Requirements

| Requirement                                          | Status     |
|------------------------------------------------------|------------|
| Admin Login System                                   | ✅ Completed |
| API CRUD (Create, Read, Update, Delete)              | ✅ Completed |
| Category CRUD                                         | ✅ Completed |
| Foreign Key Relationship between API & Category      | ✅ Completed |
| Responsive Frontend with Filters                     | ✅ Completed |
| Search Functionality                                 | ✅ Completed |
| Display API Details (with sample endpoint)           | ✅ Completed |
| Organized Codebase (Admin & Frontend Separation)     | ✅ Completed |
| Use of PDO for DB Security                           | ✅ Completed |
| Readable, Styled UI (Admin + Frontend)               | ✅ Completed |
| Hosting and Deployment                               | ✅ Completed |
| Final GitHub Commit + Clean `README.md`              | ✅ Completed |


## Features Overview

### Admin Portal
- Secure session-based login
- Dashboard with total APIs and categories
- CRUD functionality:
  - **APIs**: Title, Category, Notes, Sample Endpoint
  - **Categories**: Title only

### Public Frontend
- List of all APIs
- Filter by category
- Keyword search
- Click to view API details
- Responsive mobile-friendly layout


## Setup Instructions

**Clone this repo**
   ```bash
   git clone https://github.com/Oyemahak/free-api-vault-cms.git
   cd free-api-vault-cms
   ```

**Import the Database**
	- Open phpMyAdmin
	- Create a new DB: free-api-vault
	- Import data.sql


**Run Locally**
- Start your local server (e.g., XAMPP or MAMP)
- [Admin Panel](http://localhost/free-api-vault-cms/admin/login.php)
- [Public Frontend](http://localhost/free-api-vault-cms/frontend/)

## Admin Login (Default)**

- Username: admin
- Password: admin123

(Hardcoded for assignment – no DB-based auth used yet)

## 🚀 Live Demo

> 🔗 **Website FrontEnd:** [https://pallavikandikanti.infinityfreeapp.com/](https://pallavikandikanti.infinityfreeapp.com/)
> 🔗 **Website Admin Panel:** [https://pallavikandikanti.infinityfreeapp.com/admin/apis/index.php](https://pallavikandikanti.infinityfreeapp.com/admin/apis/index.php)

This project is hosted and live on **InfinityFree**, a free hosting provider that supports PHP and static content.

---

## 🛠️ Hosting Details

This project was deployed using the following method:

### ✅ Hosting Platform: [InfinityFree](https://infinityfree.net)
- Files uploaded via **FTP**
- Uses **PHP + static files (HTML/CSS/JS)**
- Deployed in the `htdocs` directory of the InfinityFree file manager

## Author

- Developed by Mahak Patel, Rutul Mamani, Pallavi Kandikanti, Krunal, Vihar

## License

- Educational project for Humber College
Feel free to fork or reference this for learning purposes.
