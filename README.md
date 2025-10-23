# Stok Takip Otomasyonu

## Proje Hakkında

Bu proje, bir stok takip ve kullanıcı yönetimi otomasyon sistemidir. Ürünleri kategorilere ayırabilir, stok miktarlarını yönetebilir, fiyatları belirleyebilir ve farklı yetkilere sahip kullanıcıları yönetebilirsiniz. Admin paneli aracılığıyla ürün ve kullanıcı listeleme, ekleme, düzenleme ve silme işlemleri yapılabilir.

## Kurulum

Projeyi yerel geliştirme ortamınızda çalıştırmak için aşağıdaki adımları izleyin.

### Ön Gereksinimler

Projeyi çalıştırmak için aşağıdaki yazılımların sisteminizde kurulu olması gerekmektedir:

- PHP >= 8.1
- Composer
- Node.js ve npm
- MySQL veya MariaDB gibi bir veritabanı sistemi
- Git

### Adımlar

1.  **Projeyi Klonlayın:**

    ```bash
    git clone <proje_depo_adresi>
    cd StokTakipOtomasyonu
    ```

    >(Not: `<proje_depo_adresi>` yerine projenizin Git deposu adresini yazmalısınız.)

2.  **Composer Bağımlılıklarını Kurun:**

    ```bash
    composer install
    ```

3.  **npm Bağımlılıklarını Kurun:**

    ```bash
    npm install
    ```

4.  **Ortam Dosyasını Yapılandırın:**

    `.env.example` dosyasını kopyalayarak `.env` adında yeni bir dosya oluşturun.

    ```bash
    cp .env.example .env
    ```

    `.env` dosyasını açın ve aşağıdaki veritabanı bağlantı bilgilerini kendi veritabanı ayarlarınıza göre düzenleyin:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

    > (`your_database_name`, `your_database_user`, `your_database_password` kısımlarını kendi bilgilerinizle değiştirin.)

5.  **Uygulama Anahtarını Oluşturun:**

    ```bash
    php artisan key:generate
    ```

6.  **Veritabanı Tablolarını Oluşturun:**

    Migration'ları çalıştırarak veritabanı tablolarını oluşturun.

    ```bash
    php artisan migrate
    ```

7.  **Test Verilerini Ekleyin (İsteğe Bağlı):**

    Eğer proje için test verileri (kullanıcılar, ürünler vb.) tanımlanmışsa, bunları eklemek için seeder'ları çalıştırabilirsiniz.

    ```bash
    php artisan db:seed
    ```
    >(Not: Tüm seeder'ları çalıştırmak yerine spesifik seeder'ları çalıştırmak isterseniz `php artisan db:seed --class=YourSeederClassName` komutunu kullanabilirsiniz.)

8.  **Storage Bağlantısını Oluşturun:**

    Yüklenen dosyaların (örneğin ürün görselleri) genel erişime açık olması için storage klasörüne sembolik link oluşturun.

    ```bash
    php artisan storage:link
    ```

9. **Frontend Varlıklarını Derleyin:**

    CSS ve JavaScript dosyalarını derlemek için Vite'ı çalıştırın.

    ```bash
    npm run dev
    # veya üretim için
    # npm run build
    ```
    >(Not: `npm run dev` komutu geliştirme sırasında aktif kalmalı ve ön uç değişikliklerinizi otomatik olarak algılayıp yenilemelidir.)

## Projeyi Çalıştırma

Tüm kurulum adımlarını tamamladıktan sonra projeyi çalıştırmak için Laravel'in dahili sunucusunu kullanabilirsiniz:

```bash
php artisan serve
```

Ardından tarayıcınızda genellikle `http://127.0.0.1:8000` adresinden projeye erişebilirsiniz.

`npm run dev` komutunun ayrı bir terminal penceresinde çalışmaya devam ettiğinden emin olun.

## Kullanıcılar (Varsayılan)

Eğer `db:seed` komutunu çalıştırdıysanız, varsayılan kullanıcılar oluşturulmuş olabilir. Genellikle bir admin kullanıcısı bulunur:

- **Email:** `admin@example.com` (veya seeder dosyasında belirtilen başka bir adres)
- **Şifre:** `password` (veya seeder dosyasında belirtilen başka bir şifre)

Seeder dosyanızı kontrol ederek varsayılan kullanıcı bilgilerini teyit edebilirsiniz.

## Yapılandırma (Ek)

- **E-posta Ayarları:** Şifre sıfırlama gibi e-posta gönderme işlevlerinin çalışması için `.env` dosyasındaki mail ayarlarını (MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS, MAIL_FROM_NAME) yapılandırmanız gerekebilir.


