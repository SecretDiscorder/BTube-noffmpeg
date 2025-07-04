# 📺 BTube-noffmpeg

**BTube-noffmpeg** adalah hasil modifikasi dari PlayTube, dirancang agar dapat berjalan di hampir semua layanan shared hosting tanpa membutuhkan `FFmpeg`. Cocok untuk pengguna dengan keterbatasan akses server atau resource terbatas.

---

## 🚀 Fitur Utama

* ✅ Tidak memerlukan FFmpeg
* 💡 Berjalan di shared hosting
* ⚙️ Dukungan panel admin bawaan
* 📁 Struktur file modular: `app_api`, `themes`, `admin-panel`, `upload`, dll
* 🔐 Termasuk file keamanan seperti `.htaccess`, `SECURITY.md`, dan `CODE_OF_CONDUCT.md`
* 🌐 Berbasis PHP + JavaScript + HTML + CSS

---

## 📦 Instalasi

1. **Clone repository ini** atau unduh ZIP:

```bash
git clone https://github.com/SecretDiscorder/BTube-noffmpeg.git
```

2. **Ekstrak folder ke server Anda**, lalu buka browser:

```
http://localhost/BTube-noffmpeg/install
atau
http://domainanda.com/install
```

3. **Ikuti instruksi instalasi di halaman tersebut**.

> ⚠️ Jangan aktifkan fitur FFmpeg di panel admin, karena script ini tidak mendukungnya.

---

## 🧩 Struktur Folder

```
BTube-noffmpeg/
├── admin-panel/       # Panel admin
├── app_api/           # API aplikasi
├── ajax/              # AJAX handlers
├── upload/            # Tempat upload video
├── themes/            # Tampilan UI
├── install/           # Installer
├── cgi-bin/           # Dukungan hosting
├── config.php         # Konfigurasi
├── index.php          # Beranda
├── ...dan banyak lagi
```

---

## 📃 Lisensi

MIT License – Bebas digunakan dan dimodifikasi.

---

## 🌐 Situs Terkait

Project ini digunakan di: [https://bima-pustaka.my.id](https://bima-pustaka.my.id)

---

## 👨‍💻 Kontributor

Developed by [SecretDiscorder](https://github.com/SecretDiscorder) dengan semangat berbagi solusi self-hosted video platform.

Kontribusi dan pull request dipersilakan! 🙌
