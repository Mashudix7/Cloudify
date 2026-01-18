<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Headers Hook
 * 
 * Hook ini menambahkan HTTP security headers ke setiap response.
 * Headers ini membantu mencegah berbagai serangan seperti:
 * - Clickjacking (X-Frame-Options)
 * - XSS (X-XSS-Protection, Content-Security-Policy)
 * - MIME sniffing (X-Content-Type-Options)
 */
class SecurityHeaders {
    
    /**
     * Set security headers pada setiap request
     */
    public function set_headers()
    {
        // Skip security headers untuk AJAX/API requests
        // Karena CSP bisa mengganggu JSON response
        $CI =& get_instance();
        $uri = $CI->uri->uri_string();
        
        // Skip untuk endpoint API dan notifications
        $skip_patterns = [
            'admin/notifications',
            'landing/api_weather',
            'reactions'
        ];
        
        foreach ($skip_patterns as $pattern) {
            if (strpos($uri, $pattern) !== false) {
                return; // Jangan set security headers untuk endpoint ini
            }
        }
        
        // Cegah clickjacking - halaman tidak bisa di-embed dalam iframe luar
        header('X-Frame-Options: SAMEORIGIN');
        
        // Aktifkan XSS filter browser
        header('X-XSS-Protection: 1; mode=block');
        
        // Cegah browser menebak MIME type
        header('X-Content-Type-Options: nosniff');
        
        // Kontrol informasi referrer yang dikirim
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        // Permissions Policy - batasi akses ke fitur browser
        header('Permissions-Policy: geolocation=(self), microphone=(), camera=()');
        
        // Content Security Policy
        // Dibuat lebih permisif untuk mengizinkan CDN yang digunakan
        $csp = [
            "default-src 'self'",
            // Script: izinkan CDN yang digunakan (Tailwind, Unpkg, jsDelivr, Quill.js)
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://unpkg.com https://cdn.jsdelivr.net https://cdn.quilljs.com",
            // Style: izinkan CDN untuk CSS (Google Fonts, jsDelivr, Quill.js)
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://cdn.quilljs.com",
            // Font: izinkan Google Fonts
            "font-src 'self' https://fonts.gstatic.com data:",
            // Image: izinkan semua sumber gambar
            "img-src 'self' data: https: blob:",
            // Connect: izinkan API dan tile map
            "connect-src 'self' https://*.tile.openstreetmap.org https://api.openweathermap.org",
            // Frame: izinkan embed dari self
            "frame-src 'self'",
            "frame-ancestors 'self'"
        ];
        header('Content-Security-Policy: ' . implode('; ', $csp));
    }
}
