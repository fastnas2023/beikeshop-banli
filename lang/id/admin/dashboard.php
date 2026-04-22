<?php
/**
 * dashboard.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 10:58:03
 */

return [
    // Original translations
    'customer_new'  => 'Tambahkan Pengguna',
    'customer_view' => 'Kunjungan pengguna',
    'day_before'    => 'dari hari sebelumnya',
    'latest_month'  => 'Satu bulan',
    'latest_week'   => 'Satu minggu',
    'latest_year'   => 'Satu tahun',
    'order_amount'  => 'Penjualan',
    'order_report'  => 'Statistik Pesanan',
    'order_total'   => 'Volume pesanan',
    'product_total' => 'Produk baru',
    'today'         => 'Hari ini',
    'yesterday'     => 'Kemarin',

    // Dashboard new translations
    'page_title' => 'Pemantauan real-time indikator kunci platform e-commerce dan kinerja bisnis',
    'visitor_count' => 'Pengunjung',
    'cart_count' => 'Ditambahkan ke keranjang',
    'purchase_count' => 'Pembelian',
    'conversion_rate' => 'Tingkat konversi',
    'vs_yesterday' => 'vs Kemarin',
    'export_report' => 'Ekspor laporan',
    'refresh_data' => 'Perbarui data',
    'visitor_trend' => 'Tren pengunjung',
    'customer_source_analysis' => 'Analisis sumber pelanggan',
    'loading_source_data' => 'Memuat data sumber pelanggan...',
    'loading' => 'Memuat...',
    'order_funnel' => 'Corong pesanan',
    'refresh_funnel_data' => 'Perbarui data corong',
    'hot_products' => 'Produk populer',
    'slow_products' => 'Produk lambat',
    'sort_options' => 'Opsi pengurutan',
    'sort_by_sales_desc' => 'Berdasarkan penjualan (Menurun)',
    'sort_by_sales_asc' => 'Berdasarkan penjualan (Menaik)',
    'sort_by_price_desc' => 'Berdasarkan harga (Menurun)',
    'sort_by_price_asc' => 'Berdasarkan harga (Menaik)',
    'loading_hot_products' => 'Memuat data produk populer...',
    'loading_slow_products' => 'Memuat data produk lambat...',
    'near_7_days' => '7 hari terakhir',

    // Conversion rate options
    'visitor_to_purchase' => 'Konversi pengunjung ke pembelian',
    'visitor_to_cart' => 'Konversi pengunjung ke keranjang',
    'cart_to_purchase' => 'Konversi keranjang ke pembelian',

    // Error messages
    'invalid_time_range' => 'Rentang waktu tidak valid: :timeRange. Rentang yang didukung: :validRanges',
    'invalid_product_type' => 'Jenis produk tidak valid: :type. Jenis yang didukung: :validTypes',
    'invalid_export_format' => 'Format ekspor tidak valid: :format. Format yang didukung: :validFormats',
    'get_stats_failed' => 'Gagal mendapatkan statistik: :message',
    'get_trends_failed' => 'Gagal mendapatkan data tren: :message',
    'get_mini_chart_failed' => 'Gagal mendapatkan data mini chart: :message',
    'get_source_analysis_failed' => 'Gagal mendapatkan data analisis sumber: :message',
    'get_funnel_failed' => 'Gagal mendapatkan data corong: :message',
    'get_product_ranking_failed' => 'Gagal mendapatkan data peringkat produk: :message',
    'export_report_failed' => 'Gagal mengekspor laporan: :message',
    'please_login_first' => 'Silakan login terlebih dahulu',
    'no_export_permission' => 'Anda tidak memiliki izin untuk mengekspor laporan',
    'export_rate_limit' => 'Batas kecepatan ekspor terlampaui, coba lagi nanti',
    'get_cache_status_failed' => 'Gagal mendapatkan status cache: :message',
    'cache_clear_success' => 'Cache berhasil dibersihkan',
    'cache_clear_failed' => 'Gagal membersihkan cache: :message',

    // Customer sources
    'direct_access' => 'Akses langsung',
    'google' => 'Google',
    'baidu' => 'Baidu',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => 'Lainnya',
    'no_data' => 'Tidak ada data',

    // Funnel data
    'product_views' => 'Tampilan produk',
    'unique_visitors' => 'Pengunjung unik',
    'cart_additions' => 'Ditambahkan ke keranjang',
    'orders' => 'Pesanan',
    'successful_payments' => 'Pembayaran berhasil',

    // Export report related
    'ranking' => 'Peringkat',
    'product_name' => 'Nama produk',
    'price' => 'Harga',
    'sales' => 'Penjualan',
    'percentage' => 'Persentase',
    'sales_amount' => 'Jumlah penjualan',

    // Ekspor laporan terkait
    'report_title' => 'Laporan Dashboard Data BeikeShop',
    'export_time' => 'Waktu Ekspor',
    'time_range' => 'Rentang Waktu',
    'basic_stats' => 'Data Statistik Dasar',
    'conversion_data' => 'Data Tingkat Konversi',
    'conversion_funnel' => 'Corong Konversi',
    'hot_products_ranking' => 'Peringkat Produk Populer',
    'slow_products_ranking' => 'Peringkat Produk Lambat',
    'trend_data' => 'Data Tren',

    // Indikator statistik
    'visitor_count' => 'Jumlah Pengunjung',
    'cart_count' => 'Jumlah Tambahan ke Keranjang',
    'purchase_count' => 'Jumlah Pembelian',
    'current_value' => 'Nilai Saat Ini',
    'previous_value' => 'Nilai Sebelumnya',
    'change_percentage' => 'Persentase Perubahan',
    'trend' => 'Tren',
    'up' => 'Naik',
    'down' => 'Turun',

    // Tingkat konversi terkait
    'conversion_type' => 'Jenis Konversi',
    'current_conversion_rate' => 'Tingkat Konversi Saat Ini',
    'previous_conversion_rate' => 'Tingkat Konversi Sebelumnya',
    'change' => 'Perubahan',

    // Analisis sumber terkait
    'source' => 'Sumber',
    'visits' => 'Kunjungan',
    'source_type' => 'Jenis Sumber',
    'rank' => 'Peringkat',
    'total' => 'Total',

    // Corong terkait
    'stage' => 'Tahap',
    'quantity' => 'Jumlah',
    'conversion_rate' => 'Tingkat Konversi',
    'width' => 'Lebar',
    'conversion_stage' => 'Tahap Konversi',
    'user_count' => 'Jumlah Pengguna',
    'loss_rate' => 'Tingkat Kehilangan',
    'funnel_width' => 'Lebar Corong',

    // Tren terkait
    'time' => 'Waktu',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'Rasio PV/UV',
    'summary' => 'Ringkasan',
    'page_views' => 'Tampilan Halaman',
    'unique_visitors' => 'Pengunjung Unik',

    // Peringkat produk terkait
    'hot_products_summary' => 'Ringkasan Produk Populer',
    'slow_products_summary' => 'Ringkasan Produk Lambat',
];
