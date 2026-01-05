# Post-Restart Setup Guide for MASATUNGGU Project

This guide provides step-by-step instructions for setting up and verifying the MASATUNGGU project environment after restarting your laptop. The project integrates a Laravel backend with Python-based machine learning prediction capabilities.

## Prerequisites
- Windows operating system
- Laragon installed (for PHP/Laravel development)
- Internet connection for downloading dependencies

## Step 1: Verify Python Installation
Before proceeding, ensure Python and Conda are properly installed and accessible.

1. Open Command Prompt or PowerShell.
2. Check Python version:
   ```
   python --version
   ```
   - Expected output: Python 3.11.8 or similar
   - If not found, run the Python installer: `C:\laragon\www\masatunggu\python-3.11.8-amd64.exe`

3. Check Conda installation:
   ```
   conda --version
   ```
   - If not found, run the Miniconda installer: `C:\laragon\www\masatunggu\Miniconda3-latest-Windows-x86_64.exe`
   - Follow the installer prompts and restart your terminal if necessary

4. Verify Conda is working:
   ```
   conda info
   ```

## Step 2: Set Up the Environment
Navigate to the project directory and prepare the development environment.

1. Open Command Prompt or PowerShell.
2. Navigate to the project root:
   ```
   cd C:\laragon\www\masatunggu
   ```

3. If using Conda, create and activate the environment (if not already created):
   ```
   conda create -n masatunggu python=3.11 -y
   conda activate masatunggu
   ```
   - Note: The environment name `masatunggu` is recommended but can be customized

## Step 3: Install Python Libraries
Install the required Python dependencies for the prediction functionality.

1. Ensure you're in the activated Conda environment (if using Conda).
2. Install required packages:
   ```
   pip install pandas joblib scikit-learn
   ```
   - `pandas`: For data manipulation
   - `joblib`: For loading the trained model
   - `scikit-learn`: Required for model operations (may be included in the model dependencies)

3. Verify installations:
   ```
   python -c "import pandas, joblib, sklearn; print('All libraries imported successfully')"
   ```

## Step 4: Set Up Laravel Environment
Configure the Laravel backend and its dependencies.

1. Ensure you're in the project root directory: `C:\laragon\www\masatunggu`

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Copy environment configuration:
   ```
   copy .env.example .env
   ```

4. Generate application key:
   ```
   php artisan key:generate
   ```

5. Run database migrations:
   ```
   php artisan migrate
   ```
   - Note: The project uses SQLite by default (configured in .env)

6. Install Node.js dependencies:
   ```
   npm install
   ```

7. Build frontend assets:
   ```
   npm run build
   ```

## Step 5: Test the Integration
Verify that both Laravel and Python components work together.

1. Start the Laravel development server:
   ```
   php artisan serve
   ```
   - The server should start on `http://localhost:8000`
   - Keep this terminal window open

2. In a new terminal window, navigate to the project directory and activate the Conda environment:
   ```
   cd C:\laragon\www\masatunggu
   conda activate masatunggu
   ```

3. Test the Python prediction script manually:
   ```
   echo {"masa_studi": 48, "provinsi": "DKI Jakarta", "prodi": "Teknik Informatika", "ipk": 3.5, "toefl": 500, "jenis_kelamin": 0, "sskm": 400, "nilai_kp": "B", "nilai_ta": "A", "magang": 1, "masa_carikerja": 2, "jml_lamaran": 10} | python Script/predict.py
   ```
   - Expected output: JSON with prediction result or error message

4. Test via Laravel (optional advanced test):
   - Open a new terminal and run:
     ```
     php artisan tinker
     ```
   - In the Tinker shell, test the PrediktorController or create a test record

5. Access the web interface:
   - Open your browser and go to `http://localhost:8000`
   - Fill out the prediction form and submit to test end-to-end functionality

## Troubleshooting Steps

### Python-Related Issues
- **Python not recognized**: Ensure Python is added to PATH or use full path `C:\path\to\python.exe`
- **Conda not found**: Restart your terminal after installation, or use full path to conda
- **Library import errors**: Reinstall packages with `pip install --force-reinstall pandas joblib scikit-learn`
- **Model file not found**: Ensure `Script/model.joblib` exists in the project directory

### Laravel-Related Issues
- **Composer not found**: Install Composer globally or use `php composer.phar`
- **Database connection failed**: Check `.env` file for correct DB settings; run `php artisan migrate:reset` if needed
- **Permission errors**: Ensure write permissions on `storage/` and `bootstrap/cache/` directories
- **Assets not loading**: Run `npm run dev` instead of `npm run build` for development mode

### Integration Issues
- **Python script not responding**: Check that the JSON input format matches the expected structure in `predict.py`
- **Encoding errors**: Ensure all files are saved with UTF-8 encoding
- **Path issues**: Use absolute paths if relative paths fail in Windows environment

### General Issues
- **Port conflicts**: If port 8000 is busy, use `php artisan serve --port=8001`
- **Antivirus blocking**: Temporarily disable antivirus during setup if installation fails
- **Laragon issues**: Ensure Laragon is running and Apache/Nginx is started

### Verification Commands
- Check Laravel status: `php artisan --version`
- Check database: `php artisan migrate:status`
- Check Python environment: `conda env list` and `pip list`
- Test full setup: Submit a form through the web interface and check logs for errors

If issues persist, check Laravel logs in `storage/logs/laravel.log` and Python error outputs for detailed error messages.