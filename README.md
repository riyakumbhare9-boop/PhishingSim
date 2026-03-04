
# PhishingSim

PhishingSim is a Laravel-based phishing simulation platform for security awareness training and research. It allows you to create, manage, and track phishing campaigns, send simulated phishing emails, and monitor user interactions.

## Features

- Create, edit, and delete phishing campaigns
- Add target emails (one per line) for each campaign
- Send simulated phishing emails to targets
- Track clicks and credential submissions (logs with IP and user agent)
- Dashboard with campaign statistics and analytics
- Export logs and campaign reports as CSV
- Admin/user roles and permissions
- Admin panel for user management and settings

## Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation
1. Clone the repository:
	```
	git clone https://github.com/riyakumbhare9-boop/PhishingSim.git
	cd PhishingSim
	```
2. Install dependencies:
	```
	composer install
	npm install
	```
3. Copy `.env.example` to `.env` and set your database and mail settings.
4. Run migrations:
	```
	php artisan migrate
	```
5. Start the development server:
	```
	php artisan serve
	```

### Email Setup
Configure your mail settings in `.env` (Mailtrap is recommended for testing):
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=your@email.com
MAIL_FROM_NAME="PhishingSim"
```

## Usage

1. Register and log in.
2. Create a campaign and add target emails.
3. Click "Send Emails" on the campaign page to send simulated phishing emails.
4. View logs for captured credentials and clicks.
5. Use the admin panel for user management and settings.

## Security Notice
**This project is for educational and authorized security testing only. Do not use for real phishing or illegal activity.**

## License
MIT

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
