# MASATUNGGU Project Summary

## Project Overview
MASATUNGGU is a Laravel-based web application designed to predict the job search waiting time for university graduates. The system collects predictor variables from users (graduates or administrators) to build a dataset for potential machine learning or statistical analysis. Currently in early development, it focuses on data collection rather than actual predictions, with a tailored approach for the Indonesian education system.

## Technologies Used
- **Framework:** Laravel 12.0 (PHP 8.2+)
- **Frontend:** Blade templating, Bootstrap 4, Vite for asset management
- **Database:** MySQL (via Eloquent ORM)
- **Libraries:** PHPUnit for testing, Faker for data seeding, various JS/CSS assets (Chart.js, DataTables, CKEditor)
- **Development:** Composer, npm, Laravel Sail for Docker

## Key Components

### Models
- **User:** Standard Laravel auth model with soft deletes.
- **Prediktor:** Core model for predictor data. Key fields:
  - `masa_studi` (int): Study duration in months
  - `provinsi` (string): Province
  - `prodi` (string): Study program (e.g., "Teknik Informatika")
  - `ipk` (decimal): GPA (0.00-4.00)
  - `toefl` (int): TOEFL score
  - `jenis_kelamin` (bool): Gender
  - `sskm` (int): Standardized test score
  - `nilai_kp` (string): Internship grade
  - `nilai_ta` (string): Thesis grade
  - `magang` (bool): Internship experience
  - `masa_carikerja` (string): Job search duration
  - `jml_lamaran` (int): Number of applications

### Controllers
- **PrediktorController:** Handles predictor CRUD. Currently implements `store` for form data validation and record creation. Other methods are stubs.

### Views
- **welcome.blade.php:** Main dashboard with a comprehensive form for data input, using Bootstrap UI with validation feedback.

## Database Structure
- **users:** Standard table for authentication.
- **prediktors:** Custom table for predictor data (via migration `2025_12_23_120732_create_prediktors_table.php`).
- Standard Laravel tables: cache, jobs, migrations.

## Main Features
- Data collection form with validation.
- Basic CRUD operations (create only fully implemented).
- Responsive admin-style UI with navigation and notifications.
- Session-based success/error messages.

## Limitations & Future Plans
- Incomplete CRUD (no list/edit/delete).
- No user authentication or multi-user support.
- No prediction logic or analytics.
- Potential expansions: Integrate ML for predictions, add auth, enable data visualization with existing assets (Chart.js, DataTables).

This project lays a foundation for a data-driven prediction tool in education/employment, ready for feature enhancements.