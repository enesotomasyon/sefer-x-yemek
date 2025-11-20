# Dijital Menü - Restoran Menü Yönetim Sistemi

Dijital Menü, restoranlar için modern, kullanıcı dostu bir dijital menü yönetim platformudur. Yemek Sepeti tarzında çalışan bu uygulama, restoranların menülerini dijital ortamda sunmalarını sağlar.

## 🎨 Renk Paleti

- Primary Orange: `#e84e0f`
- Primary Yellow: `#f7a600`
- Gray: `#9d9d9c`

## ✨ Özellikler

### 👥 Rol Sistemi (Spatie Permission)

#### Admin Özellikleri:
- ✅ Tüm restoranları yönetme
- ✅ Restoran abonelik sürelerini değiştirme
- ✅ İşletmeleri aktifleştirme/pasifleştirme
- ✅ Kategori oluşturma ve yönetme
- ✅ Ana sayfa slider kampanyalarını yükleme
- ✅ Şube onaylarını yönetme

#### İşletme Sahibi Özellikleri:
- ✅ Kendi işletmelerini yönetme
- ✅ Admin tanımlı kategorilerle ürün ekleme
- ✅ Şube ekleme (Admin onayına düşer)
- ✅ QR kod oluşturma

### 🏠 Müşteri Arayüzü

- Üst slider kampanya alanı
- Restoran listesi
- Slider'dan ürün/restoran menüsüne yönlendirme
- Kategoriye göre filtrelenmiş ürün listesi
- Kategoriye uymayan ürünler otomatik "Diğer" kategorisine alınır
- Ürün detay sayfası (görsel, açıklama, fiyat)
- Müşteri ziyaret kaydı (basic customer table)

## 🛠️ Teknolojiler

- **Framework:** Laravel 12
- **Authentication:** Laravel Breeze
- **Permission Management:** Spatie Laravel Permission
- **QR Code Generator:** SimpleSoftwareIO Simple QR Code
- **Frontend:** Blade Templates + Tailwind CSS
- **Database:** MySQL / SQLite

## 📦 Kurulum

### Gereksinimler

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL veya SQLite

### Kurulum Adımları

1. Repository'yi klonlayın:
```bash
git clone <repository-url>
cd sefer-x-yemek
```

2. Composer bağımlılıklarını kurun:
```bash
composer install
```

3. NPM bağımlılıklarını kurun:
```bash
npm install
npm run build
```

4. `.env` dosyasını oluşturun:
```bash
cp .env.example .env
php artisan key:generate
```

5. Veritabanı ayarlarını yapılandırın (`.env`):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dijital_menu
DB_USERNAME=root
DB_PASSWORD=
```

6. Veritabanını migrate edin ve seed verilerini yükleyin:
```bash
php artisan migrate:fresh --seed
```

7. Storage link'ini oluşturun:
```bash
php artisan storage:link
```

8. Uygulamayı başlatın:
```bash
php artisan serve
```

## 🔐 Varsayılan Kullanıcılar

Seed işlemi sonrası şu kullanıcılar oluşturulur:

**Admin:**
- Email: `admin@dijitalmenu.com`
- Password: `password`

**İşletme Sahibi:**
- Email: `owner@example.com`
- Password: `password`

## 📁 Proje Yapısı

```
app/
├── Http/Controllers/
│   ├── Admin/           # Admin panel controllers
│   ├── Owner/           # İşletme sahibi panel controllers
│   ├── HomeController.php
│   ├── RestaurantController.php
│   └── ProductController.php
├── Models/
│   ├── User.php
│   ├── Restaurant.php
│   ├── Branch.php
│   ├── Category.php
│   ├── Product.php
│   ├── Slider.php
│   └── Customer.php
database/
├── migrations/
└── seeders/
resources/
├── views/
│   ├── layouts/
│   │   ├── public.blade.php
│   │   ├── admin.blade.php
│   │   └── owner.blade.php
│   ├── home.blade.php
│   ├── restaurants/
│   │   └── menu.blade.php
│   ├── products/
│   │   └── show.blade.php
│   ├── admin/
│   └── owner/
routes/
└── web.php
```

## 🗄️ Veritabanı Yapısı

### Ana Tablolar:

- **users** - Kullanıcılar (Admin, İşletme Sahibi)
- **restaurants** - Restoranlar
- **branches** - Şubeler
- **categories** - Ürün kategorileri (Admin tarafından tanımlanır)
- **products** - Ürünler
- **sliders** - Ana sayfa slider'ları
- **customers** - Müşteri ziyaret kayıtları

## 🚀 Özellikler ve Fonksiyonaliteler

### Public Routes:
- `GET /` - Ana sayfa (slider + restoran listesi)
- `GET /restaurants/{restaurant}/menu` - Restoran menüsü
- `GET /products/{product}` - Ürün detay sayfası

### Admin Routes:
- `GET /admin/dashboard` - Admin dashboard
- Resource routes for: restaurants, categories, sliders, branches

### Owner Routes:
- `GET /owner/dashboard` - İşletme sahibi dashboard
- Resource routes for: restaurants, products, branches
- `GET /owner/qr/{restaurant}` - QR kod oluşturma

## 🎯 Öne Çıkan Özellikler

1. **Otomatik Kategorizasyon**: Kategorisi olmayan ürünler otomatik olarak "Diğer" kategorisine atanır
2. **Abonelik Kontrolü**: Aboneliği bitmiş restoranlar otomatik olarak gizlenir
3. **Şube Onay Sistemi**: İşletme sahipleri eklediği şubeler admin onayına düşer
4. **QR Kod Desteği**: Her restoran için QR kod oluşturulabilir
5. **Müşteri Takibi**: Siteye giren müşteriler otomatik kaydedilir

## 📝 Lisans

Bu proje MIT lisansı altında lisanslanmıştır.

## 🤝 Katkıda Bulunma

Pull request'ler kabul edilir. Büyük değişiklikler için lütfen önce neyi değiştirmek istediğinizi tartışmak için bir issue açın.

## 📧 İletişim

Sorularınız için lütfen bir issue açın.
