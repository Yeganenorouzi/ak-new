/**
 * jQuery Loader
 * This script checks if jQuery is loaded and loads it from CDN if not
 */

(function() {
    // Check if jQuery is already loaded
    if (typeof jQuery === 'undefined') {
        console.log('jQuery not found, loading from CDN...');
        
        // Create a script element
        var script = document.createElement('script');
        script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
        script.integrity = 'sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=';
        script.crossOrigin = 'anonymous';
        
        // Add event listeners
        script.onload = function() {
            console.log('jQuery loaded successfully');
            // Dispatch an event to notify other scripts that jQuery is now available
            var event = new CustomEvent('jqueryLoaded');
            document.dispatchEvent(event);
        };
        
        script.onerror = function() {
            console.error('Failed to load jQuery from CDN');
        };
        
        // Append the script to the document
        document.head.appendChild(script);
    } else {
        console.log('jQuery is already loaded');
    }
})(); 