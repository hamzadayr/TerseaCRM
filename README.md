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


4. **SMTP Configuration**: Open the `.env` file in the project root directory and configure the SMTP settings. Replace the placeholders with your email provider's SMTP details. For example:

    ```ini
    MAIL_MAILER=smtp
    MAIL_HOST=your-smtp-host.com
    MAIL_PORT=587
    MAIL_USERNAME=your-email@example.com
    MAIL_PASSWORD=your-email-password
    MAIL_ENCRYPTION=tls
    ```

    Ensure you replace `your-smtp-host.com`, `your-email@example.com`, and `your-email-password` with your actual SMTP details.

 **Generate App Password**: If your email provider requires it, generate an "App Password" for your application. This app password is used for secure email sending. Follow your email provider's instructions to generate this password.


With the SMTP settings properly configured, your CRM can send email notifications and invitations.

5. Generate a Laravel application key: `php artisan key:generate`
6. Run migrations to create the database tables: `php artisan migrate`
7. Run seeders to populate the database with initial data: `php artisan db:seed`

This will add companies, users, employees, invitations, and more to your database for a quick start.

8. Serve the application using the artisan command: `php artisan serve`

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