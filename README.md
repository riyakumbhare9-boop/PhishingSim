
# PhishingSim

PhishingSim is a Laravel-based phishing simulation platform for security awareness training and research. It allows you to create, manage, and track phishing campaigns, send simulated phishing emails, and monitor user interactions.


## Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL 

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
3. Run migrations:
	```
	php artisan migrate
	```
4. Start the development server:
	```
	php artisan serve
	```

## Features

- Create, edit, and delete phishing campaigns
- Add target emails for each campaign
- Send simulated phishing emails to targets
- Track clicks and credential submissions (logs with IP and user agent)
- Dashboard with campaign statistics and analytics
- Export logs and campaign reports as CSV
- Admin/user roles and permissions
- Admin panel for user management and settings

## Usage

1. Register and log in.
2. Create a campaign and add target emails.
3. Click "Send Emails" on the campaign page to send simulated phishing emails.
4. View logs for captured credentials and clicks.
5. Use the admin panel for user management and settings.

## Security Notice
**This project is for educational and authorized security testing only. Do not use for real phishing or illegal activity.**

