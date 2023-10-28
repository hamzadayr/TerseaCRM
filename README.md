# CRM - Company Management

## Description
This CRM (Customer Relationship Management) is a company management tool that allows you to manage companies, employees, invitations, and administrators.

## Features

### Administrator Area

- **Company Management**: Add, edit, and delete companies with detailed information and a custom logo.

- **Employee Management**

- **Invitation Management**: View all invitations and send new invitations to employees to join a company or cancel previously sent invitations.

- **Administrator Management**: Add new administrators to manage the application.

### Employee Area

- **Company Invitations**: Employees can accept or decline invitations to join a company.

- **Password Creation**: Employees can create their password after accepting an invitation.

- **View Information**: Employees can view company information, including the description and logo.

- **Information Update**: Employees can update their personal information, such as address, phone number, etc.

- **Logout**: Employees can log out of their space at any time.

- **Authentication**: Employees must authenticate with their email and password to access their space.

## Installation

1. Clone the project from GitHub: `git clone https://github.com/hamzadayr/TerseaCRM.git`
2. Navigate to the project directory:  `cd TerseaCRM`
3. Copy the `.env.example` file as `.env` and configure it with your database information: `cp .env.example .env`

4. Generate a Laravel application key: `php artisan key:generate`
5. Run migrations to create the database tables: `php artisan migrate`
6. Run seeders to populate the database with initial data: `php artisan db:seed`

This will add companies, users, employees, invitations, and more to your database for a quick start.

7. Serve the application using the artisan command: `php artisan serve`

Your application will be accessible at `http://localhost:8000`.

Ensure that you update the `.env` file with your database information before running migrations and seeders.

## Usage

To access the CRM as an administrator, use the following credentials:

- Email: hamzadayr@tersea.com
- Password: tersea2024

## Demo Video
[Insert a link to your CRM demo video here.]


## Demo Video
[Watch our CRM demo video here](https://www.canva.com/design/DAFyky-Q23Y/Sm55296U68hbKdfQxTWf-w/edit?utm_content=DAFyky-Q23Y&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton).

## Author
DAYR Hamza