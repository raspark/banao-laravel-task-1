# Laravel Account Management Application

This Laravel application, built on version 10, allows users to create and manage accounts. It includes custom login and registration functionality using Ajax for an enhanced user experience. Additionally, users can view, edit their account information, and change passwords.

## Features

1. **Custom Login and Registration:**
   - Implemented custom login and registration pages for an improved user interface.
   - Utilized Ajax for seamless user experience during authentication.

3. **Social Login:**
   - Implemented social login functionality for quick access. Users can now log in using their Google and GitHub accounts, streamlining the login process and providing more options for our users.

2. **User Profile Management:**
   - Created a user profile section for users to view and edit their account information.
   - Implemented functionality to change passwords securely.

3. **Forgot Password Functionality:**
   - Created a 'Forget Password' functionality for our system. It verifies the user's email, sends a secure link containing a Laravel signature for added security, and ensures the link expires in just 10 minutes.
   - Implemented functionality to reset passwords securely.

4. **Planned Features (To Be Implemented):**
   - **Email Verification:**
     - Upcoming feature to add email verification during user registration.
     - Ensures valid user emails and enhances security.

## Getting Started

Follow these steps to set up and run the Laravel application on your local machine.

### Prerequisites

- PHP (>= 7.4)
- Composer
- MySQL

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/your-laravel-project.git
    ```

2. Navigate to the project directory:

    ```bash
    cd your-laravel-project
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

5. Configure your database connection details in the `.env` file.

6. Generate application key:

    ```bash
    php artisan key:generate
    ```

7. Run database migrations:

    ```bash
    php artisan migrate
    ```

### Quick Database Setup
Provided database sql inside sqls folder in the root

### Sample User
## Usermail

    ```bash
    john@gmail.com
    ```

## Password

    ```bash
    12345678
    ```

### Usage

1. Serve the application:

    ```bash
    php artisan serve
    ```

2. Open your browser and visit [http://127.0.0.1:8000](http://127.0.0.1:8000).

3. Register a new account or login with existing credentials.

4. Navigate to the account page to view and edit your user information.

### Contributing


### License


## Acknowledgments

- Laravel Documentation: https://laravel.com/docs
