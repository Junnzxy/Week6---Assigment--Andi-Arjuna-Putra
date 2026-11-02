# Assignment Week 6 — PHP MVC Layouting & Partials

A PHP web application implementing the **MVC architectural pattern** with a proper **Layouts & Partials** structure, styled with **Tailwind CSS** using Vite as the asset bundler.

---

## 🌟 Features

1. **Employee Management** — Add, View, Delete employees (Nama, Jabatan, Usia)
2. **Office Management** — Add, View, Delete offices (Nama Kantor, Alamat, Kota, Telepon)
3. **Office-Employees Relationship** — Assign employees to offices, view and delete relations

---

## 🏗️ Layouts & Partials Structure

```
Assignment Week 6 - Layouting/
├── index.php                           # Front Controller & Router
├── package.json                        # Node.js / Vite dependencies
├── vite.config.js                      # Vite + Tailwind CSS config
├── app/
│   ├── Controllers/
│   │   ├── EmployeeController.php
│   │   ├── OfficeController.php
│   │   └── OfficeEmployeeController.php
│   ├── Models/
│   │   ├── Employee.php
│   │   ├── Office.php
│   │   └── OfficeEmployee.php
│   └── Database/
│       └── Storage.php
├── resources/
│   ├── css/app.css                     # Tailwind CSS entry point
│   └── js/app.js                       # JavaScript entry point
├── views/
│   ├── layouts/
│   │   ├── app.php                     # Main layout (head, navbar include)
│   │   └── app_end.php                 # Closing layout (footer include, scripts)
│   ├── partials/
│   │   ├── navbar.php                  # Navigation bar partial
│   │   └── footer.php                  # Footer partial
│   ├── employee/
│   │   └── index.php
│   ├── office/
│   │   └── index.php
│   └── office_employee/
│       └── index.php
├── public/
│   └── css/                            # Compiled CSS (from Vite build)
└── data/
    └── storage.json                    # Auto-generated persistent storage
```

---

## 🚀 How to Run

### PHP Development Server

```bash
cd "Assignment Week 6 - Layouting"
php -S localhost:8000
```

Open browser: `http://localhost:8000`

### Frontend (Tailwind CSS + Vite)

```bash
# Install dependencies
npm install

# Development (watch mode)
npm run dev

# Build for production
npm run build
```

> **Note:** The app uses Tailwind CSS Play CDN by default, so it works immediately with just PHP. Run Vite only when needed for production builds.

---

## 🛠️ Tech Stack

- **Backend**: PHP 8.x (Native MVC, no framework)
- **Frontend**: Tailwind CSS v4 + Vite v6
- **Storage**: JSON flat-file (no database needed)
- **Icons**: Lucide Icons
