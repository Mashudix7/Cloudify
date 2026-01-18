<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Helper - Fungsi keamanan untuk Cloudify
 * 
 * Helper ini menyediakan fungsi-fungsi untuk:
 * - Sanitasi HTML (mencegah XSS dari rich text editor)
 * - Membersihkan input berbahaya
 * 
 * @package     Cloudify
 * @subpackage  Helpers
 * @category    Security
 */

if (!function_exists('sanitize_html')) {
    /**
     * Sanitasi HTML dari Rich Text Editor
     * 
     * Fungsi ini membersihkan HTML dari tag berbahaya
     * sambil tetap mempertahankan formatting yang aman.
     * 
     * Tag yang DIIZINKAN:
     * - Formatting: <b>, <i>, <u>, <s>, <strong>, <em>
     * - Heading: <h1>, <h2>, <h3>
     * - List: <ul>, <ol>, <li>
     * - Struktur: <p>, <br>, <blockquote>, <pre>, <code>
     * - Link: <a> (dengan validasi href)
     * 
     * @param string $html HTML mentah dari editor
     * @return string HTML yang sudah disanitasi
     */
    function sanitize_html($html)
    {
        if (empty($html)) {
            return '';
        }
        
        // Daftar tag yang diizinkan
        $allowed_tags = '<p><br><b><i><u><s><strong><em><h1><h2><h3><ul><ol><li><blockquote><pre><code><a><span>';
        
        // Hapus tag yang tidak diizinkan
        $clean = strip_tags($html, $allowed_tags);
        
        // Sanitasi atribut pada tag <a>
        // Hanya izinkan href dengan http/https
        $clean = preg_replace_callback(
            '/<a\s+([^>]*)>/i',
            function($matches) {
                $attrs = $matches[1];
                
                // Ekstrak href
                if (preg_match('/href\s*=\s*["\']([^"\']+)["\']/i', $attrs, $href_match)) {
                    $href = $href_match[1];
                    
                    // Validasi protokol - hanya http/https yang diizinkan
                    if (!preg_match('/^https?:\/\//i', $href)) {
                        // Jika bukan http/https, tambahkan https://
                        if (!preg_match('/^(mailto:|tel:|#)/i', $href)) {
                            $href = 'https://' . $href;
                        }
                    }
                    
                    // Kembalikan tag <a> yang aman dengan target blank
                    return '<a href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer">';
                }
                
                // Jika tidak ada href valid, hapus tag <a>
                return '';
            },
            $clean
        );
        
        // Hapus event handler JavaScript (onclick, onerror, dll)
        $clean = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $clean);
        
        // Hapus javascript: protocol
        $clean = preg_replace('/javascript\s*:/i', '', $clean);
        
        // Hapus style yang berbahaya (expression, url, behavior)
        $clean = preg_replace('/style\s*=\s*["\'][^"\']*(?:expression|url|behavior)[^"\']*["\']/i', '', $clean);
        
        return $clean;
    }
}

if (!function_exists('display_article_content')) {
    /**
     * Tampilkan konten artikel dengan aman
     * 
     * Wrapper untuk sanitize_html yang memastikan
     * konten aman ditampilkan di halaman publik.
     * 
     * @param string $content Konten artikel dari database
     * @return string HTML yang aman untuk ditampilkan
     */
    function display_article_content($content)
    {
        return sanitize_html($content);
    }
}

if (!function_exists('strip_html_content')) {
    /**
     * Hapus semua HTML dari konten
     * 
     * Berguna untuk membuat excerpt/ringkasan artikel
     * tanpa formatting HTML.
     * 
     * @param string $content Konten dengan HTML
     * @param int $max_length Panjang maksimal (0 = unlimited)
     * @return string Teks tanpa HTML
     */
    function strip_html_content($content, $max_length = 0)
    {
        // Hapus semua tag HTML
        $text = strip_tags($content);
        
        // Decode HTML entities
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        
        // Normalisasi whitespace
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);
        
        // Potong jika diminta
        if ($max_length > 0 && strlen($text) > $max_length) {
            $text = substr($text, 0, $max_length);
            // Potong di kata terakhir yang lengkap
            $text = substr($text, 0, strrpos($text, ' '));
            $text .= '...';
        }
        
        return $text;
    }
}
