# PhishingSim – Phishing Awareness & Simulation Tool

## Overview

**PhishingSim** is a cybersecurity awareness and phishing simulation platform designed to demonstrate how phishing attacks work and how user credentials can be captured through deceptive login pages.

The project helps illustrate the **mechanics of phishing campaigns**, including email targeting, credential harvesting, and attack monitoring through a centralized dashboard.

This tool is intended **strictly for educational and security awareness purposes**.

---

## Features

• Create phishing simulation campaigns
• Send phishing emails to target users
• Capture submitted credentials from simulated phishing pages
• Track user interactions and login attempts
• View captured credentials and activity logs in a dashboard
• Export captured data as CSV for analysis

---

## Tech Stack

Frontend

* HTML
* CSS
* JavaScript

Backend

* PHP (Laravel Framework)

Database

* MySQL

Tools

* Laravel Blade Templates
* CSV Export

---

## Screenshots

### Create Phishing Campaign

[![Create Campaign](screenshots/create-campaign.png)](https://github.com/riyakumbhare9-boop/PhishingSim/blob/12301707fa069c7cdea8d3013cefc6245399c45c/create_campaign.png)

This interface allows administrators to:

* Create phishing email campaigns
* Write custom phishing email content
* Add phishing landing page links
* Target multiple email addresses

---

### Captured Credentials Dashboard

[![Captured Credentials](screenshots/credentials-dashboard.png)](https://github.com/riyakumbhare9-boop/PhishingSim/blob/12301707fa069c7cdea8d3013cefc6245399c45c/captured_credentials.png)

The dashboard displays:

* Captured email/username
* Submitted password
* IP address
* Browser user agent
* Timestamp of login attempt

This helps demonstrate how attackers monitor phishing campaigns.

---



---

## How to Run the Project

1. Clone the repository

```
git clone https://github.com/riyakumbhare9-boop/PhishingSim.git
```

2. Navigate to the project folder

```
cd PhishingSim
```

3. Install dependencies

```
composer install
```

4. Configure environment file

```
cp .env.example .env
```

5. Generate application key

```
php artisan key:generate
```

6. Run migrations

```
php artisan migrate
```

7. Start the development server

```
php artisan serve
```

Open in browser:

```
http://127.0.0.1:8000
```

---

## Educational Purpose Disclaimer

This project is created **strictly for educational and cybersecurity awareness purposes only**.
It demonstrates how phishing attacks operate so that developers, students, and organizations can better understand and defend against them.

Do **not use this project for illegal or unethical activities.**

---

## Future Improvements

* Machine learning based phishing detection
* Email spoof detection
* Phishing URL analysis
* Security awareness training module
* Real-time phishing detection alerts

---

