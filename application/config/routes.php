<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['(:any)'] = 'Kelas/detail';
$route['reader/(:any)'] = 'News/news_reader/$1';
$route['infront/teams'] = 'welcome/team';
$route['infront/contact'] = 'welcome/contact';
$route['infront/portofolio'] = 'welcome/portofolio';
<<<<<<< HEAD
$route['portofolio/detail/(:any)'] = 'welcome/portofolio_selengkapnya/$1';
$route['infront/careers'] = 'welcome/profile/careers';
$route['infront/clients'] = 'welcome/profile/clients';
$route['infront/news'] = 'News/daftar_berita';
$route['profile/(:any)'] = 'welcome/profile/$1';
$route['infront/page-(:any)-(:any).html'] = 'welcome/static_page/$1/$2';
$route['kursus/(:any)'] = 'welcome/kursus/$1';
$route['sof-dev/(:any)'] = 'welcome/soft_dev/$1';
$route['product/details/(:any)'] = 'welcome/product/$1';
$route['infront/daftar'] = 'pendaftaran/index';
$route['infront/daftar/update'] = 'pendaftaran/updatePendaftaranProcess';
$route['invoices/(:any)'] = 'welcome/invoice/$1';
$route['infront/jadwal'] = 'welcome/jadwal_lengkap';
$route['infront/video'] = 'welcome/video';
$route['infront/promo'] = 'Promo/index';
$route['detail-promo/(:any)--(:any)'] = 'Promo/detail_promo/$1/$2';
// $route['promo'] = 'Promo/detail_promo';
$route['infront/video/(:any)'] = 'welcome/video/$1';
$route['accep-cookie'] = 'welcome/acceptCookies';
$route['infront/perbedaan-kelas'] = 'kelas/perbandinganKelas';
$route['infront/perbedaan-kelas-statis'] = 'kelas/perbandinganKelasStatis';
//tag
$route['tagged/(:any)'] = 'Tagged/index/$1';
$route['internship/kuy-pkl-lauwba'] = 'welcome/pkl';

//workshop
$route['infront/workshop'] = "workshop/index";

//news
$route['infront/news/kategori/(:any)'] = 'news/news_by_category/$1';

//testimoni
$route['infront/testimoni'] = 'welcome/testimoni';

//faq
$route['infront/faq'] = 'Faq/index';

//surat penawaran
$route['surat-penawaran/(:any)'] = 'welcome/surat_penawaran/$1';
$route['penawaran/cetak-surat-penawaran'] = 'welcome/form_surat_penawaran';
$route['infront/surat-penawaran'] = "Suratpenawaran/index";

$route['infront/daftar/project'] = "Project/formPendaftaran";

//bukti bayar
$route['infront/bukti-bayar/(:any)'] = 'welcome/buktiBayar/$1';

//get kelas
$route['infront/get-kelas/(:any)'] = 'welcome/getTrainingAndPrice/$1';
$route['infront/get-kelas'] = 'welcome/getTrainingAndPrice';

//get promo aktif
$route['infront/get-promo-aktif'] = 'promo/promoAktif';

//history ajar
// $route['infront/peserta/history'] = 'Peserta/cetakHistoryKelas';
$route['infront/peserta/history'] = 'peserta/showHistoryKelas';
$route['infront/peserta'] = 'Peserta/index';



//my lauwba api
$route['my-lauwba/auth'] = "my_lauwba_api/Auth/index";
$route['my-lauwba/register'] = "my_lauwba_api/Auth/register";
$route['my-lauwba/test-auth'] = "my_lauwba_api/Auth/testPageAuth";
$route['my-lauwba/my-training'] = "my_lauwba_api/Mytraining/index";
$route['my-lauwba/my-account'] = "my_lauwba_api/Akun/index";
$route['my-lauwba/my-account/update'] = "my_lauwba_api/Akun/updateAkun";
$route['my-lauwba/my-history'] = "my_lauwba_api/Mytraining/historyBelajar";
$route['my-lauwba/my-history/(:any)'] = 'my_lauwba_api/Mytraining/historyBelajar/$1';
$route['my-lauwba/my-certificate'] = "my_lauwba_api/Mytraining/getMyCertificate";
$route['my-lauwba/my-payment-history'] = "my_lauwba_api/Mytraining/getHistoryBayar";
$route['my-lauwba/my-payment-history/(:any)'] = 'my_lauwba_api/Mytraining/getHistoryBayar/$1';
$route['my-lauwba/dashboard'] = 'my_lauwba_api/Mytraining/dashboardInfo';
$route['my-lauwba/affiliation'] = 'my_lauwba_api/Akun/getAffiliationReward';
$route['my-lauwba/my-affiliation-list'] = 'my_lauwba_api/Akun/getUserUsedMyAffiliate';
$route['my-lauwba/my-history-disbursement'] = 'my_lauwba_api/Akun/getPengajuanPencairan';
$route['my-lauwba/my-disbursement'] = 'my_lauwba_api/Akun/pengajuanPencairanSaldo';
=======
$route['infront/news'] = 'News/news_list';
$route['profile/(:any)'] = 'welcome/profile/$1';
$route['infront/layanan-(:any).html'] = 'welcome/static_page/$1';
$route['kursus/(:any)'] = 'welcome/kursus/$1';
$route['sov-def/(:any)'] = 'welcome/soft_dev/$1';
$route['product/(:any)'] = 'welcome/soft_dev/$1';
>>>>>>> 9caa20c15c70040dacffd45d99145e72d46c2d56
