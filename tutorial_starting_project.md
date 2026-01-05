# Tutorial: Starting the Masatunggu Project

This tutorial provides step-by-step instructions for restarting and running the Masatunggu project after shutting down your laptop. Follow these steps in order to get the Laravel backend with Python ML integration up and running.

## Prerequisites
- Windows operating system
- Laragon installed (for PHP/Laravel development environment)
- Internet connection for any missing dependencies
- Project files located at `C:\laragon\www\masatunggu`

## Step 1: Pre-Flight Checks
Before starting, verify your environment:

1. **Start Laragon**: Launch Laragon and ensure Apache/Nginx and PHP services are running
2. **Check Python Installation**:
   - Open Command Prompt or PowerShell
   - Run: `python --version`
   - Expected: Python 3.11.x (if not, install from `python-3.11.8-amd64.exe` in project folder)
3. **Check Conda Installation**:
   - Run: `conda --version`
   - If not found, install from `Miniconda3-latest-Windows-x86_64.exe` in project folder
4. **Verify Project Directory**: Ensure `C:\laragon\www\masatunggu` exists and contains all files

## Step 2: Set Up Python Environment

1. **Navigate to Project Directory**:
   ```
   cd C:\laragon\www\masatunggu
   ```

2. **Create/Activate Conda Environment** (if not already created):
   ```
   conda create -n masatunggu python=3.11 -y
   conda activate masatunggu
   ```

3. **Install Python Dependencies**:
   ```
   pip install pandas joblib scikit-learn
   ```

4. **Verify Installations**:
   ```
   python -c "import pandas, joblib, sklearn; print('Python dependencies OK')"
   ```

## Step 3: Set Up Laravel Backend

1. **Install PHP Dependencies**:
   ```
   composer install
   ```

2. **Configure Environment**:
   - Ensure `.env` file exists with these settings:
     ```
     DB_CONNECTION=sqlite
     PYTHON_CMD=py
     APP_KEY=base64:... (generate if missing)
     ```
   - If `.env` doesn't exist, copy from `.env.example`

3. **Generate Application Key** (if needed):
   ```
   php artisan key:generate
   ```

4. **Set Up Database**:
   ```
   php artisan migrate
   ```
   - This creates/uses `database/database.sqlite`

5. **Install Frontend Dependencies**:
   ```
   npm install
   ```

6. **Build Assets**:
   ```
   npm run build
   ```

## Step 4: Test the Integration

1. **Test Python Prediction Script**:
   ```
   echo {"masa_studi":7,"provinsi":"Jawa Timur","prodi":"Sistem Informasi","ipk":3.5,"toefl":500,"jenis_kelamin":0,"sskm":144,"nilai_kp":"A","nilai_ta":"A","magang":1,"masa_carikerja":2,"jml_lamaran":10} | python Script\predict.py
   ```
   - Expected output: JSON with prediction result like `{"ok": true, "prediksi_masa_tunggu": 4.23}`

2. **Start Laravel Development Server**:
   ```
   php artisan serve
   ```
   - Server starts at `http://localhost:8000`

3. **Test Web Interface**:
   - Open browser and go to `http://localhost:8000`
   - Fill out the prediction form and submit
   - Verify prediction appears in the result card

## Step 5: Optional Development Mode

For full development with hot reloading:

```
composer run dev
```

This runs Laravel server, queue worker, logs, and Vite dev server concurrently.

## Troubleshooting Common Issues

### Python-Related Issues
- **"python is not recognized"**: Use `py` instead, or add Python to PATH
- **Conda not found**: Restart terminal after installation
- **Import errors**: Reinstall packages with `pip install --force-reinstall pandas joblib scikit-learn`
- **Model file missing**: Verify `Script/model.joblib` and `Script/feature_cols.json` exist

### Laravel-Related Issues
- **Composer errors**: Ensure PHP is in PATH, or use `php composer.phar`
- **Database connection failed**: Check `.env` DB_CONNECTION=sqlite, ensure `database.sqlite` is writable
- **Migration errors**: Run `php artisan migrate:reset` then `php artisan migrate`
- **Assets not loading**: Run `npm run dev` for development mode

### Integration Issues
- **Process timeout**: Python script taking too long? Check model loading
- **JSON parsing errors**: Ensure input format matches the script expectations
- **Permission errors**: Run as Administrator, check folder permissions

### General Issues
- **Port 8000 busy**: Use `php artisan serve --port=8001`
- **Laragon conflicts**: Ensure no other servers running on same port
- **Antivirus blocking**: Temporarily disable during setup

## Verification Checklist

- [ ] Python 3.11+ installed and accessible
- [ ] Conda environment "masatunggu" activated
- [ ] Python dependencies installed (pandas, joblib, sklearn)
- [ ] Composer dependencies installed
- [ ] .env configured with DB_CONNECTION=sqlite and PYTHON_CMD=py
- [ ] Database migrated (prediktors table exists)
- [ ] Frontend assets built
- [ ] Python script test successful
- [ ] Laravel server running at localhost:8000
- [ ] Web form submission works and shows prediction

## Additional Notes

- The project uses SQLite for simplicity (no MySQL setup required)
- Python integration uses the Process facade with configurable command
- Model files are pre-trained and included in the Script/ directory
- For production deployment, additional security and optimization steps are needed

If you encounter issues not covered here, check the Laravel logs in `storage/logs/laravel.log` and the main PROJECT_SUMMARY.md for more details.