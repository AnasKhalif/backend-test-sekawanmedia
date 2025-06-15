# Vehicle Reservation System

Backend application for a nickel mining company's vehicle ordering system, which includes tiered approval, reporting and vehicle monitoring features.

## Technologies Used

-   **Laravel** v12.x - Framework PHP
-   **Tailwind CSS** - Styling frontend
-   **MySQL** - Database
-   **PHP** v8.2+
-   **Laravel Excel** - export laporan Excel
-   **Laratrust** - Manajemen Role dan Permission

## Prerequisites

Before you begin, ensure you have met the following requirements:

-   PHP (v8.3)
-   Composer (v2.8.6)
-   MySQL Database
-   Node.js (v22.14.0)
-   npm (v10.9.2)

## Setup and Installation

1. Clone the repository:

```bash
git clone https://github.com/AnasKhalif/backend-test-sekawanmedia.git
cd backend-test-sekawanmedia
```

2. Install dependencies:

```bash
composer install
```

```bash
npm install
```

3. Set up your environment variables:

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

4. Set up the database:

```bash
php artisan migrate --seed
```

5. Run the development server:

```bash
php artisan serve
```

6. Run Vite dev server (for Tailwind CSS + JS changes):

```bash
npm run dev
```

7. Start the development server:

```bash
The server should now be running on `http://127.0.0.1:8000`.
```

## Demo Login

Use the following accounts to try the app:

| Role       | Email               | Password |
| ---------- | ------------------- | -------- |
| Admin      | admin@app.test      | password |
| Supervisor | supervisor@app.test | password |
| Manager    | manager@app.test    | password |

---

## How to Use the Application

### 1. Login

Login to the application using one of the provided accounts above according to your role:

-   **Admin**: Create vehicle reservations
-   **Supervisor**: Approve reservations (Level 1)
-   **Manager**: Approve reservations (Level 2)

After logging in, you will be directed to the **Dashboard**, which displays vehicle usage summaries and charts.

---

### 2. Sidebar Navigation

The sidebar includes the following menu:

-   **Dashboard**: View vehicle usage analytics
-   **Reservations**: Manage vehicle bookings (Admin only)
-   **Approvals**: Approval panel (Supervisor and Manager only)
-   **Reports**: Export reservation reports
-   **Logout**: Sign out of the application

---

### 3. Reservations Page (Admin Role)

On this page, Admins can:

-   View all vehicle reservation records
-   Monitor approval statuses from Supervisors and Managers
-   Create a new reservation by clicking **"Add Reservation"**
-   Edit or delete existing reservations

**Displayed information includes:**

-   Reservation ID
-   Vehicle
-   Driver
-   Date
-   Purpose
-   Supervisor Status
-   Manager Status
-   Actions (Edit/Delete)

**Steps to Create a Reservation:**

1. Click the **"Add Reservation"** button.
2. Fill out the reservation form with:
    - Selected vehicle
    - Assigned driver
    - Date and purpose
    - Assigned supervisor and manager for approval
3. Once submitted, the reservation will appear with status **Pending**.

---

### 4. Approvals Page (Supervisor / Manager Roles)

If you're logged in as a **Supervisor** or **Manager**, you'll see the **Approvals** menu in the sidebar.

On the **Approval Panel**, you can:

-   View pending reservation requests assigned to your role
-   Approve requests by clicking the **Approve** button, then **Submit**
-   See the current status: `Pending` or `Approved`

If your role has already approved a request, the action column will show **"Already processed"**.

---

### 5. Reports Page

On the **Reports** page:

-   View filtered reservation history by date
-   Click **Export to Excel** to download the report as an `.xlsx` file

---

### 6. Logout

To log out of the application:

-   Click **Logout** at the bottom of the sidebar

---
