# Campus Venue & Event Reservation System

A web-based platform for managing the reservation and approval of venues for events within a university setting. The system is designed to simplify the process for event organizers, venue managers, and administrative staff to handle event bookings and approvals efficiently.

## Key Features

- **User Registration & Login:** Users (Event Organizers, Admins, PRO, and DVC) can register and log in.
- **Venue Availability Checking:** Users can check venue availability and request reservations.
- **Reservation Requests:** Users can submit reservation requests for available venues.
- **Approval Workflow:** Admin roles (Admin, PRO, DVC) approve reservations sequentially.
- **Payment Integration:** Users can make payments for approved reservations (integrated with Flutterwave).
- **Dashboard Overview:** Users can view ongoing, upcoming, and past events, alongside venue and reservation statistics.
- **Event Display:** Displays a calendar of events, including dates, venues, and event details.
- **Responsive Design:** Fully responsive for mobile, tablet, and desktop views.

## Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Frontend:** Tailwind CSS, Bootstrap
- **Database:** MySQL
- **Payment Gateway:** Flutterwave Integration
- **Mapping Service:** Google Maps API for venue location services

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/campus-reservation-system.git
    ```
2. Navigate to the project directory:
    ```bash
    cd campus-reservation-system
    ```
3. Install dependencies:
    ```bash
    composer install
    npm install
    ```
4. Set up environment variables:
    - Duplicate `.env.example` and rename it to `.env`
    - Update the database credentials, mail configuration, and payment gateway keys.
5. Generate application key:
    ```bash
    php artisan key:generate
    ```
6. Run migrations to create the database tables:
    ```bash
    php artisan migrate
    ```
7. Seed the database with default data (optional):
    ```bash
    php artisan db:seed
    ```

8. Run the development server:
    ```bash
    php artisan serve
    ```

## Usage

- Access the app in your browser at `http://localhost:8000`.
- Log in as an admin to manage venue reservations and event approval.
- Users can browse available venues, request reservations, and make payments for approved bookings.
