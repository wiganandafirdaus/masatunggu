# Detailed Project Summary: Masatunggu

## Overview
Masatunggu is a web application for predicting the waiting time (masa tunggu) for job seekers after graduation, using machine learning. It combines a Laravel backend for web interface and data management with a Python script for ML predictions using a stacking model.

## Technology Stack
- **Backend Framework**: Laravel 12.0 (PHP 8.2+)
- **Frontend**: Blade templates, TailwindCSS 4.0, Vite for asset compilation
- **Database**: SQLite (switched from MySQL for simplicity)
- **ML Integration**: Python 3.11+ with pandas, joblib, scikit-learn
- **Build Tools**: Composer, npm, Vite
- **Testing**: PHPUnit, Pail for logging
- **Development**: Concurrently for running multiple processes

## Project Structure

### Root Directory
- `composer.json`: PHP dependencies (Laravel framework, Tinker)
- `package.json`: Node dependencies (Vite, Tailwind, Axios)
- `vite.config.js`: Vite configuration with Laravel plugin and Tailwind
- `.env`: Environment configuration (DB=sqlite, PYTHON_CMD=py)
- `artisan`: Laravel command-line tool
- `phpunit.xml`: Testing configuration
- `README.md`: Project documentation
- `POST_RESTART_GUIDE.md`: Detailed setup guide for Windows/Laragon environment

### App Directory
- `Http/Controllers/PrediktorController.php`: Main controller handling CRUD and ML prediction calls
- `Models/Prediktor.php`: Eloquent model for prediktors table with fillable fields and casts
- `Providers/AppServiceProvider.php`: Basic service provider

### Config Directory
- `database.php`: Database connections (default sqlite, with mysql/mysql options)
- Other standard Laravel configs (app.php, auth.php, etc.)

### Database Directory
- `database.sqlite`: SQLite database file
- `migrations/`: 
  - `2025_12_23_120732_create_prediktors_table.php`: Creates prediktors table with all predictor fields
  - `2026_01_04_224154_add_predicted_masa_tunggu_to_prediktors_table.php`: Adds prediction result column

### Public Directory
- `index.php`: Laravel entry point
- `assets/`: Compiled CSS/JS files

### Resources Directory
- `views/welcome.blade.php`: Main view with prediction form and result display
- `css/app.css`, `js/app.js`: Frontend assets (compiled by Vite)

### Routes Directory
- `web.php`: Defines GET / -> index, resource routes for prediktors

### Script Directory
- `predict.py`: Python ML prediction script
- `model.joblib`: Trained ML model (stacking ensemble)
- `feature_cols.json`: Feature column names for model
- `model_meta.json`: Model metadata (sklearn version, n_features)

### Storage Directory
- Logs, cache, compiled views

### Tests Directory
- Basic unit/feature tests

## Key Components Analysis

### Laravel Backend

#### PrediktorController
- **index()**: Fetches latest prediktor, passes to welcome view
- **store(Request $request)**: 
  - Validates 12 input fields (masa_studi, provinsi, prodi, ipk, toefl, jenis_kelamin, sskm, nilai_kp, nilai_ta, magang, masa_carikerja, jml_lamaran)
  - Creates Prediktor record in DB
  - Calls Python script via Process facade with JSON input
  - Parses JSON output, validates prediction value
  - Updates record with predicted_masa_tunggu
  - Returns success/error messages
- Uses configurable PYTHON_CMD from .env (default 'py')
- Process timeout 30s to prevent hangs
- Comprehensive logging for debugging

#### Prediktor Model
- **Fillable fields**: All 12 predictors + predicted_masa_tunggu
- **Casts**: Proper type casting (decimals, booleans, integers)
- Uses SoftDeletes trait

#### Database Schema
- **prediktors table**:
  - id (primary)
  - masa_studi (int)
  - provinsi (string)
  - prodi (string)
  - ipk (decimal 3,2)
  - toefl (int)
  - jenis_kelamin (boolean, false=male)
  - sskm (int)
  - nilai_kp (string, grade)
  - nilai_ta (string, grade)
  - magang (boolean, false=no experience)
  - masa_carikerja (string, 1=pre-grad, 2=post-grad)
  - jml_lamaran (int)
  - predicted_masa_tunggu (decimal 8,2 nullable)
  - timestamps, soft deletes

### Python ML Integration

#### predict.py Script
- **Input**: JSON from stdin with predictor data
- **Processing**:
  - Maps Laravel keys to model keys (KEY_MAP)
  - Normalizes data types (numbers, booleans, grades)
  - Handles special cases (grade aliases AB->B+, masa_carikerja 1/2)
  - Loads feature_cols.json or uses defaults
  - Creates pandas DataFrame
  - Loads model.joblib
  - Validates model has predict method
  - Makes prediction
- **Output**: JSON with ok/error and prediction value
- **Error handling**: Catches exceptions, returns error JSON

#### Model Details
- **Type**: Stacking ensemble (likely sklearn StackingRegressor/Classifier)
- **Features**: 12 features as listed in feature_cols.json
- **Training**: Presumably trained on historical job seeker data
- **Prediction**: Outputs waiting time in months (float)

### Frontend (Blade View)

#### welcome.blade.php
- **Layout**: Bootstrap 4 + custom CSS, preloader, navigation
- **Form**: 12 input fields with validation, dropdowns for categorical data
- **Display**: Card showing latest prediction or "belum ada" message
- **Assets**: Links to compiled CSS/JS via Vite

### Configuration

#### Environment (.env)
- DB_CONNECTION=sqlite (changed from mysql)
- PYTHON_CMD=py (for Windows compatibility)
- Standard Laravel settings

#### Composer Scripts
- setup: Full installation and setup
- dev: Concurrent server + queue + logs + vite
- test: Run tests with config clear

#### Vite Configuration
- Laravel plugin for asset compilation
- TailwindCSS integration
- Hot reload enabled

## End-to-End Workflow

1. **User Access**: GET / loads welcome.blade.php with latest prediction (if any)
2. **Form Submission**: POST /prediktors with form data
3. **Validation**: Server-side validation of all fields
4. **DB Save**: Create Prediktor record with input data
5. **ML Prediction**: 
   - Serialize input to JSON
   - Call Python script via Process::run
   - Python loads model, preprocesses, predicts
   - Returns prediction as JSON
6. **DB Update**: Update record with predicted_masa_tunggu
7. **Response**: Redirect back with success message
8. **Display**: Show prediction in result card

## Recent Changes and Fixes (opencode History)

1. **Process Facade Improvements**:
   - Added timeout(30) to prevent hanging
   - Changed from 'python' to configurable PYTHON_CMD='py' for Windows
   - Better error handling and logging

2. **Form Corrections**:
   - Fixed magang boolean: value="1" for Ya (has experience), "0" for Tidak

3. **Python Script Cleanup**:
   - Removed duplicated DataFrame creation code
   - Added model validation (hasattr predict)
   - Improved error handling

4. **Database Migration**:
   - Switched to SQLite for easier setup (no MySQL dependency)

5. **Output Validation**:
   - Added numeric/range checks for prediction values
   - Better error messages

6. **Environment Configuration**:
   - Added PYTHON_CMD to .env
   - Updated DB settings

## Dependencies and Requirements

### PHP/Laravel
- PHP 8.2+
- Composer packages: laravel/framework, laravel/tinker, etc.
- Extensions: PDO, SQLite

### Python
- Python 3.11+
- Libraries: pandas, joblib, scikit-learn
- Model files: model.joblib, feature_cols.json

### Node.js
- npm packages: vite, laravel-vite-plugin, tailwindcss, axios

### System
- Windows with Laragon (or equivalent PHP server)
- Git for version control

## Potential Issues and Solutions

1. **Python Not Found**: Use full path or ensure 'py' in PATH
2. **Model Loading Errors**: Check file paths, sklearn version compatibility
3. **Process Timeouts**: Increase timeout if model is slow
4. **Data Type Mismatches**: Ensure form inputs match DB schema
5. **Encoding Issues**: Use UTF-8 for all files
6. **Permissions**: Ensure write access to database.sqlite

## Development and Testing

- **Local Development**: composer run dev for full stack
- **Testing**: phpunit for unit tests
- **Debugging**: Check storage/logs/laravel.log, use dd() or Log facade
- **Model Testing**: Manual JSON input to predict.py script

## Conclusion

Masatunggu is a well-structured ML-integrated Laravel application with proper separation of concerns. The Laravel backend handles web interface and data persistence, while Python provides the ML prediction capability. Recent fixes have improved stability and Windows compatibility. The system successfully predicts job waiting times using a trained stacking model, with results displayed in a user-friendly interface.