# Backend API - Web Galeri Sekolah

Laravel backend API untuk sistem web galeri sekolah SMKN 4 BOGOR.

## 🏗️ Struktur Backend

### **Fitur Utama**
- ✅ **Authentication System**
  - User authentication dengan OTP email
  - Admin authentication
  - Petugas authentication
  - Password reset dengan OTP

- ✅ **Content Management**
  - Posts (Berita/Artikel)
  - Kategori
  - Galeri
  - Foto
  - Profile Sekolah
  - Testimoni

- ✅ **User Features**
  - Like galeri
  - Bookmark galeri
  - Comment galeri
  - Download foto
  - User profile management

- ✅ **Admin Features**
  - Dashboard dengan statistik
  - CRUD Posts
  - CRUD Kategori
  - CRUD Galeri
  - CRUD Foto
  - CRUD Petugas
  - Manage Testimoni
  - Edit Profile Sekolah

- ✅ **Petugas Features**
  - Dashboard dengan statistik terbatas
  - CRUD Posts
  - CRUD Galeri
  - CRUD Foto

## 📁 Struktur Direktori

```
backend/
├── app/
│   ├── Console/Commands/     # Artisan commands
│   ├── Http/
│   │   ├── Controllers/      # API Controllers
│   │   │   ├── Admin/        # Admin controllers
│   │   │   ├── Petugas/      # Petugas controllers
│   │   │   └── ...           # Other controllers
│   │   └── Middleware/       # Middleware
│   ├── Mail/                 # Mailable classes
│   ├── Models/               # Eloquent models
│   ├── Observers/            # Model observers
│   ├── Providers/            # Service providers
│   └── Services/             # Custom services
├── bootstrap/                # Bootstrap files
├── config/                   # Configuration files
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── public/                   # Public entry point
├── routes/
│   ├── api.php               # API routes
│   ├── web.php               # Web routes
│   └── console.php           # Console routes
├── storage/                  # Storage files
├── tests/                    # Tests
└── artisan                   # Artisan CLI
```

## 🚀 Installation

### **1. Install Dependencies**

```bash
composer install
```

### **2. Environment Setup**

```bash
cp .env.example .env
php artisan key:generate
```

### **3. Configure Database**

Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webgalerisekolah
DB_USERNAME=root
DB_PASSWORD=your_password
```

### **4. Run Migrations**

```bash
php artisan migrate --seed
```

### **5. Configure Email (Brevo)**

Edit `.env` file:
```env
MAIL_MAILER=brevo
MAIL_FROM_ADDRESS="your-verified-email@example.com"
MAIL_FROM_NAME="SMKN 4 BOGOR"
BREVO_API_KEY=your-brevo-api-key
```

### **6. Storage Setup**

```bash
php artisan storage:link
```

### **7. Start Server**

```bash
php artisan serve
```

## 🔐 Authentication

### **User Authentication**
- Register: `POST /user/register`
- OTP Verification: `POST /user/otp/verify`
- Login: `POST /user/login`
- Logout: `POST /user/logout`
- Forgot Password: `POST /user/forgot-password`
- Reset Password: `POST /user/reset-password`

### **Admin Authentication**
- Login: `POST /admin/login`
- Logout: `POST /admin/logout`

### **Petugas Authentication**
- Login: `POST /petugas/login`
- Logout: `POST /petugas/logout`

## 📡 API Routes

### **Guest Routes (Public)**
- `GET /` - Home page
- `GET /profil` - Profile sekolah
- `GET /agenda` - List agenda
- `GET /agenda/{post}` - Detail agenda
- `GET /informasi` - List informasi
- `GET /informasi/{post}` - Detail informasi
- `GET /galeri` - List galeri
- `GET /galeri/{galery}` - Detail galeri
- `GET /kontak` - Contact page

### **User Routes (Authenticated)**
- `POST /galleries/{galery}/like` - Like/unlike galeri
- `POST /galleries/{galery}/bookmark` - Bookmark/unbookmark galeri
- `POST /galleries/{galery}/comments` - Add comment
- `POST /comments/{comment}/reply` - Reply comment
- `DELETE /comments/{comment}` - Delete comment
- `GET /user/profile` - Get user profile
- `PUT /user/profile` - Update user profile

### **Admin Routes (Protected)**
- `GET /admin` - Dashboard
- `GET /admin/posts` - List posts
- `POST /admin/posts` - Create post
- `PUT /admin/posts/{post}` - Update post
- `DELETE /admin/posts/{post}` - Delete post
- Similar routes for: kategori, galery, foto, petugas, profile, testimonials

### **Petugas Routes (Protected)**
- `GET /petugas` - Dashboard
- `GET /petugas/posts` - List posts
- `POST /petugas/posts` - Create post
- Similar routes for: galery, foto

## 🗄️ Database

### **Tables**
- `users` - User accounts
- `admins` - Admin accounts
- `petugas` - Petugas accounts
- `posts` - Posts/Artikel
- `kategori` - Kategori posts
- `galery` - Galeri foto
- `foto` - Foto dalam galeri
- `profile` - Profile sekolah
- `testimonials` - Testimoni
- `likes` - User likes
- `bookmarks` - User bookmarks
- `comments` - User comments
- `downloads` - Download tracking

### **Migrations**

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seed
php artisan migrate:fresh --seed
```

### **Seeders**

```bash
# Run seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=AdminSeeder
```

## 🔧 Configuration

### **Mail Configuration**
- Default: Brevo API
- Alternative: SMTP, Resend, Postmark

### **Storage Configuration**
- Local storage: `storage/app/public`
- Public storage: `public/storage` (symlink)

### **Session Configuration**
- Driver: Database
- Lifetime: 120 minutes

## 📝 Models

### **Main Models**
- `User` - User model
- `Admin` - Admin model
- `Petugas` - Petugas model
- `Post` - Post model
- `Kategori` - Kategori model
- `Galery` - Galeri model
- `Foto` - Foto model
- `Profile` - Profile model
- `Testimonial` - Testimonial model
- `Like` - Like model
- `Bookmark` - Bookmark model
- `Comment` - Comment model
- `Download` - Download model

### **Relationships**
- Post belongsTo Kategori, Petugas
- Galery belongsTo Post
- Foto belongsTo Galery
- Like belongsTo User, Galery
- Bookmark belongsTo User, Galery
- Comment belongsTo User, Galery, Comment (parent)
- Download belongsTo User, Foto

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=UserTest
```

## 📦 Services

### **BrevoMailService**
- Send OTP emails via Brevo API
- Handle email verification
- Error handling and logging

### **ResendMailService** (Optional)
- Alternative email service
- Similar functionality to BrevoMailService

## 🔒 Security

### **Authentication Guards**
- `user` - User authentication
- `admin` - Admin authentication
- `petugas` - Petugas authentication

### **Middleware**
- `auth:user` - User authentication
- `auth:admin` - Admin authentication
- `auth:petugas` - Petugas authentication
- `throttle` - Rate limiting

### **HTTPS**
- Force HTTPS in production
- Secure cookies enabled
- Trust proxies for Railway/Heroku

## 🚀 Deployment

### **Production Setup**
1. Set `APP_ENV=production`
2. Set `APP_DEBUG=false`
3. Set `APP_URL=https://your-domain.com`
4. Configure database
5. Configure email service
6. Run migrations
7. Set up storage symlink
8. Clear cache: `php artisan config:clear`

### **Railway Deployment**

1. **Push to GitHub:**
   ```bash
   git add .
   git commit -m "Deploy to Railway"
   git push origin main
   ```

2. **Configure Railway:**
   - Connect your GitHub repository to Railway
   - Railway will auto-detect Laravel
   - Set environment variables in Railway dashboard:
     - `APP_ENV=production`
     - `APP_DEBUG=false`
     - `APP_URL=https://your-app.railway.app`
     - Database credentials
     - Mail credentials (Brevo)

3. **Deployment Process:**
   - Railway automatically runs `composer install`
   - Storage symlink is created automatically via `post-install-cmd`
   - `Procfile` ensures migrations and cache optimization
   - Hero images from `storage/app/public/hero/` are included in deployment

4. **Important Notes:**
   - Storage files (hero images, profiles, fotos) are committed to git
   - Symlink `/public/storage` is created automatically during build
   - If 404 errors occur for images, check that `php artisan storage:link` ran successfully
   - View Railway logs: `railway logs` or Railway dashboard

## 📚 Documentation

### **Additional Documentation**
- `BREVO_SIMPLE_SETUP.md` - Brevo email setup
- `BREVO_DOMAIN_SETUP.md` - Brevo domain verification
- `PANDUAN_ADMIN_PETUGAS.md` - Admin & Petugas guide

## 🐛 Troubleshooting

### **Email Not Sending**
- Check Brevo API key in `.env`
- Verify sender email in Brevo dashboard
- Check logs in `storage/logs/laravel.log`

### **Database Connection Error**
- Check database credentials in `.env`
- Ensure database exists
- Check database server is running

### **Storage Issues**
- Run `php artisan storage:link`
- Check storage folder permissions
- Ensure storage folder exists

## 📄 License

MIT License

## 👥 Contributors

- SMKN 4 BOGOR Development Team

