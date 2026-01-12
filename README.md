# Budget Web Assistant - OOP

![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue)
![License](https://img.shields.io/badge/license-MIT-green)

A modern web application for personal budget management with built-in AI assistant. Take full control of your finances with advanced expense analysis and intelligent recommendations.

## 📋 Table of Contents

- [Features](#-features)
- [Technologies](#-technologies)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [API Endpoints](#-api-endpoints)
- [Security](#-security)
- [Author](#-author)

## ✨ Features

### Financial Management
- 📊 **Income tracking** - record all revenue sources
- 💰 **Expense tracking** - detailed transaction logging
- 📈 **Financial balance** - overview across different periods:
  - Current month
  - Previous month
  - Current year
  - Custom period
- 📊 **Data visualization** - pie charts for income and expenses

### Personalization
- 🏷️ **Custom categories** - add, edit and delete income/expense categories
- 💳 **Payment methods** - manage your payment forms
- 🎯 **Expense limits** - set monthly limits for categories
- ⚠️ **Limit monitoring** - automatic warnings about exceeding limits

### AI Assistant
- 🤖 **Financial advisor** - budget analysis powered by Gemini AI
- 💡 **Personalized advice** - 3 specific tips based on your data
- 📉 **Trend analysis** - identify areas for optimization

### Security
- 🔐 **Authentication system** - secure registration and login
- 🛡️ **CSRF Protection** - protection against CSRF attacks
- 🔒 **Password hashing** - bcrypt with cost parameter=12
- 👤 **Data isolation** - each user sees only their own transactions

## 🛠 Technologies

### Backend
- **PHP 8.2+** - modern features and strict types
- **Custom MVC Framework** - custom framework architecture
- **PDO** - secure database connections
- **Composer** - dependency management

### Frontend
- **Bootstrap 5.3.3** - responsive UI
- **Chart.js 2.9.4** - data visualization
- **Vanilla JavaScript** - interactivity

### Database
- **MySQL/MariaDB** - relational database
- **Normalization** - structure with foreign keys and cascade

### AI Integration
- **Gemini API** - Google Generative AI
- **gemini-api-php/client** - official PHP client

### Additional
- **vlucas/phpdotenv** - environment variable management
- **Symfony HTTP Client** - API communication

## 📦 Requirements

- PHP >= 8.2
- Composer
- MySQL/MariaDB >= 5.7
- Web Server (Apache/Nginx)
- PHP Extensions:
  - PDO
  - PDO_MySQL
  - mbstring
  - openssl

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/BudgetWebAssistant-OOP.git
cd BudgetWebAssistant-OOP
```

### 2. Install dependencies

```bash
composer install
```

### 3. Database configuration

Create database:

```sql
CREATE DATABASE budgetassistant CHARACTER SET utf8 COLLATE utf8_polish_ci;
```

Import structure:

```bash
mysql -u your_user -p budgetassistant < budgetassistant.sql
```

### 4. Environment configuration

Copy `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Edit `.env` and fill in the data:

```env
APP_ENV=production
DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=budgetassistant
DB_USER=your_username
DB_PASSWORD=your_password
GEMINI_API_KEY=your_gemini_api_key
```

### 5. Server configuration

#### Apache (.htaccess already configured)

Make sure mod_rewrite is enabled:

```bash
sudo a2enmod rewrite
sudo service apache2 restart
```

#### Nginx

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/BudgetWebAssistant-OOP/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 6. Launch

The application should be accessible at:
```
http://localhost/BudgetWebAssistant-OOP/public
```

Or using PHP built-in server (development only):
```bash
php -S localhost:8000 -t public
```

## ⚙️ Configuration

### Getting Gemini API Key

1. Go to [Google AI Studio](https://makersuite.google.com/app/apikey)
2. Sign in with your Google account
3. Click "Create API Key"
4. Copy the key and add it to `.env`

### Session configuration

In `SessionMiddleware.php` you can customize session parameters:

```php
session_set_cookie_params([
    'secure' => $_ENV['APP_ENV'] === 'production',
    'httponly' => true,
    'samesite' => 'lax'
]);
```

## 📖 Usage

### Registration and Login

1. Open the application
2. Click "Registration"
3. Fill in the form (name, email, password)
4. After registration, log in

### Adding Transactions

#### Income
1. Click "Add income"
2. Enter amount, date and category
3. Optionally add a comment
4. Click "Save"

#### Expenses
1. Click "Add expense"
2. Enter amount, date, category and payment method
3. System automatically checks limits
4. Click "Save"

### Viewing Balance

1. Click "View balance"
2. Select period from dropdown menu
3. View tables and charts
4. Click "Get advice from e-advisor" for AI analysis

### Settings

#### Categories
- **Add** - create new category
- **Edit** - change existing name
- **Delete** - remove unnecessary category

#### Expense Limits
1. Select category
2. Enter monthly limit
3. System will monitor expenses

#### User Account
- Change name, email or password
- Delete account (requires password confirmation)

## 📁 Project Structure

```
BudgetWebAssistant-OOP/
├── public/                 # Publicly accessible files
│   ├── assets/            # CSS, images, JavaScript
│   ├── index.php          # Entry point
│   └── .htaccess          # Apache rewrite rules
├── src/
│   ├── App/               # Application logic
│   │   ├── Config/        # Configuration (routes, container, paths)
│   │   ├── Controllers/   # MVC Controllers
│   │   ├── Middleware/    # Middleware (auth, CSRF, validation)
│   │   ├── Services/      # Business logic
│   │   ├── Exceptions/    # Custom exceptions
│   │   └── views/         # PHP Views
│   └── Framework/         # Custom framework
│       ├── App.php        # Main application class
│       ├── Router.php     # Routing system
│       ├── Database.php   # PDO wrapper
│       ├── Container.php  # Dependency injection
│       ├── Validator.php  # Data validation
│       └── Rules/         # Validation rules
├── storage/
│   └── uploads/           # Uploaded files (future feature)
├── vendor/                # Composer dependencies
├── .env.example           # Example configuration
├── composer.json          # Composer configuration
├── budgetassistant.sql    # Database schema
└── README.md
```

## 🔌 API Endpoints

### Get Limits

```http
GET /api/expense-limits
```

Returns all user expense limits:

```json
{
  "success": true,
  "data": [
    {
      "user_id": 1,
      "category_id": 5,
      "category_name": "Food",
      "limit_amount": 1500.00
    }
  ]
}
```

### Category Limit Details

```http
GET /api/expense-limits/{id}
```

Parameters:
- `id` - Expense category ID

Returns:

```json
{
  "expense_limit": 1500.00,
  "limit_used": 850.50
}
```

### AI Financial Advice

```http
GET /api/advice/{query}
```

Query string parameters:
- `incomes` - JSON with incomes
- `expenses` - JSON with expenses
- `timePeriod` - analysis period

Returns:

```json
{
  "success": true,
  "message": "<p>AI advice in HTML...</p>"
}
```

## 🔒 Security

### Implemented Security Measures

1. **CSRF Protection**
   - Token generated for each session
   - Validation for every POST/DELETE/PATCH

2. **SQL Injection Prevention**
   - Prepared statements (PDO)
   - No raw SQL queries

3. **XSS Protection**
   - `e()` function escapes output
   - Server-side input validation

4. **Password Security**
   - Bcrypt hashing (cost=12)
   - Password strength verification

5. **Session Security**
   - HTTPOnly cookies
   - SameSite=Lax
   - Secure flag in production

6. **Access Control**
   - AuthRequired middleware
   - user_id validation in queries
   - Data isolation between users

### Best Practices

- Don't commit `.env` file
- Use HTTPS in production
- Regularly update dependencies
- Database backups
- Monitor error logs

## 🐛 Troubleshooting

### Database Connection Error

```
Unable to connect to database
```

**Solution:**
- Check credentials in `.env`
- Make sure MySQL is running
- Verify database exists

### Routing Errors

```
404 - Page not found
```

**Solution:**
- Check if mod_rewrite is enabled
- Verify `.htaccess` in `public/` folder
- Check VirtualHost configuration

### Gemini API Errors

```
API error: Invalid API key
```

**Solution:**
- Check key in `.env`
- Make sure API key is active
- Check API quota limits

## 🎯 Future Extensions

- [ ] Import/export data (CSV, Excel)
- [ ] Recurring transactions
- [ ] Multi-currency support
- [ ] Mobile app (React Native)
- [ ] Advanced PDF reports
- [ ] Bank integration (Open Banking)
- [ ] Shared budgets (family)
- [ ] Notification system
- [ ] Dark mode

## 📄 License

Project created as a portfolio piece. You can use the code for learning and personal projects.

## 👨‍💻 Author

**Damian Molter (Luis Ramirez Jr.)**

First original application created in MVC architecture with custom framework.

---

## 📞 Support

If you have questions or suggestions:

1. Open an Issue on GitHub
2. Send an email (if available)
3. Check code documentation

---

**Built with passion in 2024/2025** ❤️

---

## 🙏 Acknowledgments

- Bootstrap team for great CSS framework
- Chart.js for simple charts library
- Google for Gemini API
- PHP-FIG for PSR standards
- Open-source community

---

*"The surest way to success is to try, one more time."*