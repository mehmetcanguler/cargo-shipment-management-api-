🧱 Proje Yapısı Hakkında
🔹 SOLID Prensipleri
Projemizde Single Responsibility (S) ilkesine uygun olarak Repository Design Pattern kullanılmış; okuma (Read) ve yazma (Write) işlemleri ayrı sınıflar olarak yapılandırılmıştır.

🔹 Repository Pattern
Generic ReadRepository ve WriteRepository sınıfları ile tekrar eden kod blokları soyutlanmış, yeni repository oluşturmak sade ve sürdürülebilir hale getirilmiştir.

🔹 DTO & Service Yapısı
DTO sınıfları sayesinde, Controller katmanından Service katmanına gelen veriler güvenli ve kontrollü bir şekilde taşınmıştır.
İlgili metodlar, interface'ler ve abstraction'lar ile tip güvenliği sağlanmıştır.

🔹 Filtreleme
Filtreleme işlemleri için base bir sınıf tanımlanmış, bu sayede her serviste ortak kullanılabilecek bir yapı oluşturulmuştur. Tip güvenliği base class üzerinden kontrol edilmiştir.

🔹 API Yanıtları
Tüm API yanıtlarının tutarlı olması adına özel bir ApiResponse sınıfı geliştirilmiş ve bu yapı üzerinden standart JSON çıktılar oluşturulmuştur.

🔹 Hata Yönetimi
Dış dünyaya karşı hataların kontrolünü sağlamak adına Exceptions/Handler sınıfı özelleştirilmiş, böylece hata yönetimi güvenli ve esnek hale getirilmiştir.

🔹 Value Object Kullanımı
dimensions gibi JSON türündeki veriler için özel bir Value Object sınıfı ve Cast sınıfı oluşturulmuştur. Böylece Laravel modelinde tam anlamıyla tip güvenliği sağlanmıştır.

🔹 Base Service Katmanı
Tekrar eden servis metotlarını merkezi bir yerde toplamak amacıyla BaseService sınıfı geliştirilmiştir.
Bu yapı, hem kod tekrarını önler hem de gerektiğinde override edilerek esnek geliştirme imkanı sunar.

🔹 Dependency Injection
Tüm repository ve servis sınıflarının bağımlılıkları RepositoryServiceProvider ve ServiceServiceProvider üzerinden tanımlanmış; bu sayede uygulama içinde esnek ve sürdürülebilir bir bağımlılık yönetimi sağlanmıştır.

🔹 Unit Test
Shipment İşlemleri için Unit Test yazılmıştır.

🔹 Postman 
Postman Çıktısı docs/postman dizini içerisine eklenmiştir.

### Projeyi Başlatma Adımları

```bash
# Repoyu klonlayın
git clone https://github.com/mehmetcanguler/cargo-ship-management-api.git

# Proje dizinine geçin
cd cargo-ship-management-api

# Ortam dosyasını oluşturun
cp .env.example .env

# Bağımlılıkları yükleyin
composer update

# Uygulamayı başlatın
php artisan app:start
```

# cargo-shipment-management-api-
