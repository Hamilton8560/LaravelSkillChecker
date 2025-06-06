// Listen for buff activation events
window.addEventListener('buff-activated', event => {
    // Simple notification - you can replace this with a toast library
    const message = event.detail.message;
    
    // Create a temporary notification element
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 transition-opacity duration-300';
    notification.textContent = message;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
});