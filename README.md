# AKSAMEDIA MSIB TEST

## Requirements

-   PHP 8.2
-   Composer
-   Laravel 11
-   MySQL

## Installation

1. Clone the repository:

    ```sh
    git clone https://github.com/Isallkun/aksamedia_msib
    cd aksamedia_msib
    ```

2. Install dependencies:

    ```sh
    composer install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:

    ```sh
    cp .env.example .env
    ```

4. Generate the application key:

    ```sh
    php artisan key:generate
    ```

5. Run the database migrations:

    ```sh
    php artisan migrate
    ```

6. (Optional) Seed the database with sample data:
    ```sh
    php artisan db:seed
    ```

## Usage

### Authentication

-   **Login**

    ```http
    POST /api/login
    ```

    Request Body:

    ```json
    {
        "username": "your_username",
        "password": "your_password"
    }
    ```

    Response:

    ```json
    {
        "status": "success",
        "message": "Login successful",
        "data": {
            "token": "your_token",
            "admin": {
                "id": 1,
                "name": "Admin Name",
                "username": "admin",
                "phone": "1234567890",
                "email": "admin@example.com"
            }
        }
    }
    ```

-   **Logout**
    ```http
    POST /api/logout
    ```
    Headers:
    ```http
    Authorization: Bearer your_token
    ```
    Response:
    ```json
    {
        "status": "success",
        "message": "Logout successful"
    }
    ```

### Divisions

-   **Get All Divisions**
    ```http
    GET /api/divisions
    ```
    Headers:
    ```http
    Authorization: Bearer your_token
    ```
    Response:
    ```json
    {
        "status": "success",
        "message": "Data retrieved successfully",
        "data": {
            "divisions": [
                {
                    "id": 1,
                    "name": "Division Name"
                }
            ]
        },
        "pagination": {
            "current_page": 1,
            "last_page": 1,
            "per_page": 10,
            "total": 1
        }
    }
    ```

### Employees

-   **Get All Employees**

    ```http
    GET /api/employees
    ```

    Headers:

    ```http
    Authorization: Bearer your_token
    ```

    Response:

    ```json
    {
        "status": "success",
        "message": "Data retrieved successfully",
        "data": {
            "employees": [
                {
                    "id": "1",
                    "name": "Employee Name",
                    "phone": "1234567890",
                    "division_id": "1",
                    "position": "Developer"
                }
            ]
        },
        "pagination": {
            "current_page": 1,
            "last_page": 1,
            "per_page": 10,
            "total": 1
        }
    }
    ```

-   **Create Employee**

    ```http
    POST /api/employees
    ```

    Headers:

    ```http
    Authorization: Bearer your_token
    ```

    Request Body:

    ```json
    {
        "image": "base64_encoded_image",
        "name": "Employee Name",
        "phone": "1234567890",
        "division_id": "1",
        "position": "Developer"
    }
    ```

    Response:

    ```json
    {
        "status": "success",
        "message": "Employee created successfully",
        "data": {
            "id": "1",
            "name": "Employee Name",
            "phone": "1234567890",
            "division_id": "1",
            "position": "Developer",
            "image": "path_to_image"
        }
    }
    ```

-   **Get Employee by ID**

    ```http
    GET /api/employees/{id}
    ```

    Headers:

    ```http
    Authorization: Bearer your_token
    ```

    Response:

    ```json
    {
        "status": "success",
        "message": "Employee retrieved successfully",
        "data": {
            "id": "1",
            "name": "Employee Name",
            "phone": "1234567890",
            "division_id": "1",
            "position": "Developer",
            "image": "path_to_image"
        }
    }
    ```

-   **Update Employee**

    ```http
    POST /api/employees/{id}
    ```

    Headers:

    ```http
    Authorization: Bearer your_token
    ```

    Request Body:

    ```json
    {
        "image": "base64_encoded_image",
        "name": "Updated Employee Name",
        "phone": "0987654321",
        "division_id": "2",
        "position": "Senior Developer"
    }
    ```

    Response:

    ```json
    {
        "status": "success",
        "message": "Employee updated successfully",
        "data": {
            "id": "1",
            "name": "Updated Employee Name",
            "phone": "0987654321",
            "division_id": "2",
            "position": "Senior Developer",
            "image": "path_to_new_image"
        }
    }
    ```

-   **Delete Employee**
    ```http
    DELETE /api/employees/{id}
    ```
    Headers:
    ```http
    Authorization: Bearer your_token
    ```
    Response:
    ```json
    {
        "status": "success",
        "message": "Employee deleted successfully"
    }
    ```

## License

This project is licensed under the MIT License.
