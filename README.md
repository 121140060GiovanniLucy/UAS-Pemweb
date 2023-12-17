
# User List

Projek PHP yang menampilkan seluruh user setiap pendaftaran.


## Penjelasan

### Bagian 1: Client-side Programming

#### Seluruh Halaman

- Menggunakan fitur dark mode bagian dari bootstrap (versi 5).

#### Halaman Login (login.php)

- Terdapat form Username dan Password dengan method POST yang divalidasi menggunakan jquery-validation pada [script.js](../main/assets/js/script.js).

#### Halaman Register (register.php)

- Terdapat form Username, Password, Confirm Password beserta dengan Persetujuan Syarat dan Ketentuan dengan menggunakan checkbox yang juga divalidasi menggunakan jquery-validation pada [script.js](../main/assets/js/script.js).

#### Halaman Daftar Pengguna (users.php)

- Seluruh data pengguna dari server akan ditampilkan pada halaman ini menggunakan tag `table`, termasuk dengan User-Agent dan IP pengguna.

#### Halaman Edit Pengguna (user.php)

- Terdapat form Username dan Password dengan method POST yang divalidasi menggunakan jquery-validation pada [script.js](../main/assets/js/script.js).

### Bagian 2: Server-side Programming

#### Objek OOP (OOP.php)

- Menggunakan nama class UList dengan satu parameter yaitu koneksi dari database.
- Membuat fungsi `fetch_objects($query)` yang menghasilkan seluruh data dari database hanya dengan membutuhkan query dengan menggunakan tipe data `Array of Object`.
- Membuat fungsi `get_user_by_id($id)` yang menghasilkan data user berdasarkan parameter `$id`.
- Membuat fungsi `edit_user_by_id($data, $id)` yang mengubah data user berdasarkan parameter `$id` dengan `$data` yaitu data array yang masing-masing indexnya menyesuaikan nama field pada tabel users.
- Membuat fungsi `delete_user_by_id($id)` yang menghapus data user berdasarkan parameter `$id`.
- Membuat fungsi `set_active($id)` dan `delete_active($id)` yang akan mengubah data keaktifan user dalam hal pergantian User-Agent dan IP pengguna berdasarkan parameter `$id`.

#### Halaman Login (login.php)

- Menggunakan `$_POST` untuk mengenali seluruh data pada form login dan mengirimnya ke database.
- Jika berhasil login maka akan menggunakan `UList->set_active($id)` dalam hal membuat user berdasarkan id tersebut bersifat aktif.

#### Halaman Register (register.php)

- Menggunakan `$_POST` untuk mengenali seluruh data pada form register dan mengirimnya ke database.
- Validasi pada input Password dan Confirm apakah sama atau tidak.
- Jika berhasil register maka akan mengirim seluruh data terkait kedalam database dan beralih pada `login.php`.

#### Halaman Daftar Pengguna (users.php)

- Mengambil seluruh data pada database sehingga `table` terisi.

#### Halaman Edit Pengguna (user.php)

- Menggunakan `$_GET` untuk mengenali siapakah id pengguna yang akan diubah.
- Menggunakan `UList->get_user_by_id($id)` untuk membuat form pengeditan yang mempunyai value yang tepat dengan id.
- Menempatkan `input` dengan `type="hidden" name="id"` yang dimana akan dimasukkan value dari `$_GET["id"]` sehingga pengiriman input pengeditan kepada database akan lengkap dengan menyebutkan `WHERE id = $_POST['id']`.

#### Hapus Pengguna (delete.php)

- Menggunakan `$_GET` untuk mengenali siapakah id pengguna yang akan dihapus.
- Menggunakan `UList->delete_user_by_id($id)` untuk menghapus pengguna berdasarkan id.

#### Logout (logout.php)

- Menggunakan `$_SESSION['id']` untuk mengenali siapakah id pengguna yang akan dihapus.
- Menggunakan `UList->delete_active($id)` untuk membuat user berdasarkan id tersebut bersifat tidak aktif.


### Bagian 3: Database Management

Database dibuat dengan nama `db_userlist` yang mempunyai table `users` dengan beberapa data pengguna setelah register. `db_userlist` dikoneksikan pada file `koneksi.php` dan digunakan oleh semua file PHP yang menggunakan database didalamnya.

### Bagian 4: State Management

State session akan didahulukan menggunakan `session_start()` pada file `koneksi.php` sehingga semua file PHP yang lain dapat menggunakan session. Beberapa penjelasan yang akan menggunakan session sebagai berikut:

- Seluruh kode yang menginisialisasi `$_SESSION['success']` dan `$_SESSION['error']` maka akan memunculkan alert yang menyesuaikan dan akan menghapus data tersebut setelah ditampilkan menggunakan fungsi `unset(...)`.
- Halaman login akan menggunakan session ketika berhasil login dan memasukkan beberapa data seperti id pengguna dan username pengguna.
- Penggunaan Navbar yang digunakan pada file `templates/header.php` akan menggunakan `$_SESSION['username']` sehingga user akan disambut dengan username login.
- Logout akan menghapus seluruh data session.

Local Storage juga digunakan pada website ini dalam hal fitur Dark Mode Switch sehingga dapat menyimpan data apakah menggunakan Dark Mode atau Light Mode.

### Bagian Bonus: Hosting Aplikasi Web

#### 1. Apa langkah-langkah yang Anda lakukan untuk meng-host aplikasi web Anda?
- Membuat akun di 000webhostapp.
- Menunggah seluruh file proyek ke direktori di proyek 000webhostapp.
- Buat database dengan nama db_userlist di panel pengelolaan database 000webhostapp.
- Mengimpor database ke dalam database yang baru dibuat;
- Menguji fungsionalitas website dengan memastikan registrasi, login, pengeditan pengguna, penghapusan pengguna, dan logout berjalan dengan baik.

#### 2. Pilih penyedia hosting web yang menurut Anda paling cocok untuk aplikasi web Anda. Berikan alasan Anda.
Penyedia hosting web yang saya pilih adalah 000webhostapp. Hal ini karena 000webhosapp menyediakan opsi hosting gratis, dan memiliki interface yang ramah pengguna. 000webhostapp juga cocok untuk aplikasi berbasis PHP dan menggunakan database MySql. Sebelumnya saya mencoba menghosting lewat github, namun mengalami error terkait file PHP.

#### 3. Bagaimana Anda memastikan keamanan aplikasi web yang Anda host?
- Dengan memastikan semua operasi yang melibatkan data dari pengguna divalidasi di sisi server (seperti validasi login, registrasi, dll).
- Menggunakan prepared statements atau parameterized queries untuk menghindari SQL injections.
- Menggunakan token CSRF untuk mencegah serangan CSRF.

#### 4. Jelaskan konfigurasi server yang Anda terapkan untuk mendukung aplikasi web Anda.
- 000webhostapp mendukung PHP dan MySQL, sehingga aplikasi web yang dibangun dengan teknologi ini dapat dihosting dengan baik di platform ini.
- 000webhostapp akan mengelola keamanan server secara keseluruhan.
- Menggunakan  panel kontrol yang disediakan oleh 000webhostapp untuk mengelola konfigurasi dan pengaturan server. 
